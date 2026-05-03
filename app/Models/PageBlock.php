<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'type', 'content', 'order'];

    protected $casts = [
        'content' => 'json',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
