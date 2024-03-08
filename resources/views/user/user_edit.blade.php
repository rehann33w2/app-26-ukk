@extends('layouts.app_mazer')
@section('konten')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.beranda') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Data User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah User</h4>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($models, ['route' => ['user.update', $models->id], 'method' => 'PUT']) !!}
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Nama Lengkap</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="name" value="{{ $models->name }}">
                                                @error('name')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email-id-vertical" class="form-control"
                                                    name="email" value="{{ $models->email }}">
                                                @error('email')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="Password">Password</label><span class="text-danger"> (password
                                                    akan diubah)</span>
                                                <input type="password" id="first-name-vertical" class="form-control"
                                                    name="password">
                                                @error('password')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="akses">Role</label>
                                                <select class="form-select" name="akses"
                                                    aria-label="Default select example">
                                                    <option selected>{{ $models->akses }}</option>
                                                    @if ($models->akses == 'admin')
                                                        <option value="operator">Operator</option>
                                                        <option value="peminjam">Peminjam</option>
                                                    @elseif ($models->akses == 'operator')
                                                        <option value="peminjam">Peminjam</option>
                                                        <option value="admin">Admin</option>
                                                    @else
                                                        <option value="admin">Admin</option>
                                                        <option value="operator">Operator</option>
                                                    @endif
                                                </select>
                                                @error('title')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1"><i
                                                    class="fa fa-save"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
