<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookieFound extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id', 'cookie_setting_id', 'cnt'
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function cookieSetting()
    {
        return $this->belongsTo(CookieSetting::class);
    }
}
