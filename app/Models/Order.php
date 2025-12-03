<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'recipient_name', // Baru
        'delivery_email', // Baru
        'backup_no_wa',   // Baru
        'booking_date',
        'payment_method',
        'payment_proof',
        'status'
    ];

    // Relasi: Order milik siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order paket apa?
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}