<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    /**
     * Terima dan validasi pesan kontak via AJAX.
     * Endpoint: POST /contact
     */
    public function send(Request $request): JsonResponse
    {
        // ---- Validasi menggunakan Laravel Validator ----
        $validated = $request->validate([
            'nama'   => ['required', 'string', 'min:2',  'max:100'],
            'email'  => ['required', 'email',  'max:150'],
            'subjek' => ['required', 'string', 'min:3',  'max:200'],
            'pesan'  => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            // Pesan error kustom (Bahasa Indonesia)
            'nama.required'   => 'Nama wajib diisi.',
            'nama.min'        => 'Nama minimal 2 karakter.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'subjek.min'      => 'Subjek minimal 3 karakter.',
            'pesan.required'  => 'Pesan wajib diisi.',
            'pesan.min'       => 'Pesan minimal 10 karakter.',
        ]);

        // ---- Simpan pesan ke file JSON (storage/app/messages.json) ----
        $storagePath = 'messages.json';
        $messages    = [];

        if (Storage::exists($storagePath)) {
            $messages = json_decode(Storage::get($storagePath), true) ?? [];
        }

        $messages[] = [
            'id'        => Str::uuid()->toString(),
            'nama'      => $validated['nama'],
            'email'     => $validated['email'],
            'subjek'    => $validated['subjek'],
            'pesan'     => $validated['pesan'],
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'ip'        => $request->ip(),
        ];

        $saved = Storage::put(
            $storagePath,
            json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        if (! $saved) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan pesan. Coba lagi nanti.',
            ], 500);
        }

        // ---- (Opsional) Kirim email notifikasi ----
        // Mail::to('titaniofrancy@gmail.com')->send(new ContactMail($validated));

        return response()->json([
            'success' => true,
            'message' => "Terima kasih, {$validated['nama']}! Pesan Anda telah diterima. Saya akan segera menghubungi Anda.",
        ]);
    }
}
