<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 class  Product extends Model
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
}
