<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PesananDetails;

class Menu1 extends Model
{
    use HasFactory;

    protected $table = 'menu1';
    protected $primaryKey = 'id';

    protected $fillable = [
        'gambar',
        'nama_menu',
        'harga',
    ];

    public function pesanan_detail() 
	{
	     return $this->hasMany(PesananDetails::class,'menu_id', 'id');
	}
    public function menu(){
        return $this->hasMany(Menu::class);
    }
}