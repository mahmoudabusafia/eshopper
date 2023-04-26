<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'mobile',
        'type',
        'image_path',
        'password',
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

    public function getImageUrlAttribute()
    {
        if($this->image_path == null){
            return asset('assets/admin/assets/media/users/blank.png');
        }
        return asset('uploads/' . $this->image_path);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasAbility($ability){
        foreach ($this->roles as $role){
            if (in_array($ability, $role->abilities)){
                return true;
            }
        }
        return false;
    }

    public function pivot(){
        return $this->hasMany(RoleUser::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }
}
