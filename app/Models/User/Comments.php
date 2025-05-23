<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'video_id',
        'comment',
    ];

    public function user()
    { 
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
