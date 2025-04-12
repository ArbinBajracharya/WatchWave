<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $table = 'cast';

    protected $fillable = [
        'movie_id',
        'name',
        'dob',
        'country',
        'descripton',
        'picture'
    ];
}
