<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'jumlah_stok'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
