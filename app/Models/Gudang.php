<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;
    protected $table = 'bahan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nama_bahan',
        'jumlah',
        'tgl_request',
        'status',
    ];
    public function user() 
	{
         return $this->belongsTo(User::class,'user_id', 'id');
	}
}
