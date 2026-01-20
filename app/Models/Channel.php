<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Channel extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function videos() {
        return $this->hasMany( Video::class );
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribers()
    {
        return $this->subscriptions->count();
    }

    public function isOwnedBy(?User $user): bool
    {
        if (is_null($user)) {
            return false;
        }
        return ($this->attributes['user_id'] === $user->id);
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getImageUrlAttribute()
    {
        if (!empty($this->attributes['image'])) {
            return Storage::url('images/' . $this->attributes['image']);
        }
        return '';
    }
}
