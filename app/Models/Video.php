<?php

namespace App\Models;

use App\Enums\VideoVisibility;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'visibility' => VideoVisibility::class
    ];

    public const VISIBILITY_DEFAULT = VideoVisibility::Private;

    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    public function views() {
        return $this->hasMany( VideoViews::class );
    }

    public function votes() {
        return $this->hasMany( Vote::class );
    }

    public function getRouteKeyName() {
        return 'uid';
    }

    public function getThumbnailAttribute()
    {
        if ( $this->processed ) {
            return 'videos/' . $this->uid . '/preview.png';
        }
        return 'storage/images/video-placeholder.png';
    }

    public function getViewsCountAttribute()
    {
        return $this->views()->sum('views');
    }

    public function getUploadedDateAttribute()
    {
        $d = new Carbon($this->created_at);
        return $d->toFormattedDateString();
    }

    public function doesUserLikedVideo()
    {
        $user_vote = $this->votes()->where('user_id', auth()->id())->first();
        if ( $user_vote && $user_vote->is_positive ) {
            return true;
        }
        return false;
    }

    public function doesUserDislikeVideo()
    {
        $user_vote = $this->votes()->where('user_id', auth()->id())->first();
        if ( $user_vote && ! $user_vote->is_positive ) {
            return true;
        }
        return false;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function AllCommentsCount()
    {
        return  $this->hasMany(Comment::class)->count();
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('visibility', VideoVisibility::Public);
    }
}
