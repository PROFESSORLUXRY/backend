<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clipper extends Model
{
    use HasFactory;

    protected $fillable = [
        "reg", "value"
    ];
}
