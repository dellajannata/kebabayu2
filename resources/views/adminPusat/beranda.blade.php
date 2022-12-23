@extends('adminPusat.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center mt-2">
                <h2 class="col-12 text-center" style="font-family: Georgia, serif; font-size:23px">Data Admin Pusat</h2>
            </div>
            <br><br>
            <div class="table-responsive">

                <table class="table table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Anggota</td>
                        <td><a href="{{ url('adminPusatKaryawan') }}">{{ $count4 }}</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Menu Cabang 1</td>
                        <td><a href="{{ url('adminPusatMenu') }}">{{ $count5 }}</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Menu Cabang 2</td>
                        <td><a href="{{ url('adminPusatMenu') }}">{{ $count6 }}</a></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Menu Cabang 3</td>
                        <td><a href="{{ url('adminPusatMenu') }}">{{ $count7 }}</a></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Permintaan Bahan Cabang 1</td>
                        <td><a href="{{ url('adminPusat') }}">{{ $count1 }}</a></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Permintaan Bahan Cabang 2</td>
                        <td><a href="{{ url('adminPusat2') }}">{{ $count2 }}</a></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Permintaan Bahan Cabang 3</td>
                        <td><a href="{{ url('adminPusat3') }}">{{ $count3 }}</a></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Transaksi Cabang 1</td>
                        <td><a href="adminPusatPesan">{{ $count8 }}</a></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Transaksi Cabang 2</td>
                        <td><a href="adminPusatPesan22">{{ $count9 }}</a></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Transaksi Cabang 3</td>
                        <td><a href="adminPusatPesan33">{{ $count10 }}</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection