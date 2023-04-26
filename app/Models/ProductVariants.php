<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'product_id', 'type', 'value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
