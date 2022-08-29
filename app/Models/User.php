<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $hidden  = [ 'password', 'remember_token'];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function article()
    {
        return $this->hasOne(Article::class);
    }

    public function fullpaper()
    {
        return $this->hasOne(FullPaper::class);
    }

    public function abstrak()
    {
        return $this->hasOne(Abstrak::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}