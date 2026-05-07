<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'cover_image', 'qr_code_path', 'status'];

    public function blocks()
    {
        return $this->hasMany(PageBlock::class)->orderBy('order');
    }
}
