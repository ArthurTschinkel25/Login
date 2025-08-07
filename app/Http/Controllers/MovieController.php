<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MovieService;
use App\Models\Movie;

class MovieController extends Controller
{

    public function __construct(private MovieService $movieService)
    {

    }

    public function index()
    {
        $movies = $this->movieService->returnMovies();

        $filteredMovies = session('filteredMovies');

        if($filteredMovies)
        {
            return view('Movies.movies', [
                'movies' => $filteredMovies
            ]);
        }


        return view('Movies.movies', [
            'movies' => $movies
        ]);
    }

    public function populateMoviesFromApi()
    {
        $apiKey = config('services.tmdb.key');
        $allMovieIds = [];

        for ($page = 1; $page <= 10; $page++) {
            $apiUrl = "https://api.themoviedb.org/3/movie/popular?api_key={$apiKey}&language=pt-BR&page={$page}";
            $response = @file_get_contents($apiUrl);

            if ($response === false) {
                echo "Erro ao buscar a página {$page}.\n";
                continue;
            }

            $data = json_decode($response, true);

            if (isset($data['results'])) {
                foreach ($data['results'] as $movieData) {
                    $allMovieIds[] = $movieData['id'];
                    Movie::Where('id', $movieData['id']);


                    Movie::updateOrCreate(
                        ['id' => $movieData['id']],
                        $movieData
                    );
                }
            }
            sleep(1);
        }

        echo "Os filmes foram salvos/atualizados no banco de dados com sucesso!\n";
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

    public function filter(Request $request)
    {
        $dados = $request->all();

       $filteredMovies = $this->movieService->filterByRating($dados['filtroNota']);

        return back()->with('filteredMovies', $filteredMovies);
    }


}
