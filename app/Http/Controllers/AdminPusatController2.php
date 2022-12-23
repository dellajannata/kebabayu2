<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPusatController2 extends Controller
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
    public function indexPusat()
    {
        $count = Gudang::all()->count();
        // dd($count);
        return view('adminPusat2.main', compact('count'));
    }
    public function index()
    {
         //fungsi eloquent menampilkan data menggunakan paginaon
         $gudang = Gudang::where('user_id',11)->orderBy('id', 'asc')->paginate(5);
         return view('adminPusat.indexPusat2', compact('gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPusat.create2');
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
            'tgl_request' => 'required','status' => 'required', 
        ]);


        Gudang::create([
            'id' => $request->id,
            'nama_bahan' => $request->nama_bahan,
            'jumlah' => $request->jumlah,
            'tgl_request' => $request->tgl_request,
            'status' => $request->status
        ]);
        //jika data berhasil ditambahkan, akan kembali ke halaman utama 
        return redirect()->route('adminPusat2.index2')
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
        $gudang = Gudang::find($id);
        return view('adminPusat.edit2', compact('gudang'));
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
            'nama_bahan' => 'required', 'jumlah' => 'required|numeric',
            'tgl_request' => 'required','status' => 'required', 
        ]);

        $gudang->update([
            'id' => $request->id,
            'nama_bahan' => $request->nama_bahan,
            'jumlah' => $request->jumlah,
            'tgl_request' => $request->tgl_request,
            'status' => $request->status
        ]);
        $gudang->save();
        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('adminPusat2.index')
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
        return redirect()->route('adminPusat2.index')
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
        return view('adminPusat.indexPusat2', compact('gudang'));
    }
}
