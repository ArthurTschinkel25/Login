<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MovieService;
use App\Models\Movie;

class MovieController extends Controller
{

    public function __construct(private MovieService $movieService) {

    }

    public function index()
    {
        $movies = $this->movieService->returnMovies();
        return view('Movies.movies', [
            'movies' => $movies
        ]);
    }

    public function create()
    {
        return view('Movies.create-movies');
    }

    public function destroy(Movie $movie)
    {
        try {
            $this->movieService->deleteMovie($movie);
            return redirect()->route('movies.index')->with('success', 'Filme excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir filme: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'duracao' => 'required|integer|min:1',
            'nota' => 'required|numeric|between:0,10',
            'genero' => 'required|string|max:100',
        ]);

        $this->movieService->storeMovie($validated);

        return back()->with('success', 'Filme salvo com sucesso!');
    }

}
