<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PhoneVerificationController extends Controller
{
    public function send(Request $request)
    {
        // Verification-only flow: do not persist the phone number here.
        // The phone is only used to send a WhatsApp verification message.
        $data = $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = preg_replace('/[^0-9]/', '', ltrim($data['phone'], '+'));
        // Normalisasi: ubah awalan 0 atau 8 menjadi kode negara 62 (Indonesia)
        if (strlen($phone) > 0) {
            if (strpos($phone, '0') === 0) {
                $phone = '62' . substr($phone, 1);
            } elseif (strpos($phone, '8') === 0) {
                $phone = '62' . $phone;
            }
        }

        $backendUrl = env('BOT_BACKEND_URL', 'http://localhost:3000/internal/send-verification');
        $apiKey = env('BOT_API_KEY', '');

        $payload = [
            'phone' => $phone,
            'message' => 'Verifikasi berhasil ✅',
        ];

        $req = Http::withHeaders([
            'X-BOT-API-KEY' => $apiKey,
            'Accept' => 'application/json',
        ])->post($backendUrl, $payload);

        if ($req->successful()) {
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'error', 'detail' => $req->body()], $req->status());
    }
}
