<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id', 'site', 'email', 'mobile_code', 'mobile', 'password', 'balance', 'all_balances', 'withdraw_balance', 'used', 'last_check_balance', 'full_balance', 'trading_balance', 'seed', 'ip', 'country', 'geo', 'uuid'
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }
}
