@extends('layouts.app_mazer')
@section('konten')
    <table class="table table-dark">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            {{-- @foreach ($bukus as $buku) --}}
            <tr>
                <td>{{ $no++ }}</td>
                <td>hUJAN</td>
                <td>Novel</td>
                <td>SHANDY</td>
                <td>Gramedia</td>
                <td>
                    <a href="" class="btn btn-danger" type="button">Pinjam</a>
                    <a href="" class="btn btn-primary" type="button">Detail</a>
                    <a href="" class="btn btn-warning" type="button">tambah ke koleksi</a>
                    {{-- <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">Edit</a>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form> --}}
                </td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
@endsection
