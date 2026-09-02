<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebhookService
{
    public function send(string $url, array $payload, string $secret)
    {
        $json = json_encode($payload);

        $signature = hash_hmac(
            'sha256',
            $json,
            $secret
        );
        return Http::withHeaders([
            'X-Webhook-Signature'=> $signature,
            'Content-Type' => 'application/json',
        ])->post($url,$payload);
    }
}
