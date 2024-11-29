<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'ip', 'country', 'ext_version', 'referral_code', 'pc_information', 'last_activity', 'is_archive', 'is_proxy_enabled', 'comment'
    ];

    public function cookieFound()
    {
        return $this->hasMany(CookieFound::class)->with(['cookieSetting']);
    }
}
