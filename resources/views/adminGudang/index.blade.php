@extends('adminGudang.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <h2 class="col-12 text-center" style="font-family: Georgia, serif;">Data Permintaan Bahan</h2>
                <h4 class="col-12 text-center" style="font-family: Georgia, serif;">Seluruh Cabang</h4>
            </div>
            <br><br>
            <div class="table-responsive">

                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Nama Cabang</th>
                        <th>Jumlah Permintaan</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Cabang 1</td>
                        <td>{{ $count1 }}</td>
                        <td>
                            <form action="admin"><button type="submit" class="btn btn-primary">Periksa</button></form>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Cabang 2</td>
                        <td>{{ $count2 }}</td>
                        <td>
                            <form action="admin2"><button class="btn btn-primary">Periksa</button></form>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cabang 3</td>
                        <td>{{ $count3 }}</td>
                        <td>
                            <form action="admin3"><button class="btn btn-primary">Periksa</button></form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection