@extends('adminPusat.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <h2 class="col-12 text-center" style="font-family: Georgia, serif; font-size:23px">Daftar Stok Kebab Ayu</h2>
            </div>
            <br><br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="float-right my-2"> <a class="btn btn-success" href="{{ route('adminPusatMenu.create') }}"> Input
                    Data</a>
            </div><br>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Cabang</th>
                        <th>Nama Menu</th>
                        <th>Stok</th>
                        <th width="280px">Action</th>
                    </tr>
                    <?php $no = 1; ?>
                    @foreach ($menu as $m)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                @if ($m->user_id == 2)
                                    Cabang 1
                                @elseif($m->user_id == 11)
                                    Cabang 2
                                @else
                                    Cabang 3
                                @endif
                            </td>
                            <td>{{ $m->menu1->nama_menu }}</td>
                            <td>{{ $m->stok }}</td>
                            <td>
                                <form action="{{ route('adminPusatMenu.destroy', $m->id) }}" method="POST"> <a>
                                        <a class="btn btn-primary" href="{{ route('adminPusatMenu.edit', $m->id) }}">Edit</a>
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