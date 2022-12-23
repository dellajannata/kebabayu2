<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Menu;
use App\Models\User;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class AdminPusatController extends Controller
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
        $count1 =  Gudang::where('user_id', 2)->count();
        $count2 =  Gudang::where('user_id', 11)->count();
        $count3 =  Gudang::where('user_id', 12)->count();
        $count4 =  User::all()->count();
        $count5 =  Menu::where('user_id', 2)->count();
        $count6 =  Menu::where('user_id', 11)->count();
        $count7 =  Menu::where('user_id', 12)->count();
        $count8 =  Pesanan::where('user_id', 2)->count();
        $count9 =  Pesanan::where('user_id', 11)->count();
        $count10 =  Pesanan::where('user_id', 12)->count();
        return view('adminPusat.beranda', compact('count1','count2','count3','count4','count5','count6',
        'count7','count8','count9','count10'));
    }
    public function index()
    {
         //fungsi eloquent menampilkan data menggunakan paginaon

         $gudang = Gudang::where('user_id',2)->orderBy('id', 'asc')->paginate(5);
         return view('adminPusat.indexPusat', compact('gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPusat.create');
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
        return redirect()->route('adminPusat.index')
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
        return view('adminPusat.edit', compact('gudang'));
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
        return redirect()->route('adminPusat.index')
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
        return redirect()->route('adminPusat.index')
            ->with('success', 'Permintaan Berhasil Dihapus');
    }
    public function cari(Request $request)
    {

        $keyword = $request->cari;
        $gudang = Gudang::where('user_id', 2)->where(function ($query) use ($keyword) {
            $query->where('nama_bahan', 'like', '%' . $keyword . '%')
                    ->orWhere('jumlah', 'like', '%' . $keyword . '%')
                    ->orWhere('status', 'like', '%' . $keyword . '%');
        })->paginate(5);
        $gudang->appends(['keyword' => $keyword]);
        return view('adminPusat.indexPusat', compact('gudang'));
    }
}
