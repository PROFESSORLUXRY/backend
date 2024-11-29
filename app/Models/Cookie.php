<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cookie extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id', 'domain', 'name', 'value', 'expiry_date', 'decode'
    ];

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }
}
