<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'status_id',
        'title',
        'description',
        'due_date',
        'estimated_time',
        'estimated_time_type',
        'time_type',
        'priority',
    ];

    public function scopeWhereProject(Builder $query,$projectId): void
    {
        $query->where('project_id', $projectId);
    }

    /* Start Relationships */

    public function project(): BelongsTo 
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    
    public function files(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_users');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    /* End Relationships */
}
