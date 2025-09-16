<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'invoice_number',
        'amount',
        'status',
        'payment_method',
        'midtrans_transaction_id',
        'midtrans_order_id',
        'midtrans_va_number',
        'metadata',
        'due_date',
    ];

    protected $casts = [
        'metadata' => 'array',
        'due_date' => 'datetime',
    ];

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke Payment
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
