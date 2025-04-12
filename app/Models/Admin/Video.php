<?php

namespace App\Models\Admin;

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
        'comments'
    ];
}
