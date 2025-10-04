<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}


