<?php

namespace App\Console\Commands;

use App\Models\ChatMessage;
use Illuminate\Console\Command;

class CleanupExpiredChats extends Command
{
    protected $signature = 'chats:cleanup';
    protected $description = 'Clean up expired guest chat messages';

    public function handle(): void
    {
        $count = chatmessage::where('expires_at', '<', now())->delete();
        $this->info("Cleaned up {$count} expired messages");
    }
}