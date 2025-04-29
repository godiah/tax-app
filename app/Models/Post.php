<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Illuminate\Support\Facades\Cache;
use League\CommonMark\Extension\Table\TableExtension;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'author_id',
        'category_id',
        'status',
        'featured_image',
        'published_at',
        'meta_description',
        'view_count',
        'like_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Make sure columns have default values
    protected $attributes = [
        'view_count' => 0,
        'like_count' => 0,
    ];

    // Define relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Relationship for likes
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id')
            ->withTimestamps();
    }

    /**
     * Use 'slug' for route model binding instead of 'id'.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the rendered HTML (from Markdown), cached for performance.
     */
    public function getContentHtmlAttribute(): string
    {
        // cache key will change if post is updated
        $cacheKey = 'post_html_' . $this->id . '_' . $this->updated_at->timestamp;

        return Cache::remember($cacheKey, now()->addHours(6), function () {
            $environment = new Environment([
                'html_input'        => 'strip',
                'allow_unsafe_links' => false,
            ]);

            $environment->addExtension(new CommonMarkCoreExtension());
            $environment->addExtension(new TableExtension());

            $converter = new MarkdownConverter($environment);

            return (string) $converter->convert($this->content);
        });
    }

    /**
     * Configure the Activity Log for this model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('post')
            ->logOnly(['title', 'content', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function (string $eventName) {
                return "{$eventName} post \"{$this->title}\"";
            });
    }
}
