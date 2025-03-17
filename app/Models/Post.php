<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'category_id', 'meta_title', 'meta_description','image'];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
