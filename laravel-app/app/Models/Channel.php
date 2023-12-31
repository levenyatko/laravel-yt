<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getRouteKeyName() {
        return 'slug';
    }

}
