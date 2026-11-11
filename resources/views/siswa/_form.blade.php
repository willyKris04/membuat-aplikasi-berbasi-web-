@php $s = $siswa ?? new \App\Models\Siswa; @endphp
<div class="grid">
    <div class="field">
        <label for="nis">NIS</label>
        <input id="nis" name="nis" value="{{ old('nis', $s->nis) }}" required>
        @error('nis')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
        <label for="nama">Nama lengkap</label>
        <input id="nama" name="nama" value="{{ old('nama', $s->nama) }}" required>
        @error('nama')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
        <label for="jenis_kelamin">Jenis kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="">Pilih</option>
            <option value="L" {{ old('jenis_kelamin', $s->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jenis_kelamin', $s->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
        <label for="tanggal_lahir">Tanggal lahir</label>
        <input id="tanggal_lahir" type="date" name="tanggal_lahir"
               value="{{ old('tanggal_lahir', optional($s->tanggal_lahir)->format('Y-m-d')) }}" required>
        @error('tanggal_lahir')<div class="error">{{ $message }}</div>@enderror
    </div>
    <div class="field">
        <label for="kelas">Kelas</label>
        <input id="kelas" name="kelas" value="{{ old('kelas', $s->kelas) }}" placeholder="Contoh: X IPA 1" required>
        @error('kelas')<div class="error">{{ $message }}</div>@enderror
    </div>
</div>
<div class="field">
    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="3">{{ old('alamat', $s->alamat) }}</textarea>
    @error('alamat')<div class="error">{{ $message }}</div>@enderror
</div>