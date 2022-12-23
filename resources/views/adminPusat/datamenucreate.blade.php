@extends('adminPusat.app')
@section('content') <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    <Center>TAMBAH DATA MENU</Center>
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
                    <form method="post" action="{{ route('adminMenu.store') }}" id="myForm" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group"> <label for="gambar">Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambar"
                                aria-describedby="gambar">
                        </div>
                        <div class="form-group"> <label for="nama_menu">Nama Menu</label> <input type="nama_menu"
                                name="nama_menu" class="form-control" id="nama_menu" aria-describedby="nama_menu"> </div>
                        <div class="form-group"> <label for="harga">Harga</label> <input type="harga" name="harga"
                                class="form-control" id="harga" aria-describedby="harga"> </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</div> @endsection