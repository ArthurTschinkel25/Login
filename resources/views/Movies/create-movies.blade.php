@extends('layouts.app')

@section('title', 'Criação de Filmes')

@section('content')

    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-primary">
                <i class="fas fa-film mr-2"></i>Cadastro de Filmes
            </h1>
            <p class="text-text-light mt-2">Preencha os detalhes do filme abaixo</p>
        </div>

        <div class="bg-secondary rounded-xl shadow-2xl shadow-primary/10 border border-neutral-800 p-6 sm:p-8">
            @if(session('success'))
                <div class="bg-green-900/50 border border-green-500/50 text-green-300 px-4 py-3 rounded mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('movies.store') }}">
                @csrf

                <div class="mb-5">
                    <label for="titulo" class="block text-text-light font-medium mb-2">
                        <i class="fas fa-heading mr-2 text-primary/70"></i>Título do Filme
                    </label>
                    <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                           class="w-full bg-neutral-900/50 px-4 py-3 border border-neutral-700 rounded-lg text-text-main placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-primary/50 transition duration-200 @error('titulo') border-red-500 @enderror"
                           placeholder="Ex: O Poderoso Chefão">
                    @error('titulo')
                    <p class="text-red-400 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="duracao" class="block text-text-light font-medium mb-2">
                        <i class="fas fa-clock mr-2 text-primary/70"></i>Duração (minutos)
                    </label>
                    <input type="number" id="duracao" name="duracao" value="{{ old('duracao') }}"
                           class="w-full bg-neutral-900/50 px-4 py-3 border border-neutral-700 rounded-lg text-text-main placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-primary/50 transition duration-200 @error('duracao') border-red-500 @enderror"
                           placeholder="Ex: 120">
                    @error('duracao')
                    <p class="text-red-400 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="nota" class="block text-text-light font-medium mb-2">
                        <i class="fas fa-star mr-2 text-primary/70"></i>Nota (0 a 10)
                    </label>
                    <input type="number" step="0.1" id="nota" name="nota" value="{{ old('nota') }}"
                           class="w-full bg-neutral-900/50 px-4 py-3 border border-neutral-700 rounded-lg text-text-main placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-primary/50 transition duration-200 @error('nota') border-red-500 @enderror"
                           placeholder="Ex: 8.5">
                    @error('nota')
                    <p class="text-red-400 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="genero" class="block text-text-light font-medium mb-2">
                        <i class="fas fa-tag mr-2 text-primary/70"></i>Gênero
                    </label>
                    <input type="text" id="genero" name="genero" value="{{ old('genero') }}"
                           class="w-full bg-neutral-900/50 px-4 py-3 border border-neutral-700 rounded-lg text-text-main placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-primary/50 transition duration-200 @error('genero') border-red-500 @enderror"
                           placeholder="Ex: Drama, Ação">
                    @error('genero')
                    <p class="text-red-400 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-primary hover:bg-green-400 text-black font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center shadow-lg shadow-primary/20 hover:shadow-primary/40">
                    <i class="fas fa-save mr-2"></i>Salvar Filme
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('movies.index') }}" class="text-text-light hover:text-primary transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Voltar para o Catálogo
            </a>
        </div>
    </div>

@endsection
