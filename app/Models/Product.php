<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'table_products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dateFormate = 'h:m:s';

    // protected $fillable = [
    //     'product_id',
    //     'product_name',
    //     'price',
    // ];

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
