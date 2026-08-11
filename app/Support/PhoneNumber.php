<?php

namespace App\Support;

class PhoneNumber
{
    /**
     * Normalisasi nomor telepon Indonesia ke format 62xxxxxxxxxx
     * (tanpa '+', tanpa leading zero). Dipakai bareng oleh alur
     * registrasi (RegisteredUserController) dan login (LoginRequest),
     * supaya format yang tersimpan di kolom `phone` dan format yang
     * dipakai untuk mencocokkan saat login selalu konsisten.
     */
    public static function normalize(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', ltrim($phone, '+'));

        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        if (str_starts_with($phone, '8')) {
            return '62' . $phone;
        }

        return $phone;
    }
}