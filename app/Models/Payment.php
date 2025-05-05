<?php

namespace App\Models;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'amount',
        'status',
    ];

    /**
     * Get the tenant that owns the payment.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}