@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Kategori</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
            <div class="col text-right">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Name</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorie as $categories)
                        <tr>
                            <td>{{ $categories->id }}</td>
                            <td>{{ $categories->name }}</td>
                            <td align="center">
                                <a href=""
                                    class="btn btn-info btn-circle" data-toggle="modal" data-target="#modal-edit{{ $categories->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('categorie.destroy', $categories->id) }}"
                                    class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        {{-- modal edit data --}}
                        @include('categories.modal.editModal')
                        @endforeach

                        @empty($categories)
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                        @endempty
                    </tbody>
                </table>
            </div>

            {{ $categorie->links() }}
        </div>
    </div>
</div>

<!-- modal edit data-->
@include('categories.modal.addModal')



@endsection