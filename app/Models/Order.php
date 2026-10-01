<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'kode_trks',
        'user_id',
        'nama_pelanggan',
        'no_whatsapp',
        'tipe_pesanan',
        'jam_pengambilan',
        'catatan',
        'subtotal',
        'biaya_admin',
        'grand_total',
        'status',
        'shift_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
