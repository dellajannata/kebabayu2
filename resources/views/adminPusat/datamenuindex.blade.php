@extends('adminPusat.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <h2 class="col-12 text-center" style="font-family: Georgia, serif; font-size:23px">Daftar Menu Kebab Ayu</h2>

            </div>
            <br><br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form class="form" method="get" action="{{ route('carimenu') }}">
                <div class="form-group w-50 mb-6">
                    <label for="search" class="d-block mr-2">Pencarian Data Menu</label>
                    <input type="text" name="cari" class="form-control" id="cari"
                        placeholder="Masukkan Nama Menu">
                    <button type="submit" class="btn btn-success mb-1">Cari</button>
                </div>
            </form>
            <div class="float-right my-2"> <a class="btn btn-success" href="{{ route('adminMenu.create') }}"> Input
                    Data</a>
            </div><br>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th width="280px">Action</th>
                    </tr>
                    <?php $no = 1; ?>
                    @foreach ($menu as $m)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><img height="130" width="200" src="{{ asset('storage/' . $m->gambar) }}"></td>
                            <td>{{ $m->nama_menu }}</td>
                            <td>{{ $m->harga }}</td>
                            <td>
                                <form action="{{ route('adminMenu.destroy', $m->id) }}" method="POST"> <a>
                                        <a class="btn btn-primary" href="{{ route('adminMenu.edit', $m->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE') <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Anda yakin akan menghapus data ?');">Hapus</>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            {{ $menu->links() }}
            <br>
        @endsection