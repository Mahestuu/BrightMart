<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login to obtain API token",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Credentials for authentication",
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 description="User's email address",
     *                 example="admin@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 description="User's password",
     *                 example="password123"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="1|abcdef123456"),
     *             @OA\Property(property="role", type="string", example="admin")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Invalid credentials")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Hanya admin yang diizinkan")
     *         )
     *     )
     * )
     */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Perbaikan di sini:
            if (Auth::check() && Auth::user()->role === 'admin') {
                return redirect()->intended('/dashboardadmin');
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout and revoke API token",
     *     tags={"Authentication"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully logged out",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function apiLogout(Request $request): JsonResponse
    {
        // Dapatkan token dari header Authorization
        $accessToken = $request->bearerToken();

        if ($accessToken) {
            // Cari token di tabel personal_access_tokens
            $token = PersonalAccessToken::findToken($accessToken);
            if ($token) {
                $token->delete();
                return response()->json(['message' => 'Successfully logged out'], 200);
            }
        }

        return response()->json(['message' => 'No valid token found'], 401);
    }
}
