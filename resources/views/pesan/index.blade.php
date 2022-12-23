@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $menu->menu1->nama_menu }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $menu->menu1->gambar) }}" class="img-fluid rounded mx-auto d-block"
                                     alt="">
                            </div>
                            <div class="col-md-6 mt-5">
                                <h2>{{ $menu->menu1->nama_menu }} (Rp. {{ number_format($menu->menu1->harga) }})</h2>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td>{{ number_format($menu->stok) }}</td>
                                </tr>
                                <form method="post" action="{{ url('pesan') }}/{{ $menu->id }}">
                                    @csrf
                                    <div class="table-responsive">

                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Jumlah Pesan</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="number" name="jumlah_pesan" class="form-control"
                                                            required="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" name="catatan_pesan" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-shopping-cart"></i>
                                        Masukkan Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection