@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h2 class="col-12" style="font-family: Georgia, serif;">Pemesanan</h2>
        <hr>
        <br><br>
        @foreach ($menus as $m)
            <div class="col-md-4" >
                <br>
                <div class="card" >
                    <img width="25" height="280"  src="{{ asset('storage/'. $m->menu1->gambar) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $m->menu1->nama_menu }}</h5>
                        <p class="card-text"><strong>Stok :</strong> {{ $m->stok }}<br>
                        <strong>Harga :</strong> Rp. {{ $m->menu1->harga }}</p>
                        <a href="{{url('pesan')}}/{{$m->id}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Pesan</a>
                    </div>
                </div>
            </div>
        @endforeach
        <br><br>
        {{ $menus->links() }}
    </div>
</div>
@endsection