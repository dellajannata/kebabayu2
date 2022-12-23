@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 style="font-family: Georgia, serif;"><i class="fa fa-history"></i> Riwayat Pemesanan</h3>
                        <form class="form" method="get" action="{{ route('caricabang') }}">
                            <div class="form-group w-50 mb-6">
                                <label for="search" class="d-block mr-2">Pencarian Data Transaksi</label>
                                <input type="text" name="cari" class="form-control" id="cari" placeholder="Masukkan Data Transaksi">
                                <button type="submit" class="btn btn-success mb-1">Cari</button>
                            </div>
                        </form>
                        <div class="table-responsive">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pemesan</th>
                                        <th>Status</th>
                                        <th>Jumlah Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($pesanans as $pesanan)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $pesanan->tanggal }}</td>
                                            <td>{{ $pesanan->nama_pemesan }}</td>
                                            <td>
                                                @if ($pesanan->uang_bayar - $pesanan->jumlah_harga < 0)
                                                    Sudah Pesan & Belum dibayar
                                                @else
                                                    Sudah dibayar
                                                @endif
                                            </td>
                                            <td>
                                                Rp. {{ number_format($pesanan->jumlah_harga) }}
                                            </td>
                                            <td>
                                                <a href="{{ url('history') }}/{{ $pesanan->id }}" class="btn btn-primary"><i
                                                        class="fa fa-info"></i>
                                                    Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection