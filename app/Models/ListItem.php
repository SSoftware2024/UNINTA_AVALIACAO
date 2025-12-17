<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListItem extends Model
{
    protected $guarded = [];
    public function taskList(): BelongsTo
    {
        return $this->belongsTo(TaskList::class);
    }
}
