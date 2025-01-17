<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promo extends Model
{
    //
    use HasFactory;

    protected $table = 'promos';
    protected $primaryKey = 'promo_id';

    protected $fillable = ['promo_id','product_id', 'jenis_promo',  'tanggal_mulai', 'tanggal_akhir', 'diskon'];

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }
}
