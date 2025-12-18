<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'category_id', 'kingdom_id', 'rate', 'status'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function kingdom(): BelongsTo
    {
        return $this->belongsTo(Kingdom::class, 'kingdom_id');
    }
}
