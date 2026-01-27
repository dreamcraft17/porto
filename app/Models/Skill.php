<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'proficiency',
        'order',
        'icon',
    ];

    protected $casts = [
        'proficiency' => 'integer',
    ];
}