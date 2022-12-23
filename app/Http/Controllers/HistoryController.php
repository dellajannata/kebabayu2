<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\PesananDetails;
use Auth;
use Alert;
use DB;
use Illuminate\Http\Request;
use PDF;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexhistory()
    {
    	$pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=',0)->get();
    	return view('history.index', compact('pesanans'));
    }

    public function detail(Request $request,$id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = PesananDetails::where('pesanan_id', $pesanan->id)->get();
        return view('history.detail', compact('pesanan','pesanan_details'));
    }
    
    public function buy(Request $request,$id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan->uang_bayar=$request->uang_bayar2;
        $pesanan->save();
        $pesanan_details = PesananDetails::where('pesanan_id', $pesanan->id)->get();
        return view('history.detail', compact('pesanan','pesanan_details'));
        
    }
    public function index(Request $request)
    {
        $pesanan = Pesanan::orderBy('tanggal', 'desc')->paginate(5);
        return view('admin.pesanindex', compact('pesanan'));
    }
    public function create()
    {
        return view('admin.pesancreate');
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([ 'tanggal' => 'required', 'status' => 'required', 'jumlah_harga' => 'required'
        ]);
        //fungsi eloquent untuk menambah data 
        Pesanan::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama 
        return redirect()->route('admin2.index')
        ->with('success', 'Menu Berhasil Ditambahkan');
    }
    public function show($id)
    {
        //menampilkan detail data dengan menemukan/berdasarkan ... Menu
        $pesanan = Pesanan::where('id', $id)->first();
    $pesanan_details = PesananDetails::where('pesanan_id', $pesanan->id)->get();
    return view('admin.pesandetail', compact('pesanan','pesanan_details'));
        
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
        $pesanan = Pesanan::find($id);
        return view('admin.pesanedit', compact('pesanan'));


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
        $request->validate([ 'tanggal' => 'required', 'status' => 'required', 'jumlah_harga' => 'required'
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita 
        Pesanan::find($id)->update($request->all());
        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('admin2.index')
        ->with('success', 'Menu Berhasil Diupdate');
    }
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data 
        Pesanan::find($id)->delete();
        return redirect()->route('admin2.index')
        -> with('success', 'Menu Berhasil Dihapus');
    }
    public function cari(Request $request)
    {
        $keyword = $request->cari;
        $pesanans = Pesanan::where('user_id',Auth::user()->id)->where('tanggal', 'like', '%' . $keyword . '%')->orWhere('jumlah_harga', 'like', '%' . $keyword . '%')
        ->orWhere('nama_pemesan', 'like', '%' . $keyword . '%')->paginate(5);
        $pesanans->appends(['keyword' => $keyword]);
        return view('history.index', compact('pesanans'));
    }
}
?>