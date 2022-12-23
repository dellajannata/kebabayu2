@extends('adminPusat.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header"> Edit Menu </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger"> <strong>Whoops!</strong> There were some problems with your
                            input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('adminPusatMenu.update', $menu->id) }}" id="myForm"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="form-group"> <label for="user_id">Cabang</label> <select name="user_id" id="user_id"
                                class="form-control">
                                <option value="2" {{ $menu->user_id == '2' ? 'selected' : '' }}>Cabang 1</option>
                                <option value="11" {{ $menu->user_id == '11' ? 'selected' : '' }}>Cabang 2</option>
                                <option value="12" {{ $menu->user_id == '12' ? 'selected' : '' }}>Cabang 3</option>
                            </select>
                        </div>
                        <div class="form-group"> <label for="nama_menu">Nama Menu</label> <select name="menu_id"
                                id="nama_menu" class="form-control">
                                @foreach ($nama_menu as $nm)
                                    <option value="{{ $nm->id }}"
                                        {{ $menu->nama_menu == $nm->nama_menu ? 'selected' : '' }}>{{ $nm->nama_menu }}
                                    </option>
                                @endforeach
                            </select> </div>
                        <div class="form-group"> <label for="stok">Stok</label> <input type="stok" name="stok"
                                class="form-control" id="stok" value="{{ $menu->stok }}" aria-describedby="stok">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</div> @endsection
