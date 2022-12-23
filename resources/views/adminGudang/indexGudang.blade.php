@extends('adminGudang.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <h2 class="col-12 text-center" style="font-family: Georgia, serif;">Data Permintaan Bahan</h2>
                <h4 class="col-12 text-center" style="font-family: Georgia, serif;">Cabang 1</h4>
            </div>
            <br><br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form class="form" method="get" action="{{ route('cari') }}">
                <div class="form-group w-50 mb-6">
                    <label for="search" class="d-block mr-2">Pencarian Data Bahan</label>
                    <input type="text" name="cari" class="form-control" id="cari"
                        placeholder="Masukkan Data Bahan">
                    <button type="submit" class="btn btn-success mb-1">Cari</button>
                </div>
            </form>
            <div class="table-responsive">

                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Nama Bahan</th>
                        <th>Jumlah</th>
                        <th>Tanggal Permintaan</th>
                        <th>Status</th>
                        <th width="280px">Action</th>
                    </tr>
                    <?php $no = 1; ?>
                    @foreach ($gudang as $g)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $g->nama_bahan }}</td>
                            <td>{{ $g->jumlah }}</td>
                            <td>{{ $g->tgl_request }}</td>
                            <td>
                                @if ($g->status == 'selesai')
                                    Dikirim
                                @elseif($g->status == 'batal')
                                    Dibatalkan
                                @else
                                    Diproses
                                @endif
                            </td>
                            <td>
                                <form action="/admin/{{ $g->id }}/edit" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-primary">KIRIM</button>
                                </form>
                                <form action="/admin/{{ $g->id }}/update" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">BATAL</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <br>
            <br>
            {{ $gudang->links() }}
        @endsection
