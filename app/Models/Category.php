<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'parent_id', 'desc', 'status', 'image_path'
    ];

    public function getImageUrlAttribute()
    {
        if($this->image_path == null){
            return asset('assets/admin/assets/media/users/blank.png');
        }
        return asset('uploads/' . $this->image_path);
    }

    public function children(){
        return $this->hasMany(self::class,'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class,'category_id', 'id');
    }
}
