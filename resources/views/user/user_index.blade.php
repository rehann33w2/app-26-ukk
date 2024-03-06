@extends('layouts.app_mazer')
@section('konten')    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.beranda') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> 
<div class="page-content"> 
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">
                        Table User
                    </h5>         
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('user.create') }}" class="btn btn-primary me-2"><i class="fa-solid fa-plus"></i>Tambah</a>
                    </div>
                    <div class="form-outline" data-mdb-input-init>
                        <form action="{{ route('user.index') }}" method="GET">
                            <div class="mb-3 mt-3 d-flex justify-content-between">
                                <select class="form-select w-25" name="akses" id="">
                                    <option value="">All</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">petugas</option>
                                    <option value="peminjam">Peminjam</option>
                                </select>
                                <div class="input-group">
                                    <input type="search" id="form1" name="keyword" class="form-control" placeholder="Search...." aria-label="Search" />
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-minimal">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Akses</th>
                                    <th>Aksi</th>        
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model as $item)  
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if ($item->akses == 'admin')
                                            <span class="badge bg-primary">{{ $item->akses }}</span>
                                        @elseif ($item->akses == 'petugas')
                                            <span class="badge bg-success">{{ $item->akses }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $item->akses }}</span>
                                        @endif
                                    </td>           
                                    <td>                                    
                                        <a href="{{ route( $routePrefix.'.edit',$item->id ) }}" class="btn btn-warning me-1"><i class="fa-solid fa-pen-to-square text-white"></i>Edit</a>
                                        <form method="POST" action="{{ url('/operator/user' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}  
                                            <button type="submit" class="btn btn-danger" title="Hapus Pengguna Ini?" onclick="return confirm(&quot;Hapus Data?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{ $model->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
import { Input, initMDB } from "mdb-ui-kit";

initMDB({ Input });
</script>
@endsection