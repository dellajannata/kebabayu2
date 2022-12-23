@extends('adminPusat.app')
@section('content')
    <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('adminPusatKaryawan') }}">Data Karyawan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data Karyawan</li>
            </ol>
        </nav>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    <Center>TAMBAH DATA KARYAWAN</Center>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger"> <strong>Whoops!</strong> There were some problems with your
                            input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('adminPusatKaryawan.store') }}" id="myForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"> <label for="name">Nama</label>
                            <input type="name" name="name" class="form-control" id="name"
                                aria-describedby="name">
                        </div>
                        <div class="form-group"> <label for="email">Email</label> <input type="email" name="email"
                                class="form-control" id="email" aria-describedby="email"> </div>
                        <div class="form-group"> <label for="level">Jabatan</label> <input type="level" name="level"
                                class="form-control" id="level" aria-describedby="level"> </div>
                        <div class="form-group"> <label for="password">Password</label> <input type="password"
                                name="password" class="form-control action-focus focus" id="password"
                                aria-describedby="password"> </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</div> @endsection