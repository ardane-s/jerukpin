<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    const TYPE_BANK_TRANSFER = 'bank_transfer';
    const TYPE_E_WALLET = 'e_wallet';
    const TYPE_COD = 'cod';

    protected $fillable = [
        'type',
        'method_name',
        'account_info',
        'account_name',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active payment methods
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered payment methods
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('method_name', 'asc');
    }

    /**
     * Get payment type label
     */
    public function getTypeLabel()
    {
        return match($this->type) {
            self::TYPE_BANK_TRANSFER => 'Transfer Bank',
            self::TYPE_E_WALLET => 'E-Wallet / QRIS',
            self::TYPE_COD => 'Bayar di Tempat (COD)',
            default => 'Lainnya'
        };
    }
}
