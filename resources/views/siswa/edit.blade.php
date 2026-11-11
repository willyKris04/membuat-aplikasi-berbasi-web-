@extends('layouts.app')
@section('judul', 'Ubah Siswa')

@section('isi')
    <section class="card">
        <div class="card-head"><h2>Ubah data siswa</h2></div>
        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}">
            @csrf
            @method('PUT')
            @include('siswa._form')
            <button class="btn" type="submit">Simpan perubahan</button>
            <a class="btn ghost" href="{{ route('siswa.index') }}">Batal</a>
        </form>
    </section>
@endsection