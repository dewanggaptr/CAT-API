<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAssets extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image'
    ];

    protected $hidden = [
        'product_id',
        'created_at',
        'updated_at'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
