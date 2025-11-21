<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'status',
        'paid_at',
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];
    
    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function paymentProof()
    {
        return $this->hasOne(PaymentProof::class);
    }
    
    // Status helper methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
    
    public function isProofUploaded(): bool
    {
        return $this->status === 'proof_uploaded';
    }
    
    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }
    
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
