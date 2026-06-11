<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Str;

class JwtService
{
    protected string $secret;

    public function __construct()
    {
        $this->secret = config('app.key') ?: 'base64:fallback_secret_key_12345678901234567890123456789012';
    }

    /**
     * @param array $payload Data yang ingin disimpan di dalam token.
     * @param int $expirySeconds Durasi masa aktif token dalam detik (default 3600 detik / 1 jam).
     * @return string Token JWT lengkap dengan format header.payload.signature.
     */
    public function encode(array $payload, int $expirySeconds = 3600): string
    {
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);

        $payload['iat'] = time();
        $payload['exp'] = time() + $expirySeconds;
        $payload['jti'] = Str::random(16);

        $payloadJson = json_encode($payload);

        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payloadJson);

        $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $this->secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
    }

    /**
     * @param string $jwt Token JWT yang akan divalidasi.
     * @return array|null Payload data jika valid, atau null jika tidak valid/kedaluwarsa.
     */
    public function decode(string $jwt): ?array
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return null;
        }

        [$base64UrlHeader, $base64UrlPayload, $base64UrlSignature] = $parts;

        $signature = $this->base64UrlDecode($base64UrlSignature);
        $expectedSignature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $this->secret, true);

        if (!hash_equals($signature, $expectedSignature)) {
            return null;
        }

        $payloadJson = $this->base64UrlDecode($base64UrlPayload);
        $payload = json_decode($payloadJson, true);

        if (!$payload) {
            return null;
        }

        if (isset($payload['exp']) && $payload['exp'] < time()) {
            return null;
        }

        return $payload;
    }

    private function base64UrlEncode(string $data): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    private function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
    }
}
