<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    // READ: dashboard + daftar siswa + pencarian
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        $siswa = Siswa::query()
            ->when($cari, function ($q) use ($cari) {
                $q->where(function ($w) use ($cari) {
                    $w->where('nama', 'like', "%{$cari}%")
                      ->orWhere('nis', 'like', "%{$cari}%")
                      ->orWhere('kelas', 'like', "%{$cari}%");
                });
            })
            ->orderBy('nama')
            ->paginate(10)
            ->appends($request->query());

        $total = Siswa::count();
        $lakiLaki = Siswa::where('jenis_kelamin', 'L')->count();
        $perempuan = Siswa::where('jenis_kelamin', 'P')->count();

        return view('siswa.index', compact('siswa', 'cari', 'total', 'lakiLaki', 'perempuan'));
    }

    // Form tambah siswa
    public function create()
    {
        return view('siswa.create');
    }

    // INSERT
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        Siswa::create($data);

        return redirect()->route('siswa.index')
            ->with('sukses', 'Data siswa berhasil ditambahkan.');
    }

    // Form ubah siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('siswa.edit', compact('siswa'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $data = $request->validate($this->rules($siswa->id));

        $siswa->update($data);

        return redirect()->route('siswa.index')
            ->with('sukses', 'Data siswa berhasil diperbarui.');
    }

    // DELETE
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('sukses', 'Data siswa berhasil dihapus.');
    }

    private function rules($id = null)
    {
        return [
            'nis' => ['required', 'string', 'max:20', Rule::unique('siswa', 'nis')->ignore($id)],
            'nama' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'kelas' => ['required', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ];
    }
}