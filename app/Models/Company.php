<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Company extends Model
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
      public function usages()
    {
        return $this->hasOne(Usage::class, 'company_id', 'id');
    }
    
}
