<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Tags\HasTags;
use Carbon\Carbon;

class Posts extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTags;
    use Sluggable;
    protected $fillable = ['title', 'body', 'image', 'user_id', '_token'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function getCreatedAt()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    public function restore()
    {
        $restoredCount = Posts::onlyTrashed()->restore();

        return redirect()->back()->with('success', $restoredCount . ' soft deleted posts restored successfully');
    }
}