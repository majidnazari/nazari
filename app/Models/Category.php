<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{
    use HasFactory;

    public function tag(): MorphOne
    {
        return $this->morphOne(Tag::class, 'tagable');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
