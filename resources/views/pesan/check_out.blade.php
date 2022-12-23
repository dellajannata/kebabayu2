@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="col-12" style="font-family: Georgia, serif;"><i class="fa fa-shopping-cart"></i> Check Out</h2>
                        @if (!empty($pesanan))
                            <a href="{{ url('home') }}" class="btn btn-primary">
                                <i lass="bi bi-plus"></i> Tambah
                            </a>
                            <div class="table-responsive">

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Menu</th>
                                            <th>Jumlah</th>
                                            <th>Catatan</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($pesanan_details as $pesanan_detail)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $pesanan_detail->menu->menu1->gambar) }}"
                                                        width="100" height="75" alt="...">
                                                </td>
                                                <td>{{ $pesanan_detail->menu->menu1->nama_menu }}</td>
                                                <td>{{ $pesanan_detail->jumlah }} </td>
                                                <td>{{ $pesanan_detail->catatan }} </td>
                                                <td>Rp. {{ number_format($pesanan_detail->menu->menu1->harga) }}</td>
                                                <td>Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                                                <td>
                                                    <form action="{{ url('check-out') }}/{{ $pesanan_detail->id }}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Anda yakin akan menghapus data ?');"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7" align="right"><strong>Total Harga :</strong></td>
                                            <td><strong>Rp.
                                                    {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <form method="post" action="{{ url('konfirmasi-check-out') }}">
                                @csrf
                                <p align="left"><Strong>Nama Pemesan :
                                        <input type="text" name="nama_pemesan2" class="form-control" required="">
                                </p>
                                <p align="left">Tanggal : {{ $pesanan->tanggal }}</p>
                                <hr>
                                <td>
                                    <button class="btn btn-success" type="submit"
                                        onclick="return confirm('Anda yakin akan Check Out ?');">
                                        <i class="fa fa-shopping-cart"></i> Check Out
                                    </button>
                                </td>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection