<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitems extends Model
{
    use HasFactory;

    protected $table = 'orderitems';
    protected $primaryKey = 'order_item_id';

    protected $fillable = ['order_item_id','product_id', 'order_id',  'qty', 'price'];

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }

    
    
}
