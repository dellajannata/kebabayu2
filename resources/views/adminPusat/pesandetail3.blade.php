@extends('adminPusat.app')
@section('content')
    <div class="col-md-12 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('adminPusatPesan3') }}">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>
                        @if (!empty($pesanan))
                            <p align="left"><Strong>Nama Pemesan :
                                    {{ $pesanan->nama_pemesan }}
                            </p>
                            <p align="left">Tanggal : {{ $pesanan->tanggal }}</p>
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
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" align="right"><strong>Total yang harus dibayar :</strong></td>
                                            <td align="right"><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align="right"><Strong>Uang Bayar :</Strong></td>
                                            <td align="right"><strong>Rp. {{ number_format($pesanan->uang_bayar) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align="right"><strong>Total kembalian :</strong></td>
                                            <td align="right"><strong>Rp.
                                                    {{ number_format($pesanan->uang_bayar - $pesanan->jumlah_harga) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection