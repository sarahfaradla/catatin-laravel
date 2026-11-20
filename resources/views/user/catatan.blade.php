@extends('layouts.user')

@section('content')
<link rel="stylesheet" href="{{ asset('css/catatan_saya.css') }}">

@if (session('sukses'))
    <div class="toast" role="status" data-auto>{{ session('sukses') }}</div>
@endif

<div class="tabel-container">
    <table class="tabel-catatan">
        <thead>
            <tr><th>Judul</th><th>Tipe</th><th>Visibilitas</th><th>Upvote</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($catatanSaya as $item)
                <tr>
                    <td class="td-judul">{{ $item->judul }}</td>
                    <td><span class="badge badge-rangkuman">{{ $item->category->name }}</span></td>
                    <td>
                        @if ($item->visibilitas === 'publik')
                            <span class="badge badge-publik">Publik{{ $item->anonim ? ' · Anonim' : '' }}</span>
                        @else
                            <span class="badge badge-pribadi">Pribadi</span>
                        @endif
                    </td>
                    <td>{{ $item->upvote }}</td>
                    <td class="td-aksi">
                        <a href="{{ route('catatan.edit', $item) }}" class="btn-aksi btn-edit">Edit</a>
                        <form action="{{ route('catatan.destroy', $item) }}" method="POST" class="form-hapus"
                              onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-aksi btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="td-kosong">
                        Belum ada catatan. <a href="{{ route('catatan.create') }}">Unggah catatan pertamamu</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="{{ asset('js/catatan_saya.js') }}"></script>
@endsection