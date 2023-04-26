<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
class Admin extends User
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'mobile', 'type',
        'image_path', 'password', 'status', 'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
