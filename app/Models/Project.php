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

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if ($project->isDirty('content') && filled($project->content)) {
                $project->content = clean($project->content);
            }
        });
    }

    public function sanitizedHtml(): string
    {
        return clean((string) $this->content);
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
