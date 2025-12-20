<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['project_id', 'item_id', 'quantity', 'rate'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
