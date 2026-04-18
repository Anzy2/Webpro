<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan halaman utama.
     */
    public function index()
    {
        return view('mahasiswa.index');
    }

    /**
     * Membaca file JSON dan mengembalikan data mahasiswa.
     */
    public function getData(): JsonResponse
    {
        $filePath = base_path('data/mahasiswa.json');

        if (!file_exists($filePath)) {
            return response()->json([
                'success' => false,
                'message' => 'File data tidak ditemukan.',
                'data'    => []
            ], 404);
        }

        $jsonContent = file_get_contents($filePath);
        $mahasiswa   = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'success' => false,
                'message' => 'Format JSON tidak valid.',
                'data'    => []
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dimuat.',
            'total'   => count($mahasiswa),
            'data'    => $mahasiswa
        ]);
    }
}
