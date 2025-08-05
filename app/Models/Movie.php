<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    protected $fillable = [
        'titulo',
        'genero',
        'duracao',
        'nota'
    ];
}
