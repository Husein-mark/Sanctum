<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    /**
     * GET /api/catatan
     * Tampilkan daftar catatan milik akun yang sedang login.
     */
    public function index(Request $request)
    {
        $catatan = $request->user()
            ->catatan()
            ->latest()
            ->get();

        return response()->json([
            'catatan' => $catatan,
        ]);
    }

    /**
     * POST /api/catatan
     * Simpan catatan pribadi. user_id ditentukan dari akun terautentikasi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:100'],
            'isi'   => ['required', 'string'],
        ]);

        $catatan = $request->user()->catatan()->create($validated);

        return response()->json([
            'message' => 'Catatan berhasil disimpan.',
            'catatan' => $catatan,
        ], 201);
    }
}
