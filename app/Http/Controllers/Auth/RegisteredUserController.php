<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\PhoneNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $normalizedPhone = PhoneNumber::normalize($request->input('phone'));
        $request->merge(['phone' => $normalizedPhone]);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:'.User::class,
            'email' => 'nullable|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'registered_at' => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->sendPostRegistrationCTA($user->phone);

        return redirect(route('dashboard', absolute: false));
    }

    private function sendPostRegistrationCTA(string $phone): void
    {
        $backendUrl = env('BOT_BACKEND_URL', 'http://localhost:3000');
        $apiKey = env('BOT_API_KEY', '');

        $payload = [
            'phone' => $phone,
            'header_image_url' => env('REGISTER_HEADER_IMAGE_URL', ''),
            'body_text' => "*Pendaftaran Berhasil* 🎊\n\nSelamat, kamu berhasil melakukan pendaftaran!\n\n> Ketik \"help\" untuk melihat panduan singkat penggunaan atau klik tautan di bawah ini untuk melihat panduan lengkap penggunaan.\n\n\nRegards,",
            'footer_text' => 'Lumi Assistant Team',
            'button_text' => 'View Details',
            'button_url' => 'https://assistant.lumiverse.co.id/panduan',
        ];

        Http::withHeaders([
            'X-BOT-API-KEY' => $apiKey,
            'Accept' => 'application/json',
        ])->post($backendUrl.'/internal/send-cta', $payload);
    }
}