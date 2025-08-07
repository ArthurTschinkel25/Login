@extends('layouts.app')

@section('title', 'Catálogo de Filmes')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-primary mb-2">Catálogo de Filmes</h1>
            <p class="text-text-light">Todos os filmes disponíveis em nosso acervo</p>
        </header>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-500/50 text-green-300 px-4 py-3 rounded mb-8 max-w-3xl mx-auto flex items-center">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                <button onclick="this.parentElement.remove()" class="ml-auto text-green-300 hover:text-green-100">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <form method="post" action="{{ route('movies.filter') }}">
            @csrf
            <select id="filtroNota" name="filtroNota">
                <option value="1">0 - 3</option>
                <option value="2">4 - 6</option>
                <option value="3">7 - 8</option>
                <option value="4">9 - 10</option>
            </select>

            <button type="submit">Filtrar</button>
        </form>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($movies as $movie)

                <div class="w-full bg-secondary rounded-xl shadow-2xl shadow-primary/10 overflow-hidden border border-neutral-800 hover:shadow-glow transition-all duration-300 group">
                    <div class="relative aspect-[2/3] overflow-hidden">
                        <img src="{{ $movie->poster_path ? 'https://image.tmdb.org/t/p/w500' .
                            $movie->poster_path : 'https://via.placeholder.com/500x750.png?text=Sem+Imagem' }}"
                             alt="Poster de {{ $movie->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        @if($movie->vote_average)
                            <div class="absolute top-2 left-2 bg-primary/90 text-black px-2 py-1 rounded-full text-xs font-bold flex items-center">
                                <i class="fas fa-star mr-1"></i> {{ number_format($movie->vote_average, 1) }}
                            </div>
                        @endif

                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="bg-primary/90 hover:bg-primary text-black w-12 h-12 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-all">
                                <i class="fas fa-play text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-text-main font-bold truncate">{{ $movie->title }}</h3>
                        <div class="flex justify-between items-center mt-1 text-xs text-text-light">
                            <span>{{ date('Y', strtotime($movie->release_date)) }}</span>
                            @if($movie->runtime)
                                <span class="flex items-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ floor($movie->runtime/60) }}h {{ $movie->runtime%60 }}m
                                </span>
                            @endif
                        </div>

                        @if($movie->genres && count($movie->genres) > 0)
                            <div class="flex flex-wrap gap-1 mt-2">
                                @foreach($movie->genres->take(3) as $genre)
                                    <span class="px-2 py-1 bg-neutral-900/50 text-text-light text-xs rounded-full">{{ $genre->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <button class="w-full mt-3 py-2 bg-primary/10 hover:bg-primary/20 text-primary text-sm font-medium rounded-lg transition-colors flex items-center justify-center">
                            <i class="far fa-bookmark mr-2"></i> Minha Lista
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
