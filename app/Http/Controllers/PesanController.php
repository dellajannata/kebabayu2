<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\PesananDetails;
use Auth;
use Alert;
use App\Http\Middleware\Authenticate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use PharIo\Manifest\Author;


class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexMenu($id)
    {
    	$menu = Menu::where('id', $id)->first();

    	return view('pesan.index', compact('menu'));
    }
    public function pesan(Request $request, $id)
    {	
    	$menu = Menu::where('id', $id)->first();
    	$tanggal = Carbon::now()->format('Y-m-d H:i:s');

    	//validasi apakah melebihi stok
    	if($request->jumlah_pesan > $menu->stok )
    	{
            Alert()->warning('Pesanan melebihi jumlah stok','Peringatan');
            return redirect('pesan/'.$id);
    		
    	}else if($request->jumlah_pesan <0){
            Alert()->warning('Pesanan kurang dari jumlah stok','Peringatan');
            return redirect('pesan/'.$id);
        }

    	//cek validasi
    	$cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
    	//simpan ke database pesanan
    	if(empty($cek_pesanan))
    	{
    		$pesanan = new Pesanan;
	    	$pesanan->user_id = Auth::user()->id;
	    	$pesanan->tanggal = $tanggal;
	    	$pesanan->status = 0;
	    	$pesanan->jumlah_harga = 0;
	    	$pesanan->save();
            
    	}
    	
    	//simpan ke database pesanan detail
    	$pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

    	//cek pesanan detail
    	$cek_pesanan_detail = PesananDetails::where('menu_id', $menu->id)->where('pesanan_id', $pesanan_baru->id)->first();
    	if(empty($cek_pesanan_detail))
    	{
    		$pesanan_detail = new PesananDetails;
	    	$pesanan_detail->menu_id = $menu->id;
	    	$pesanan_detail->pesanan_id = $pesanan_baru->id;
	    	$pesanan_detail->jumlah = $request->jumlah_pesan;
	    	$pesanan_detail->jumlah_harga = $menu->menu1->harga*$request->jumlah_pesan;
            $pesanan_detail->catatan= $request->catatan_pesan;
	    	$pesanan_detail->save();
            
    	}else 
    	{
    		$pesanan_detail = PesananDetails::where('menu_id', $menu->id)->where('pesanan_id', $pesanan_baru->id)->first();
    		$pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;
    		//harga sekarang
    		$harga_pesanan_detail_baru = $menu->menu1->harga*$request->jumlah_pesan;
	    	$pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->catatan= $request->catatan_pesan;
	    	$pesanan_detail->update();
    	}

    	//jumlah total
    	$pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
    	$pesanan->jumlah_harga = $pesanan->jumlah_harga+$menu->menu1->harga*$request->jumlah_pesan;
    	$pesanan->update();
        
        Alert()->success('Pesanan Sukses Masuk Keranjang','Berhasil');
    	return redirect('check-out');
    }
    public function check_out(Request $request)
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
 	    $pesanan_details = [];
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetails::where('pesanan_id', $pesanan->id)->get();
        }
        
        return view('pesan.check_out', compact('pesanan', 'pesanan_details'));
    }
    public function delete($id)
    {
        $pesanan_detail = PesananDetails::where('id', $id)->first();
        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();
        $pesanan_detail->delete();
        Alert()->success('Pesanan Berhasil Dihapus','Berhasil');
        return redirect('check-out');
    }
    public function konfirmasi(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->nama_pemesan= $request->nama_pemesan2;
        $pesanan->update();
        $pesanan_details = PesananDetails::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $menu = menu::where('id', $pesanan_detail->menu_id)->first();
            $menu->stok = $menu->stok-$pesanan_detail->jumlah;
            $menu->update();
        }
        alert()->success('Pesanan Berhasil Masuk Keranjang Silahkan Tunggu Antrian', 'Berhasil');
        return redirect('history/');
    }
}