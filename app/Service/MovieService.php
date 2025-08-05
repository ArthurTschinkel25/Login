<?php

namespace App\Service;

use App\Models\Movie;

class MovieService
{
    public function storeMovie(array $data): void
    {
        Movie::create($data);
    }

    public function deleteMovie(Movie $movie)
    {
        $movie->delete($movie);
    }
    public function returnMovies()
    {
        return Movie::all();
    }

    public function getHighRatedMovies()
    {
        return Movie::where('nota', '>', 5)
            ->orderBy('nota', 'desc')
            ->get();
    }
}
