<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    protected function name():Attribute
    {
        return Attribute::make(

            get: fn (string $name) => ucfirst($name),
            set: fn (string $name) => strtolower($name),

        );
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
