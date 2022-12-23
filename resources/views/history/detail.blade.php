@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat Pemesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <h3 style="font-family: Georgia, serif;"><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>
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
                                        <form method="post" action="{{ url('history1/' . $pesanan->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <tr>
                                                <td colspan="6" align="right"><strong>Uang yang telah dibayar:</strong></td>
                                                <td align="right"><strong>Rp.
                                                        {{ number_format($pesanan->uang_bayar) }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"><strong>Total kembalian :</strong></td>
                                                <td align="right"><strong>Rp.
                                                        {{ number_format($pesanan->uang_bayar - $pesanan->jumlah_harga) }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"><strong>Uang Bayar :</strong></td>
                                                <td align="right"><input type="uang_bayar" name="uang_bayar2"
                                                        class="form-control" required=""></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"><strong></strong></td>
                                                <td align="right">
                                                    <button class="btn btn-success" type="submit"
                                                        onclick="return confirm('Hitung kembalian ?');">Bayar
                                                    </button>
                                                </td>
                                                </td>
                                            </tr>
                                        </form>
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