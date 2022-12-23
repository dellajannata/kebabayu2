<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $karyawan = User::orderBy('id', 'asc')->paginate(5);
        return view('adminPusat.karyawanindex', compact('karyawan'));
    }
    public function create()
    {
        return view('adminPusat.karyawancreate');
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'name' => 'required', 'email' => 'required', 'level' => 'required','password' => 'required|min:8'
        ]);
        //fungsi eloquent untuk menambah data 
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'level' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);

        //jika data berhasil ditambahkan, akan kembali ke halaman utama 
        return redirect()->route('adminPusatKaryawan.index')
            ->with('success', 'Data Berhasil Ditambahkan');
    }
    public function show($id)
    {
        //menampilkan detail data dengan menemukan/berdasarkan ... Menu
        $user = User::where('id', $id)->first();
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
        $karyawan = User::find($id);
        return view('adminPusat.karyawanedit', compact('karyawan'));
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
            'name' => 'required', 'email' => 'required', 'level' => 'required','password' => 'required|min:8'
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita 
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        

        //jika data berhasil diupdate, akan kembali ke halaman utama 
        return redirect()->route('adminPusatKaryawan.index')
            ->with('success', 'Data Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data 
        User::find($id)->delete();
        return redirect()->route('adminPusatKaryawan.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}
