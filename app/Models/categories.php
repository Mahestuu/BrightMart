<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = ['category_id','category_name'];

    public function products()
    {
        return $this->hasMany(products::class, 'category_id');
    }
    // Relasi ke Product
   
}
