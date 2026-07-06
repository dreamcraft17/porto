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

    protected static function booted(): void
    {
        static::saving(function (PersonalProject $project) {
            if ($project->isDirty('content') && filled($project->content)) {
                $project->content = clean($project->content);
            }
        });
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }
}
