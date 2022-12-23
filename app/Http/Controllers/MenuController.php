<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu1;
use Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $menu = Menu1::orderBy('id', 'asc')->paginate(5);
        return view('adminPusat.datamenuindex', compact('menu'));
    }
    public function create()
    {
        return view('adminPusat.datamenucreate');
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nama_menu' => 'required', 'gambar' => 'required', 'harga' => 'required|numeric'
        ]);
        //fungsi eloquent untuk menambah data 
        $menu = new Menu1;
        $menu->nama_menu = $request->get('nama_menu');
        if ($request->file('gambar')){
            $image_name = $request->file('gambar')->store('images', 'public');
        }
        $menu->gambar = $image_name;
        $menu->harga = $request->get('harga');
        $menu->save();
        //jika data berhasil ditambahkan, akan kembali ke halaman utama 
        return redirect()->route('adminMenu.index')
            ->with('success', 'Menu Berhasil Ditambahkan');
    }
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Menu untuk diedit
        $menu = Menu1::find($id);
        return view('adminPusat.datamenuedit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //melakukan validasi data
        $request->validate([
            'nama_menu' => 'required', 'gambar' => 'required', 'harga' => 'required|numeric'
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        $menu = Menu1::where('id',$id)->first();
        $menu->nama_menu = $request->get('nama_menu');
        if ($menu->gambar && file_exists(storage_path('app/public/'.$menu->gambar))){
            Storage::delete('public/'. $menu->gambar);
        }

        $image_name = $request->file('gambar')->store('images', 'public');
        $menu->gambar = $image_name;
        $menu->harga = $request->get('harga');
        $menu->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('adminMenu.index')
            ->with('success', 'Menu Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data 
        Menu1::find($id)->delete();
        return redirect()->route('adminMenu.index')
            ->with('success', 'Menu Berhasil Dihapus');
    }
    public function carimenu(Request $request)
    {
        $keyword = $request->cari;
        $menu = Menu1::where('nama_menu', 'like', '%' . $keyword . '%')->orWhere('harga', 'like', '%' . $keyword . '%')->paginate(5);
        $menu->appends(['keyword' => $keyword]);
        return view('adminPusat.datamenuindex', compact('menu'));
    }
}