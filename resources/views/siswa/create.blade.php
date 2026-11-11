@extends('layouts.app')
@section('judul', 'Tambah Siswa')

@section('isi')
    <section class="card">
        <div class="card-head"><h2>Tambah siswa</h2></div>
        <form method="POST" action="{{ route('siswa.store') }}">
            @csrf
            @include('siswa._form')
            <button class="btn" type="submit">Simpan siswa</button>
            <a class="btn ghost" href="{{ route('siswa.index') }}">Batal</a>
        </form>
    </section>
@endsection