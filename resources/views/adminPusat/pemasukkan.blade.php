@extends('adminPusat.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <Center>Daftar Transaksi Kebab Ayu</Center>
            </div>
            <br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
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
                            <td>{{ $p->status }}</td>
                            <td>{{ $p->jumlah_harga }}</td>
                            <td>
                                <form action="{{ route('admin2.destroy', $p->id) }}" method="POST"> <a class="btn btn-info"
                                        href="{{ route('admin2.show', $p->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('admin2.edit', $p->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE') <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $pesanan->links() }}
            <br>
        @endsection