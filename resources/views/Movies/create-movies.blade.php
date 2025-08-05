<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Filmes</title>
    <title>Cadastro de Filmes</title>

        <title class="teste"> oi</title>


    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-indigo-700">
            <i class="fas fa-film mr-2"></i>Cadastro de Filmes
        </h1>
        <p class="text-gray-600 mt-2">Preencha os detalhes do filme</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('movies.store') }}">
            @csrf

            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 font-medium mb-2">
                    <i class="fas fa-heading mr-2 text-indigo-500"></i>Título do Filme
                </label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('titulo') border-red-500 @enderror"
                       placeholder="Ex: O Poderoso Chefão">
                @error('titulo')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="duracao" class="block text-gray-700 font-medium mb-2">
                    <i class="fas fa-clock mr-2 text-indigo-500"></i>Duração (minutos)
                </label>
                <input type="number" id="duracao" name="duracao" value="{{ old('duracao') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('duracao') border-red-500 @enderror"
                       placeholder="Ex: 120">
                @error('duracao')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nota" class="block text-gray-700 font-medium mb-2">
                    <i class="fas fa-star mr-2 text-indigo-500"></i>Nota (0-10)
                </label>
                <input type="number" step="0.1" id="nota" name="nota" value="{{ old('nota') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('nota') border-red-500 @enderror"
                       placeholder="Ex: 8.5">
                @error('nota')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="genero" class="block text-gray-700 font-medium mb-2">
                    <i class="fas fa-tag mr-2 text-indigo-500"></i>Gênero
                </label>
                <input type="text" id="genero" name="genero" value="{{ old('genero') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('genero') border-red-500 @enderror"
                       placeholder="Ex: Drama, Ação">
                @error('genero')
                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                <i class="fas fa-save mr-2"></i>Salvar Filme
            </button>
        </form>
    </div>

    <div class="mt-8 text-center text-gray-500 text-sm">
        <p>Sistema de Cadastro de Filmes &copy; {{ date('Y') }}</p>
    </div>
</div>
</body>
</html>
