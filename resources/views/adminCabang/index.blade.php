@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <h2 class="col-12 text-center" style="font-family: Georgia, serif;">Data Permintaan Bahan</h2>
            </div>
            <br>
            <div class="float-right my-2"> <a class="btn btn-success" href="{{ route('adminCabang.create') }}"> Input
                    Data</a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
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
                            <td>
                                @if ($g->nama_bahan == 'Kulit tortila')
                                    Kulit tortila
                                @elseif($g->nama_bahan == 'Daging Kebab')
                                    Daging Kebab
                                @elseif($g->nama_bahan == 'Sosis')
                                    Sosis
                                @elseif($g->nama_bahan == 'Selada')
                                    Selada
                                @elseif($g->nama_bahan == 'Tomat')
                                    Tomat
                                @elseif($g->nama_bahan == 'Timun')
                                    Timun
                                @elseif($g->nama_bahan == 'Mayonaise')
                                    Mayonaise
                                @elseif($g->nama_bahan == 'Saus Tomat')
                                    Saus Tomat
                                @elseif($g->nama_bahan == 'Saus Sambal')
                                    Saus Sambal
                                @elseif($g->nama_bahan == 'Keju')
                                    Keju
                                @elseif($g->nama_bahan == 'Margarine')
                                    Margarine
                                @endif
                            </td>
                            <td>{{ $g->jumlah }}</td>
                            <td>{{ $g->tgl_request }}</td>
                            <td>
                                @if ($g->status == 'selesai')
                                    Diterima
                                @elseif($g->status == 'batal')
                                    Dibatalkan
                                @else
                                    Diproses
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('adminCabang.destroy', $g->id) }}" method="POST"> <a
                                        class="btn btn-primary" href="{{ route('adminCabang.edit', $g->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE') <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Anda yakin akan menghapus data ?');">Hapus</button> </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <br>
            <br>
            {{ $gudang->links() }}
        @endsection
