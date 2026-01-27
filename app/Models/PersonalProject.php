<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'github_url',
        'live_url',
        'technologies',
        'project_date',
        'order',
        'featured',
    ];

    protected $casts = [
        'technologies' => 'array',
        'project_date' => 'date',
        'featured' => 'boolean',
    ];
}