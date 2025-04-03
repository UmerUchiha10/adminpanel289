<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
 
use App\Models\Scopes\EventScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([EventScope::class])]
class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePrice(Builder $query): void
    {
        $query->where('price', '<', 4000);
    }
}
