<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'category', 'event_date', 'location',
        'duration', 'image', 'features', 'max_participants', 'target_audience',
    ];

    protected $casts = [
        'event_date' => 'date',
        'features' => 'array',
    ];

    /**
     * Get the schedules for the event.
     */
    public function schedules()
    {
        return $this->hasMany(EventSchedule::class);
    }

    /**
     * Get the fully qualified image URL.
     */
    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            return asset('images/defaults/event-cover.jpg');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'images/')) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }

    /**
     * Get the users who have saved this event.
     */
    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_events')->withTimestamps();
    }
}
