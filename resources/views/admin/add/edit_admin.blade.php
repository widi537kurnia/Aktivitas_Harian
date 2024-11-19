@extends('layout.main_admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard_admin') }}">Beranda</a></li>
              <li class="breadcrumb-item active">Edit Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.add.create_admin',['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <a href="{{ route('admin.jumlah_admin') }}" class="btn btn-secondary mb-3">Kembali</a>
                      <!-- general form elements -->
                      <div class="card card-primary">
                        <div class="card-header" style="background-color: #b11313;">
                          <h3 class="card-title">Form Edit User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                          <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Admin</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $data->name }}" placeholder="Masukkan Nama Admin">
                                @error('name')
                                <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $data->email }}" placeholder="Masukkan Email">
                              @error('email')
                                <small>{{ $message }}</small>
                              @enderror
                            </div>
                            <div class="form-group">
                                <label for="divisi">Divisi</label>
                                <select class="form-control" id="divisi" name="divisi">
                                    <option value="web">Web</option>
                                    <option value="desain">Desain</option>
                                    <option value="video">Video</option>
                                </select>
                                @error('divisi')
                                    <small>{{ $message }}</small>
                                @enderror
                              </div>
                          </div>
                          <!-- /.card-body -->

                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                      <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                  </div>
            </form>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>

  </div>

@endsection
