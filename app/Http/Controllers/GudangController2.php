<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Carbon\Carbon;
use Database\Seeders\BahanSeeder;
use Illuminate\Http\Request;
use Auth;

class GudangController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
         //fungsi eloquent menampilkan data menggunakan paginaon
         $gudang = Gudang::where('user_id', 11)->orderBy('id', 'asc')->paginate(5);
         return view('adminGudang.indexGudang2', compact('gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminGudang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
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
        $gudang = Gudang::find($id);
        return view('adminGudang.edit2', compact('gudang'));
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
           'status' => 'required', 
        ]);

        $gudang->update([
            'status' => $request->status
        ]);
        $gudang->save();
        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('admin2.index')
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
        return redirect()->route('admin2.index')
            ->with('success', 'Permintaan Berhasil Dihapus');
    }
    public function cari(Request $request)
    {
        $keyword = $request->cari;
        $gudang = Gudang::where('user_id', 11)->where(function ($query) use ($keyword) {
            $query->where('nama_bahan', 'like', '%' . $keyword . '%')
                    ->orWhere('jumlah', 'like', '%' . $keyword . '%')
                    ->orWhere('status', 'like', '%' . $keyword . '%');
        })->paginate(5);
        $gudang->appends(['keyword' => $keyword]);
        return view('adminGudang.indexGudang2', compact('gudang'));
    }
    public function statusSelesai($id){
        $update = Gudang::where('user_id', 11)->find($id);
        $update->update([
            'status'=> 'selesai'
        ]);

        return redirect()->route('admin2.index')
            ->with('success', 'Status Permintaan Bahan Baku Berhasil Dikirim');
    }

    public function statusBatal($id){
        $update = Gudang::where('user_id', 11)->find($id);
        $update->update([
            'status'=> 'batal'
        ]);

        return redirect()->route('admin2.index')
            ->with('success', 'Status Permintaan Bahan Baku Dibatalkan');
    }
}
