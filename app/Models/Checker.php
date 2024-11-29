<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checker extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id', 'site', 'params'
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
