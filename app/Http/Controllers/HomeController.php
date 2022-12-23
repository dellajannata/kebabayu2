<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\PesananDetails;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menus = Menu::where('user_id', Auth::user()->id)->with('menu1')->orderBy('id', 'asc')->paginate(5);
        return view('tampilanmenu', compact('menus'));
    }
    public function indexadmin()
    {
        $count = Menu::all()->count();
        $count1 = Pesanan::all()->count();
        $count3 = User::all()->count();
        $count4 = PesananDetails::all()->count();
        // dd($count);
        return view('admin.main', compact('count','count1','count3','count4'));
    }
}