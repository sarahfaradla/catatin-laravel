@extends('layouts.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/upload.css') }}">

@php($edit = $catatan->exists)

<form action="{{ $edit ? route('catatan.update', $catatan) : route('catatan.store') }}" method="POST">
    @csrf
    @if ($edit) @method('PUT') @endif

    <div class="card-form">
        @if ($errors->any())
            <div class="alert-galat" role="alert">
                <ul>@foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="form-group">
            <label for="judul">Judul catatan</label>
            <input type="text" id="judul" name="judul" maxlength="150"
                   value="{{ old('judul', $catatan->judul) }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="matkul">Mata kuliah</label>
                <input type="text" id="matkul" name="matkul" maxlength="100"
                       value="{{ old('matkul', $catatan->matkul) }}" required>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select id="jurusan" name="jurusan" required>
                    @foreach ($jurusan as $j)
                        <option value="{{ $j }}" @selected(old('jurusan', $catatan->jurusan) === $j)>{{ $j }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <span class="label-teks">Tipe berkas</span>
            <div class="pill-group">
                @foreach ($categories as $c)
                    <label class="pill-btn">
                        <input type="radio" name="category_id" value="{{ $c->id }}"
                               @checked((int) old('category_id', $catatan->category_id) === $c->id)>
                        <span>{{ $c->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <span class="label-teks">Visibilitas</span>
            <div class="pill-group dua-kolom">
                @foreach (['pribadi' => 'Pribadi', 'publik' => 'Publik'] as $nilai => $label)
                    <label class="pill-btn">
                        <input type="radio" name="visibilitas" value="{{ $nilai }}"
                               @checked(old('visibilitas', $catatan->visibilitas) === $nilai)>
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            <small class="bantuan-teks">Pribadi: hanya kamu yang bisa melihat. Publik: bisa dilihat pengguna lain setelah catatan terbit.</small>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi singkat</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" maxlength="255" required>{{ old('deskripsi', $catatan->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="tautan">Tautan berkas</label>
            <input type="text" id="tautan" name="tautan" maxlength="500"
                   value="{{ old('tautan', $catatan->tautan) }}" placeholder="https://drive.google.com/..." required>
        </div>

        <div class="form-group checkbox-group" id="grup-anonim">
            <label class="checkbox-container">
                <input type="checkbox" id="is_anonim" name="anonim" value="1"
                       @checked(old('anonim', $catatan->anonim))>
                Unggah sebagai anonim (hanya berlaku untuk catatan publik)
            </label>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('catatan.index') }}" class="btn-batal">Batal</a>
        <button type="submit" class="btn-primary">{{ $edit ? 'Perbarui catatan' : 'Simpan catatan' }}</button>
    </div>
</form>

<script src="{{ asset('js/upload.js') }}"></script>
@endsection

