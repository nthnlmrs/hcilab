<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'category', 'excerpt', 'content', 'image',
        'characters', 'themes', 'historical_significance', 'did_you_know',
    ];

    protected $casts = [
        'characters' => 'array',
        'themes' => 'array',
    ];

    /**
     * Get the fully qualified image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return asset('images/cerita_card.png');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }
}
