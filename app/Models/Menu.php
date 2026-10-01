<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory; // membuat data dummy otomatis

    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'is_active',
        'kuota_po',
        'maks_per_order',
        'terjual_po',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
