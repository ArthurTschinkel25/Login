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

        <div class="rounded-lg shadow-md overflow-hidden bg-secondary border border-neutral-800">
            <div class="overflow-x-auto bg-secondary">
                <table class="min-w-full divide-y divide-neutral-800">
                    <thead class="bg-neutral-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                            Título
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                            Ano
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                            Gênero
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                            Duração
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-light uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-secondary divide-y divide-neutral-800">
                    @foreach($movies as $movie)
                        <tr class="hover:bg-neutral-800/50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $movie->poster_url ?? 'https://via.placeholder.com/100' }}" alt="Poster">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-text-main">{{ $movie->titulo }}</div>
                                        <div class="text-sm text-text-light">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-900/70 text-yellow-300">
                                                <i class="fas fa-star mr-1 text-yellow-400"></i> {{ $movie->avaliacao ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-light">
                                {{ $movie->ano ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-900/70 text-blue-300">
                                    {{ $movie->genero ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-light">
                                {{ $movie->duracao ?? 'N/A' }} min
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-accent hover:text-green-400">
                                        <i class="far fa-eye"></i> Ver
                                    </a>
                                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400" onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                                            <i class="far fa-trash-alt"></i> Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-secondary px-4 py-3 flex items-center justify-between border-t border-neutral-800 sm:px-6">
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-text-light">
                            Mostrando
                            <span class="font-medium text-text-main">1</span>
                            a
                            <span class="font-medium text-text-main">10</span>
                            de
                            <span class="font-medium text-text-main">{{ count($movies) }}</span>
                            resultados
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-neutral-700 bg-secondary text-sm font-medium text-text-light hover:bg-neutral-800/50">
                                <span class="sr-only">Anterior</span>
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-primary/20 border-primary text-primary relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                1
                            </a>
                            <a href="#" class="bg-secondary border-neutral-700 text-text-light hover:bg-neutral-800/50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                2
                            </a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-neutral-700 bg-secondary text-sm font-medium text-text-light hover:bg-neutral-800/50">
                                <span class="sr-only">Próximo</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
