<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injection extends Model
{
    use HasFactory;

    protected $fillable = [
        'url', 'value', 'is_enabled', 'is_new_tab'
    ];
}
