<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

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

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function toSearchableArray()
    { 
        return [
            'name'        => $this->name,
            'email'       => $this->email,
            'institution' => $this->institution,
            'phone'       => $this->phone
        ];
    }
}