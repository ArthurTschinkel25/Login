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

    public function filterByRating(int $rating)
    {
        $valorInicial = 0;
        $valorFinal = 10;

        if ($rating === 1) {
            $valorInicial = 0;
            $valorFinal = 3;
        } elseif ($rating === 2) {
            $valorInicial = 3;
            $valorFinal = 6;
        } elseif ($rating === 3) {
            $valorInicial = 6;
            $valorFinal = 10;
        }

        return Movie::whereBetween('vote_average', [$valorInicial, $valorFinal])->get();
    }


}
