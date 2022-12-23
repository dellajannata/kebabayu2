<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class BahanCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //fungsi eloquent menampilkan data menggunakan paginaon
         $gudang = Gudang::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->paginate(5);
         return view('adminCabang.index', compact('gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminCabang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required', 'jumlah' => 'required|numeric',
            
        ]);

        Gudang::create([
            'user_id'=>Auth::user()->id,
            'nama_bahan' => $request->nama_bahan,
            'jumlah' => $request->jumlah,
           
        ]);
        //jika data berhasil ditambahkan, akan kembali ke halaman utama 
        return redirect()->route('adminCabang.index')
            ->with('success', 'Permintaan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $gudang = Gudang::find($id)->where('user_id', Auth::user()->id)->first();
        return view('adminCabang.edit', compact('gudang'));
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
        $gudang = Gudang::findOrFail($id);
        $request->validate([
            'nama_bahan' => 'required', 'jumlah' => 'required|numeric'
        ]);

        $gudang->where('user_id', Auth::user()->id)->update([
            'nama_bahan' => $request->nama_bahan,
            'jumlah' => $request->jumlah,
        ]);
        $gudang->save();
        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('adminCabang.index')
            ->with('success', 'Permintaan Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data 
        Gudang::find($id)->delete();
        return redirect()->route('adminCabang.index')
            ->with('success', 'Permintaan Berhasil Dihapus');
    }

    public function statusSelesai($id){
        $update = Gudang::find($id);
        $update->update([
            'status'=> 'SELESAI'
        ]);

        return redirect()->route('adminCabang.index')
            ->with('success', 'Status Permintaan Bahan Baku Berhasil Dikirim');
    }

    public function statusBatal($id){
        $update = Gudang::find($id);
        $update->update([
            'status'=> 'batal'
        ]);

        return redirect()->route('adminCabang.index')
            ->with('success', 'Status Permintaan Bahan Baku Dibatalkan');
    }
}
