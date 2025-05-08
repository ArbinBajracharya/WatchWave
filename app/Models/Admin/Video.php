<?php

namespace App\Models\Admin;

use App\Models\User\Comments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video';

    protected $fillable = [
        'title',
        'genre',
        'language',
        'country',
        'type',
        'cast',
        'director',
        'relase_date',
        'duration',
        'picture',
        'video',
        'trailer',
        'description',
        'rating',
        'comments',
        'watchlist',
        'likes',
    ];

    public function comments()
    {
        return $this->hasMany(Comments::class, 'video_id');
    }
}
