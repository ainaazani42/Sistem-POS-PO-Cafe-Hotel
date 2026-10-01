<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    // Menampilkan halaman rekap shift & kasir
    public function index()
    {
        $shifts = Shift::with('user', 'orders')->latest()->get();
        $activeShift = Shift::where('status_shift', 'open')->first();

        return view('kasir.shift', compact('shifts', 'activeShift'));
    }

    // Buka Shift Baru Kasir
    public function openShift(Request $request)
    {
        $request->validate([
            'nama_shift' => 'required|in:shift_1,shift_2',
            'saldo_awal' => 'required|numeric|min:0',
        ]);

        // Cek jika ada shift yang masih terbuka
        $existingShift = Shift::where('status_shift', 'open')->first();
        if ($existingShift) {
            return redirect()->back()->with('error', 'Masih ada shift yang aktif! Tutup shift terlebih dahulu.');
        }

        Shift::create([
            'user_id' => auth()->id(),
            'nama_shift' => $request->nama_shift,
            'tanggal' => now()->toDateString(),
            'saldo_awal' => $request->saldo_awal,
            'total_pendapatan' => 0,
            'status_shift' => 'open',
        ]);

        return redirect()->back()->with('success', 'Shift kasir berhasil dibuka!');
    }

    // Tutup Shift Kasir (Close Shift)
    public function closeShift($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->status_shift = 'closed';
        $shift->save();

        return redirect()->back()->with('success', 'Shift kasir berhasil ditutup!');
    }
}
