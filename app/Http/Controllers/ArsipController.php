<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArsipController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            // Admin lihat semua arsip
            $arsips = Arsip::latest()->paginate(10);
        } else {
            // User lihat arsip yang diupload departemennya saja
            $arsips = Arsip::where('departemen', $user->departemen)
                ->latest()
                ->paginate(10);
        }

        return view('arsips.index', compact('arsips'));
    }

    public function create()
    {
        $user = Auth::user();

        return view('arsips.create', [
            'departemen' => $user->departemen,
            'kategori_options' => ['Surat Undangan', 'Surat Peminjaman', 'Proposal', 'LPJ'],
            'departemen_options' => ['MBA', 'PPM', 'PKM', 'ADM', 'KEAGAMAAN', 'HUAL', 'SOSMAS', 'KOMINKRAF'],
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:Surat Undangan,Surat Peminjaman,Proposal,LPJ',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        // Nomor surat wajib kalau kategori surat
        if (in_array($request->kategori, ['Surat Undangan', 'Surat Peminjaman'])) {
            $rules['nomor_surat'] = 'required|string|max:100';
        } else {
            $rules['nomor_surat'] = 'nullable|string|max:100';
        }

        $validated = $request->validate($rules);

        // Simpan file ke storage/app/public/arsip
        $filePath = $request->file('file')->store('arsip', 'public');

        Arsip::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'kategori' => $validated['kategori'],
            'nomor_surat' => $validated['nomor_surat'] ?? null,
            'departemen' => $user->departemen,
            'pengunggah' => $user->name,
            'file_path' => $filePath,
            'tanggal_upload' => now(),
        ]);

        return redirect()->route('arsips.index')->with('success', 'Arsip berhasil ditambahkan!');
    }

    public function show(Arsip $arsip)
    {
        $user = Auth::user();

        // Admin bisa lihat semua, user hanya arsip departemen sendiri
        if ($user->role == 'user' && $arsip->departemen != $user->departemen) {
            abort(403);
        }

        return view('arsips.show', compact('arsip'));
    }

    public function edit(Arsip $arsip)
    {
        $user = Auth::user();

        // User hanya bisa edit arsip departemen sendiri
        if ($user->role == 'user' && $arsip->departemen != $user->departemen) {
            abort(403);
        }

        return view('arsips.edit', [
            'arsip' => $arsip,
            'kategori_options' => ['Surat Undangan', 'Surat Peminjaman', 'Proposal', 'LPJ'],
            'departemen_options' => ['MBA', 'PPM', 'PKM', 'ADM', 'KEAGAMAAN', 'HUAL', 'SOSMAS', 'KOMINKRAF'],
        ]);
    }

    public function update(Request $request, Arsip $arsip)
    {
        $user = Auth::user();

        if ($user->role == 'user' && $arsip->departemen != $user->departemen) {
            abort(403);
        }

        $rules = [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:Surat Undangan,Surat Peminjaman,Proposal,LPJ',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if (in_array($request->kategori, ['Surat Undangan', 'Surat Peminjaman'])) {
            $rules['nomor_surat'] = 'required|string|max:100';
        } else {
            $rules['nomor_surat'] = 'nullable|string|max:100';
        }

        $validated = $request->validate($rules);

        $filePath = $arsip->file_path;

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($arsip->file_path);

            // Simpan file baru
             $filePath = $file->storeAs('arsip', $fileName, 'public');
        }

        $arsip->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'kategori' => $validated['kategori'],
            'nomor_surat' => $validated['nomor_surat'] ?? null,
            'file_path' => $filePath,
        ]);

        return redirect()->route('arsips.index')->with('success', 'Arsip berhasil diupdate!');
    }

    public function destroy(Arsip $arsip)
    {
        $user = Auth::user();

        if ($user->role == 'user' && $arsip->departemen != $user->departemen) {
            abort(403);
        }

        // Hapus file fisik
        Storage::disk('public')->delete($arsip->file_path);

        $arsip->delete();

        return redirect()->route('arsips.index')->with('success', 'Arsip berhasil dihapus!');
    }
}
