<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PesananDetails;
use App\Models\User;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'status',
        'jumlah_harga',
        'uang_bayar',
        'nama_pemesan'
    ];

    public function user() 
	{
         return $this->belongsTo(User::class,'user_id', 'id');
	}
    public function pesanan_details() 
	{
	     return $this->hasMany(PesananDetails::class,'pesanan_id', 'id');
	}
}