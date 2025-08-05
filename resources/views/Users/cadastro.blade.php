<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-center">
            <h1 class="text-2xl font-bold text-white">Crie sua conta</h1>
            <p class="text-blue-100 mt-1">Preencha os campos abaixo</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mx-6 mt-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form class="p-6 space-y-6" method="post" action="{{ route('user.create') }}">
            @csrf
            <!-- Campos do formulário (mantidos iguais) -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome completo</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full pl-10 pr-3 py-2 rounded-lg border @error('name') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Seu nome"
                        required
                    >
                </div>
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full pl-10 pr-3 py-2 rounded-lg border @error('email') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="seu@email.com"
                        required
                    >
                </div>
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full pl-10 pr-3 py-2 rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="••••••••"
                        required
                    >
                </div>
                @error('password')
                <div class="flex items-start mt-1">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 text-sm"></i>
                    </div>
                    <div class="ml-2">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @if(str_contains($message, 'confirmação'))
                            <p class="text-xs text-red-500 mt-1">As senhas devem ser idênticas</p>
                        @endif
                    </div>
                </div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar senha</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full pl-10 pr-3 py-2 rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="••••••••"
                        required
                    >
                </div>
            </div>

            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="terms"
                    name="terms"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    required
                >
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    Concordo com os <a href="#" onclick="openModal()" class="text-blue-600 hover:underline">Termos de Serviço</a>
                </label>
            </div>
            @error('terms')
            <p class="text-sm text-red-600">Você deve aceitar os termos de serviço</p>
            @enderror

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                <i class="fas fa-user-plus mr-2"></i> Criar conta
            </button>
        </form>

        <div class="bg-gray-50 px-6 py-4 text-center">
            <p class="text-sm text-gray-600">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Faça login</a>
            </p>
        </div>
    </div>
</div>

<!-- Modal de Termos de Serviço -->
<div id="termsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-bold text-gray-800">Termos de Serviço</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mt-4 max-h-96 overflow-y-auto">
            <h4 class="font-semibold text-lg mb-2">1. Aceitação dos Termos</h4>
            <p class="mb-4 text-gray-700">
                Ao utilizar nossos serviços, você concorda com estes Termos de Serviço. Se não concordar, por favor, não utilize nossos serviços.
            </p>

            <h4 class="font-semibold text-lg mb-2">2. Uso do Serviço</h4>
            <p class="mb-4 text-gray-700">
                Você concorda em usar o serviço apenas para fins legais e de acordo com estes Termos. Você é responsável por manter a confidencialidade de sua conta e senha.
            </p>

            <h4 class="font-semibold text-lg mb-2">3. Privacidade</h4>
            <p class="mb-4 text-gray-700">
                Sua privacidade é importante para nós. Nossa Política de Privacidade explica como coletamos, usamos e protegemos suas informações pessoais.
            </p>

            <h4 class="font-semibold text-lg mb-2">4. Modificações</h4>
            <p class="mb-4 text-gray-700">
                Reservamos o direito de modificar estes Termos a qualquer momento. Alterações significativas serão comunicadas com antecedência.
            </p>

            <h4 class="font-semibold text-lg mb-2">5. Limitação de Responsabilidade</h4>
            <p class="mb-4 text-gray-700">
                Não seremos responsáveis por quaisquer danos diretos, indiretos, incidentais ou consequenciais resultantes do uso ou incapacidade de usar nossos serviços.
            </p>
        </div>

        <div class="flex justify-end mt-4 border-t pt-3">
            <button onclick="closeModal()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Fechar
            </button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('termsModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('termsModal').classList.add('hidden');
    }

    // Fechar modal ao clicar fora do conteúdo
    window.onclick = function(event) {
        const modal = document.getElementById('termsModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
</body>
</html>
