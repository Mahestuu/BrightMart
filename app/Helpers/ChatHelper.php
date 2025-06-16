<?php

if (!function_exists('sanitize_chat_input')) {
    /**
     * Membersihkan input chat dari XSS dan karakter berbahaya
     */
    function sanitize_chat_input(string $input): string
    {
        $cleaned = htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
        return str_replace(["\r", "\n"], [' ', ' '], $cleaned);
    }
}