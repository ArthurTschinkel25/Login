<?php

namespace App\Service;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class MovieService
{

    public function deleteMovie(Movie $movie)
    {
        $movie->delete($movie);
    }
    public function returnMovies()
    {
        $movies = DB::table('movies')
            ->join('genres', 'id', '=', 'movies.genre_ids')
            ->select('movies.*', 'genres._genre_name as genre_name')
            ->get();
        var_dump($movies);

        return Movie::all();
    }

    public function filterByRating(int $rating)
    {
        $query = Movie::query();

        switch ($rating) {
            case 0:
                break;
            case 1:
                $query->whereBetween('vote_average', [0, 2]);
                break;
            case 2:
                $query->whereBetween('vote_average', [3, 5]);
                break;
            case 3:
                $query->whereBetween('vote_average', [6, 7]);
                break;
            case 4:
                $query->whereBetween('vote_average', [8, 9]);
                break;
            case 5:
                $query->whereBetween('vote_average', [10,10]);
                break;
            default:
                break;
        }

        return $query->orderBy('vote_average', 'desc')->get();

    }


}
