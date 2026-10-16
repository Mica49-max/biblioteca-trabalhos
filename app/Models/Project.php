<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'type', 'status', 'is_public',
        'started_at', 'finished_at', 'github_url', 'demo_url', 'download_url',
        'local_path', 'cover_image', 'notes', 'learned',
    ];

    protected function casts(): array
    {
        return [
            'type' => ProjectType::class,
            'status' => ProjectStatus::class,
            'is_public' => 'boolean',
            'started_at' => 'date',
            'finished_at' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (empty($project->slug)) {
                $base = Str::slug($project->title);
                $slug = $base;
                $i = 2;
                while (static::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $project->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}