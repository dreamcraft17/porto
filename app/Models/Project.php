<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'company',
        'role',
        'description',
        'content',
        'image',
        'url',
        'github_url',
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