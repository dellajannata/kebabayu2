@extends('layouts.app') @section('content') <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('adminCabang') }}">Permintaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Permintaan</li>
                    </ol>
                </nav>
            </div>
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    <Center>KETERANGAN BAHAN BAKU</Center>
                </div>
                <div class="card-body">
                    <ul type="square">
                        <li>1 Paket Kulit Tortila --> 25 biji </li>
                        <li>1 Paket Daging Kebab --> 500 gram </li>
                        <li>1 Paket Roti Burger --> 10 biji </li>
                        <li>1 Paket Sosis --> 10 biji</li>
                        <li>1 Paket Selada --> 25 lembar</li>
                        <li>1 Paket Tomat --> 250 gram</li>
                        <li>1 Paket Timun --> 250 gram</li>
                        <li>1 Paket Mayonaise --> 1 liter</li>
                        <li>1 Paket Saus Sambal --> 1 liter</li>
                        <li>1 Paket Saus Tomat --> 1 liter</li>
                        <li>1 Paket Keju --> 10 slice</li>
                        <li>1 Paket Margarin --> 3 blok</li>
                    </ul>
                </div>
            </div>
            <div style="width: 5rem;">
            </div>
            <br>
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    <Center>EDIT DATA PERMINTAAN BAHAN</Center>
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
                    <form method="post" action="{{ route('adminCabang.update', $gudang->id) }}" id="myForm"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="form-group"> <label for="nama_bahan">Nama Bahan</label>
                            <select class="form-control" name="nama_bahan" id="nama_bahan">
                                <option hidden>Pilih Nama Bahan</option>
                                <option value="Kulit Tortila"
                                    {{ $gudang->nama_bahan == 'Kulit Tortila' ? 'selected' : '' }}>Kulit Tortila</option>
                                <option value="Daging Kebab" {{ $gudang->nama_bahan == 'Daging Kebab' ? 'selected' : '' }}>
                                    Daging Kebab</option>
                                <option value="Sosis" {{ $gudang->nama_bahan == 'Sosis' ? 'selected' : '' }}>Sosis</option>
                                <option value="Selada" {{ $gudang->nama_bahan == 'Selada' ? 'selected' : '' }}>Selada
                                </option>
                                <option value="Tomat" {{ $gudang->nama_bahan == 'Tomat' ? 'selected' : '' }}>Tomat</option>
                                <option value="Timun" {{ $gudang->nama_bahan == 'Timun' ? 'selected' : '' }}>Timun</option>
                                <option value="Mayonaise" {{ $gudang->nama_bahan == 'Mayonaise' ? 'selected' : '' }}>
                                    Mayonaise</option>
                                <option value="Saus Sambal" {{ $gudang->nama_bahan == 'Saus Sambal' ? 'selected' : '' }}>
                                    Saus Sambal</option>
                                <option value="Saus Tomat" {{ $gudang->nama_bahan == 'Saus Tomat' ? 'selected' : '' }}>Saus
                                    Tomat</option>
                                <option value="Roti Burger" {{ $gudang->nama_bahan == 'Roti Burger' ? 'selected' : '' }}>
                                    Roti Burger</option>
                                <option value="Keju" {{ $gudang->nama_bahan == 'Keju' ? 'selected' : '' }}>Keju</option>
                                <option value="Margarine" {{ $gudang->nama_bahan == 'Margarine' ? 'selected' : '' }}>
                                    Margarine</option>
                            </select>
                        </div>
                <div class="form-group"> <label for="jumlah">Jumlah</label> <input type="jumlah" name="jumlah"
                        class="form-control" id="jumlah" value="{{ $gudang->jumlah }}" aria-describedby="jumlah">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br><br><br><br>
                </form>
            </div>
        </div>
    </div>
</div> @endsection
