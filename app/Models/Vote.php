<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function video() {
        return $this->belongsTo(Video::class);
    }

    public function scopeIsPositive(Builder $query, bool $isPositive): void
    {
        $query->where('is_positive', $isPositive);
    }

    public function scopePositive(Builder $query): void
    {
        $query->isPositive(true);
    }

    public function scopeNegative(Builder $query): void
    {
        $query->isPositive(false);
    }
}
