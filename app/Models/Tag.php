<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Tag extends Model
{
    use HasFactory;


    // public function tagable(): MorphTo
    // {
    //     return $this->morphTo();
    // }
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
