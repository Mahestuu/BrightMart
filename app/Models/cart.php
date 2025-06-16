<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    protected $fillable = ['cart_id', 'user_id', 'product_id','qty'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }
}
