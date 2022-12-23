<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Pesanan;
use App\Models\Gudang;
use App\Models\Menu;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'user_id', 'id');
    }
    public function gudang()
    {
        return $this->hasMany(Gudang::class, 'user_id', 'id');
    }
    public function menu()
    {
        return $this->hasMany(Menu::class, 'user_id', 'id');
    }
    public function hasRole($role) {
        switch ($role) {
            case 'adminCabang': return \Auth::user()->isCabang();
            case 'adminPusat': return \Auth::user()->isPusat();
            case 'adminGudang': return \Auth::user()->isGudang();
        }
        return false;
    }
    public function isCabang()
    {
        if($this->level == 'adminCabang')
        { 
            return true; 
        } 
        else 
        { 
            return false; 
        }
    }
    public function isPusat()
    {
        if($this->level == 'adminPusat')
        { 
            return true; 
        } 
        else 
        { 
            return false; 
        }
    }
    public function isGudang()
    {
        if($this->level == 'adminGudang')
        { 
            return true; 
        } 
        else 
        { 
            return false; 
        }
    }
}
