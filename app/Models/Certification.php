<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'issuer',
        'url',
        'issued_date',
        'order',
    ];

    protected $casts = [
        'issued_date' => 'date',
    ];
}