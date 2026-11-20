<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    private array $jurusan = ['Informatika', 'Sistem Informasi', 'Teknik Komputer', 'Elektro'];

    private function aturan(): array
    {
        return [
            'judul'       => 'required|max:150',
            'matkul'      => 'required|max:100',
            'jurusan'     => 'required|in:' . implode(',', $this->jurusan),
            'category_id' => 'required|exists:categories,id',
            'deskripsi'   => 'required|max:255',
            'tautan'      => 'required|url|max:500',
            'visibilitas' => 'required|in:pribadi,publik',
            'anonim'      => 'nullable|boolean',
        ];
    }

    public function index()
    {
        $catatanSaya = Auth::user()->catatans()->with('category')->latest()->get();
        return view('user.catatan', compact('catatanSaya'));
    }

    public function create()
    {
        return view('catatan.unggah', [
            'catatan'    => new Catatan(['visibilitas' => 'pribadi']),
            'categories' => Category::all(),
            'jurusan'    => $this->jurusan,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan());
        $data['anonim'] = $request->boolean('anonim') && $data['visibilitas'] === 'publik';

        auth()->user()->catatans()->create($data);   // user_id terisi otomatis

        return redirect()->route('user.catatan')->with('sukses', 'Catatan berhasil disimpan.');
    }

    public function edit(Catatan $catatan)
    {
        abort_if($catatan->user_id !== auth()->id(), 404);

        return view('catatan.unggah', [
            'catatan'    => $catatan,
            'categories' => Category::all(),
            'jurusan'    => $this->jurusan,
        ]);
    }

    public function update(Request $request, Catatan $catatan)
    {
        abort_if($catatan->user_id !== Auth::id(), 404);

        $data = $request->validate($this->aturan());
        $data['anonim'] = $request->boolean('anonim') && $data['visibilitas'] === 'publik';

        $catatan->update($data);

        return redirect()->route('user.catatan')->with('sukses', 'Catatan berhasil diperbarui.');
    }

    public function destroy(Catatan $catatan)
    {
        abort_if($catatan->user_id !== Auth::id(), 404);

        $catatan->delete();

        return redirect()->route('catatan.index')->with('sukses', 'Catatan berhasil dihapus.');
    }
}


