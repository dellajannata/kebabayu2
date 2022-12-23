<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\Menu;

class PesananDetails extends Model
{
    use HasFactory;

    protected $table = 'pesanan_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'jumlah',
        'jumlah_harga',
        'catatan',
        'nama_pemesan'
    ];

    public function menu() 
	{
         return $this->belongsTo(Menu::class,'menu_id', 'id');
	}
    

    public function pesanan()
	{
	      return $this->belongsTo(Pesanan::class,'pesanan_id', 'id');
	}
}