<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = ['product_id','category_id', 'product_name',  'product_description', 'product_price', 'product_stock', 'product_image'];

    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }

    public function orderitems()
    {
        return $this->hasMany(orderitems::class, 'product_id');
    }

    public function promo()
    {
        return $this->hasMany(promo::class, 'product_id');
    }

}
