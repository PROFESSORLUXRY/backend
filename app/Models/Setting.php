<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'value'
    ];

    public static function getValue($name)
    {
        $setting = self::where('name', $name)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return null;
        }
    }
}
