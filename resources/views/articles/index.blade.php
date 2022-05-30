@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Article</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Article</h6>
            <div class="col text-right">
                <a href="{{ route('article.create') }}" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Categorie</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->categories->name }}</td>
                                <td>{{ $article->content }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$article->image) }}" alt="" width="50px">
                                </td>
                                <td align="center">
                                    <a href="{{ route('article.edit', $article->id) }}"
                                        class="btn btn-info btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href=""
                                        class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        @empty($article)
                            <tr>
                                <td colspan="5" align="center">Tidak ada data</td>
                            </tr>
                        @endempty
                    </tbody>
                </table>
            </div>

            {{ $articles->links() }}
        </div>
    </div>
</div>

@endsection