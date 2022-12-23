@extends('adminPusat.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <h2 class="col-12 text-center" style="font-family: Georgia, serif;font-size:23px">Data Transaksi</h2>
                <h4 class="col-12 text-center" style="font-family: Georgia, serif;font-size:20px">Cabang 1</h4>
            </div>
            <br><br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form class="form" method="get" action="{{ route('caripesanpusat1') }}">
                <div class="form-group w-50 mb-6">
                    <label for="search" class="d-block mr-2">Pencarian Data Transaksi</label>
                    <input type="text" name="cari" class="form-control" id="cari"
                        placeholder="Masukkan Data Transaksi">
                    <button type="submit" class="btn btn-success mb-1">Cari</button>
                </div>
            </form>
            <div class="table-responsive">

                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jumlah Harga</th>
                        <th width="280px">Action</th>
                    </tr>
                    <?php $no = 1; ?>
                    @foreach ($pesanan as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->tanggal }}</td>
                            <td>
                                @if ($p->uang_bayar - $p->jumlah_harga < 0)
                                    Sudah Pesan & Belum dibayar
                                @else
                                    Sudah dibayar
                                @endif
                            </td>
                            <td>{{ $p->jumlah_harga }}</td>
                            <td>
                                <form action="{{ route('adminPusatPesan.destroy', $p->id) }}" method="POST"> <a>
                                        <a class="btn btn-primary"
                                            href="{{ route('adminPusatPesan.show', $p->id) }}">Details</a>
                                        @csrf
                                        @method('DELETE') <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Anda yakin akan menghapus data ?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $pesanan->links() }}
            <br>
        @endsection