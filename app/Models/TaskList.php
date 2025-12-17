<?php

namespace App\Models;

use App\Models\ListItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskList extends Model
{
    protected $guarded = [];
    public function listItems(): HasMany
    {
        return $this->hasMany(ListItem::class);
    }
}
