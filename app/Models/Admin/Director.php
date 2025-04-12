<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $table = 'director';

    protected $fillable = [
        'movie_id',
        'name',
        'dob',
        'country',
        'descripton',
        'picture'
    ];
}
