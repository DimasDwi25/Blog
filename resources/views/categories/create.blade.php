@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Article</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Article</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <div class="row mb-3">
                            <div class="col text-right">
                            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <form action="{{ route('categorie.store') }}" method="POST" enctype="multipart/form-data">
                                      @csrf

                                      <div class="form-group">
                                        <label for="exampleInputUsername1">Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                      </div>

                                      <div class="text-right">
                                          <button type="submit" class="btn btn-success text-right">Simpan</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
