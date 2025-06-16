<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerserviceController extends Controller
{
    const GUEST_RATE_LIMIT = 5;
    const GUEST_MESSAGE_EXPIRY_HOURS = 1;
    const MAX_MESSAGES = 100;

    public function index()
    {
        $this->initGuestSession();
        return view('customer_service', [
            'messages' => $this->getRecentMessages(),
            'is_guest' => !Auth::check(),
            'guest_id' => Session::get('guest_id')
        ]);
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ], 422);
        }

        if (!Auth::check()) {
            $this->applyRateLimiting($request->ip());
        }

        try {
            // Simpan pesan user
            $userMessage = ChatMessage::create([
                'user_id' => Auth::id(),
                'guest_id' => !Auth::check() ? Session::get('guest_id') : null,
                'ip_address' => $request->ip(),
                'message' => $this->sanitize($request->message),
                'sender' => 'user',
                'expires_at' => !Auth::check() 
                    ? now()->addHours(self::GUEST_MESSAGE_EXPIRY_HOURS)
                    : null
            ]);

            // Dapatkan balasan bot
            $botResponse = $this->generateBotResponse($request->message);

            return response()->json([
                'success' => true,
                'user_message' => $userMessage,
                'bot_response' => $botResponse
            ]);

        } catch (\Exception $e) {
            Log::error('Chat Error: '.$e->getMessage());
            return $this->errorResponse('Terjadi kesalahan sistem');
        }
    }

    public function getMessages()
    {
        return response()->json([
            'success' => true,
            'messages' => $this->getRecentMessages()
        ]);
    }

    private function generateBotResponse(string $message): ChatMessage
    {
        $apiResponse = $this->callDeepSeekApi($message);
        
        return ChatMessage::create([
            'user_id' => Auth::id(),
            'guest_id' => !Auth::check() ? Session::get('guest_id') : null,
            'ip_address' => request()->ip(),
            'message' => $apiResponse,
            'sender' => 'bot',
            'expires_at' => !Auth::check() 
                ? now()->addHours(self::GUEST_MESSAGE_EXPIRY_HOURS)
                : null
        ]);
    }

    private function callDeepSeekApi(string $message): string
    {
        try {
            $response = Http::timeout(10)
                ->retry(2, 300)
                ->withHeaders([
                    'Authorization' => 'Bearer '.config('services.deepseek.key'),
                    'Content-Type' => 'application/json'
                ])
                ->post(config('services.deepseek.endpoint'), [
                    'model' => 'deepseek-chat',
                    'messages' => [[
                        'role' => 'user',
                        'content' => $message
                    ]],
                    'max_tokens' => 300
                ]);

            $data = $response->json();
            return $data['choices'][0]['message']['content'] 
                ?? 'Maaf, saya tidak bisa memproses pesan ini.';

        } catch (\Exception $e) {
            Log::error('DeepSeek API Error: '.$e->getMessage());
            return 'Layanan chat sedang sibuk. Silakan coba lagi nanti.';
        }
    }

    private function getRecentMessages()
    {
        $query = Auth::check()
            ? ChatMessage::where('user_id', Auth::id())
            : ChatMessage::where('guest_id', Session::get('guest_id'))
                ->where(function($q) {
                    $q->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
                });

        return $query->orderBy('created_at', 'desc')
                   ->limit(self::MAX_MESSAGES)
                   ->get();
    }

    private function initGuestSession(): void
    {
        if (!Auth::check() && !Session::has('guest_id')) {
            Session::put('guest_id', Str::random(20));
        }
    }

    private function applyRateLimiting(string $ip): void
    {
        if (!RateLimiter::attempt(
            'chat:'.$ip, 
            self::GUEST_RATE_LIMIT, 
            fn() => true, 
            60
        )) {
            abort(429, 'Terlalu banyak pesan. Silakan tunggu 1 menit.');
        }
    }

    private function sanitize(string $input): string
    {
        return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }

    private function errorResponse(string $message, int $code = 400)
    {
        return response()->json([
            'success' => false,
            'error' => $message
        ], $code);
    }
}