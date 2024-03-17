<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable=[
        "id",
        "title",
        "category_id",
        "des"
    ];

    // public function tag(): MorphOne
    // {
    //     return $this->morphOne(Tag::class, 'taggable');
    // }
    // public function tags(): MorphMany
    // {
    //     return $this->morphMany(Tag::class, 'taggable');
    // }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
