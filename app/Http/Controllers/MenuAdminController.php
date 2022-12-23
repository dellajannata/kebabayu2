<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Menu1;
use Storage;

class MenuAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $menu = Menu::orderBy('id', 'asc')->paginate(5);
        return view('adminPusat.menuindex', compact('menu'));
    }
    public function create()
    {
        $nama_menu = Menu1::all();
        return view('adminPusat.menucreate',['nama_menu'=>$nama_menu]);
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'menu_id' => 'required','stok' => 'required|numeric',
            'user_id' => 'required'
        ]);
        //fungsi eloquent untuk menambah data 
        $menu = new Menu;
        $menu->menu_id = $request->get('menu_id');
        $menu->user_id = $request->get('user_id');
        $menu->stok = $request->get('stok');
        $menu->save();
        //jika data berhasil ditambahkan, akan kembali ke halaman utama 
        return redirect()->route('adminPusatMenu.index')
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
        $menu = Menu::find($id);
        $nama_menu = Menu1::all();
        return view('adminPusat.menuedit', compact('menu','nama_menu'));
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
            'menu_id' => 'required','stok' => 'required|numeric',
            'user_id' => 'required'
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        $menu = Menu::with('menu1')->where('id', $id)->first();
        // $menu = Menu::where('id',$id)->first();
        $menu->menu_id = $request->get('menu_id');
        
        $menu->user_id = $request->get('user_id');
        $menu->stok = $request->get('stok');
        $menu->save(); 


        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('adminPusatMenu.index')
            ->with('success', 'Menu Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data 
        Menu::find($id)->delete();
        return redirect()->route('adminPusatMenu.index')
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