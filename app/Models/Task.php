<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'completed', 'manager_id'];

    protected function casts(): array
    {
        return ['completed' => 'boolean'];
    }

    public function manager(): BelongsTo
    {
    return $this->belongsTo(Manager::class);
    }
}
