<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * The posts that have this tag.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('tag')
            ->logOnly(['name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function (string $eventName) {
                return "{$eventName} tag \"{$this->name}\"";
            });
    }
}
