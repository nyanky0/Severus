<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokopediaSyncLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'old_price_idr',
        'new_price_idr',
        'status',
        'message',
        'synced_at',
    ];

    protected $casts = [
        'synced_at' => 'datetime',
        'old_price_idr' => 'decimal:2',
        'new_price_idr' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
