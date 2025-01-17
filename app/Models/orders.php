<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = ['order_id','user_id', 'total_amount',  'order_status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderitems()
    {
        return $this->hasMany(orderitems::class, 'order_id');
    }
}
