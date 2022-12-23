@extends('adminPusat.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-center mt-2">
                    <h2 class="col-12 text-center" style="font-family: Georgia, serif; font-size:23px">Daftar Karyawan Kebab Ayu</h2>
                </div>
                <br><br>
                <div class="float-right my-2"> <a class="btn btn-success" href="{{ route('adminPusatKaryawan.create') }}"> Input
                        Data</a>
                    <br><br>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        <br>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th width="280px">Action</th>
                            </tr>
                            <?php $no = 1; ?>
                            @foreach ($karyawan as $k)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $k->name }}</td>
                                    <td>{{ $k->email }}</td>
                                    <td>{{ $k->level }}</td>
                                    <td>
                                        <form action="{{ route('adminPusatKaryawan.destroy', $k->id) }}" method="POST"> <a>
                                                <a class="btn btn-primary"
                                                    href="{{ route('adminPusatKaryawan.edit', $k->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE') <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Anda yakin akan menghapus data ?');">Hapus</>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    {{ $karyawan->links() }}
                    <br>
                </div>
            </div>
        </div>
    </div>

@endsection