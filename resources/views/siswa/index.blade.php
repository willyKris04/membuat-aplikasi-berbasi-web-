@extends('layouts.app')
@section('judul', 'Dashboard Siswa')

@section('isi')
    <section class="banner">
        <div>
            <small>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</small>
            <h2>Selamat datang kembali, Admin!</h2>
            <p>Kelola data siswa dengan mudah di satu tempat.</p>
        </div>
        <svg viewBox="0 0 160 120" aria-hidden="true">
            <circle cx="130" cy="20" r="6" fill="#fff" opacity=".5"/>
            <circle cx="20" cy="95" r="9" fill="#fff" opacity=".25"/>
            <path d="M80 18L10 52l70 34 70-34z" fill="#2b2442"/>
            <path d="M38 66v24c0 8 19 18 42 18s42-10 42-18V66L80 82z" fill="#473a73"/>
            <path d="M146 54v36" stroke="#f5b942" stroke-width="4" stroke-linecap="round"/>
            <circle cx="146" cy="94" r="6" fill="#f5b942"/>
        </svg>
    </section>

    <section class="stats">
        <div class="stat">
            <div class="ikon">
                <svg class="ic" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <strong>{{ $total }}</strong>
            <span>Total siswa</span>
        </div>
        <div class="stat sorot">
            <div class="ikon">
                <svg class="ic" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1"/></svg>
            </div>
            <strong>{{ $lakiLaki }}</strong>
            <span>Siswa laki-laki</span>
        </div>
        <div class="stat">
            <div class="ikon">
                <svg class="ic" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1"/></svg>
            </div>
            <strong>{{ $perempuan }}</strong>
            <span>Siswa perempuan</span>
        </div>
    </section>

    <section class="card">
        <div class="card-head">
            <h2>{{ $cari ? 'Hasil pencarian "' . e($cari) . '"' : 'Daftar siswa' }}</h2>
            <a class="btn" href="{{ route('siswa.create') }}">Tambah siswa</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th><th>NIS</th><th>L/P</th><th>Tanggal lahir</th><th>Kelas</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $s)
                        <tr>
                            <td>
                                <div class="nama">
                                    <span class="avatar">{{ strtoupper(mb_substr($s->nama, 0, 1)) }}</span>
                                    {{ $s->nama }}
                                </div>
                            </td>
                            <td>{{ $s->nis }}</td>
                            <td><span class="chip {{ $s->jenis_kelamin === 'P' ? 'p' : '' }}">{{ $s->jenis_kelamin }}</span></td>
                            <td>{{ $s->tanggal_lahir->format('d/m/Y') }}</td>
                            <td>{{ $s->kelas }}</td>
                            <td>
                                <div class="aksi">
                                    <a class="btn ghost small" href="{{ route('siswa.edit', $s->id) }}">Ubah</a>
                                    <form method="POST" action="{{ route('siswa.destroy', $s->id) }}"
                                          onsubmit="return confirm('Hapus data {{ e($s->nama) }}? Tindakan ini tidak bisa dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn danger small" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="kosong">
                            {{ $cari ? 'Tidak ada siswa yang cocok dengan pencarian.' : 'Belum ada data siswa. Klik "Tambah siswa" untuk memulai.' }}
                        </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($siswa->hasPages())
            <div class="paging">
                <span>Halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }} ({{ $siswa->total() }} siswa)</span>
                <span class="aksi">
                    @if ($siswa->previousPageUrl())<a class="btn ghost small" href="{{ $siswa->previousPageUrl() }}">Sebelumnya</a>@endif
                    @if ($siswa->nextPageUrl())<a class="btn ghost small" href="{{ $siswa->nextPageUrl() }}">Berikutnya</a>@endif
                </span>
            </div>
        @endif
    </section>
@endsection