@extends('layouts.app')

@section('title', 'Catálogo de Filmes')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-primary mb-2">Catálogo de Filmes</h1>
            <p class="text-text-light">Explore nosso acervo cinematográfico</p>
        </header>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-500/50 text-green-300 px-4 py-3 rounded mb-8 max-w-3xl mx-auto flex items-center">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                <button onclick="this.parentElement.remove()" class="ml-auto text-green-300 hover:text-green-100">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Filtros melhorados -->
        <div class="mb-8 bg-secondary/50 p-4 rounded-xl border border-neutral-800">
            <h2 class="text-xl font-semibold text-text-main mb-4">Filtrar por</h2>

            <form method="post" action="{{ route('movies.filter') }}" class="flex flex-col sm:flex-row gap-4 items-center">
                @csrf
                <div class="w-full sm:w-auto">
                    <label for="filtroNota" class="block text-sm font-medium text-text-light mb-1">Avaliação</label>
                    <div class="relative">
                        <select id="filtroNota" name="filtroNota" class="appearance-none bg-neutral-900 border border-neutral-700 text-text-main rounded-lg pl-4 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full">
                            <option value="0">Todas as avaliações</option>
                            <option value="1">⭐ 0 - 2 (Básico)</option>
                            <option value="2">⭐⭐ 3 - 5 (Regular)</option>
                            <option value="3">⭐⭐⭐ 6 - 7 (Bom)</option>
                            <option value="4">⭐⭐⭐⭐ 8 - 9 (Excelente)</option>
                            <option value="5">⭐⭐⭐⭐⭐ 10 (Perfeito)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-text-light">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="mt-6 sm:mt-0 bg-primary hover:bg-primary/90 text-black font-medium py-2 px-6 rounded-lg transition-colors flex items-center gap-2">
                    <i class="fas fa-filter"></i> Filtrar
                </button>

                @if(request()->is('movies/filter'))
                    <a href="{{ route('movies.index') }}" class="mt-6 sm:mt-0 bg-neutral-700 hover:bg-neutral-600 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center gap-2">
                        <i class="fas fa-times"></i> Limpar filtros
                    </a>
                @endif
            </form>
        </div>

        <!-- Contador de resultados -->
        <div class="mb-6 flex justify-between items-center">
            <p class="text-text-light">
                Mostrando <span class="font-semibold text-text-main">{{ $movies->count() }}</span>
                {{ $movies->count() === 1 ? 'filme' : 'filmes' }}
            </p>
        </div>

        @if($movies->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach ($movies as $movie)
                    <div class="w-full bg-secondary rounded-xl shadow-2xl shadow-primary/10 overflow-hidden border border-neutral-800 hover:shadow-glow transition-all duration-300 group hover:-translate-y-1">
                        <div class="relative aspect-[2/3] overflow-hidden">
                            <img src="{{ $movie->poster_path ? 'https://image.tmdb.org/t/p/w500' . $movie->poster_path : 'https://via.placeholder.com/500x750.png?text=Sem+Imagem' }}"
                                 alt="Poster de {{ $movie->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <!-- Avaliação com barra de progresso -->
                            <div class="absolute top-2 left-2 w-10 h-10 flex items-center justify-center">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    <path
                                        d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none"
                                        stroke="#2d3748"
                                        stroke-width="3"
                                    />
                                    <path
                                        d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none"
                                        stroke="#f59e0b"
                                        stroke-width="3"
                                        stroke-dasharray="{{ ($movie->vote_average / 10) * 100 }}, 100"
                                    />
                                </svg>
                                <div class="absolute text-xs font-bold text-white">
                                    {{ number_format($movie->vote_average, 1) }}
                                </div>
                            </div>

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <div>
                                    @if($movie->tagline)
                                        <p class="text-text-light italic text-sm mb-2">"{{ $movie->tagline }}"</p>
                                    @endif
                                    <button class="w-full bg-primary hover:bg-primary/90 text-black font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                                        <i class="fas fa-play"></i> Assistir
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="text-text-main font-bold truncate" title="{{ $movie->title }}">{{ $movie->title }}</h3>
                            <div class="flex justify-between items-center mt-1 text-xs text-text-light">
                                <span>{{ $movie->release_date ? date('Y', strtotime($movie->release_date)) : 'N/A' }}</span>
                                @if($movie->runtime)
                                    <span class="flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ floor($movie->runtime/60) }}h {{ $movie->runtime%60 }}m
                                    </span>
                                @endif
                            </div>

                            @if($movie->genres && count($movie->genres) > 0)
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach($movie->genres->take(2) as $genre)
                                        <span class="px-2 py-1 bg-neutral-900/50 text-text-light text-xs rounded-full">{{ $genre->name }}</span>
                                    @endforeach
                                    @if(count($movie->genres) > 2)
                                        <span class="px-2 py-1 bg-neutral-900/50 text-text-light text-xs rounded-full">+{{ count($movie->genres) - 2 }}</span>
                                    @endif
                                </div>
                            @endif

                            <div class="mt-3 flex gap-2">
                                <button class="flex-1 py-2 bg-primary/10 hover:bg-primary/20 text-primary text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <i class="far fa-bookmark"></i>
                                </button>
                                <button class="flex-1 py-2 bg-neutral-700 hover:bg-neutral-600 text-text-light text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <i class="far fa-star"></i>
                                </button>
                                <button class="flex-1 py-2 bg-neutral-700 hover:bg-neutral-600 text-text-light text-sm font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-secondary/50 border border-neutral-800 rounded-xl p-8 text-center">
                <i class="fas fa-film text-4xl text-text-light mb-4"></i>
                <h3 class="text-xl font-semibold text-text-main mb-2">Nenhum filme encontrado</h3>
                <p class="text-text-light mb-4">Não encontramos filmes com os critérios selecionados.</p>
                <a href="{{ route('movies.index') }}" class="inline-block bg-primary hover:bg-primary/90 text-black font-medium py-2 px-6 rounded-lg transition-colors">
                    Ver todos os filmes
                </a>
            </div>
        @endif
    </div>
@endsection
