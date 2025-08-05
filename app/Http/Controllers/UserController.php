<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $loginService){

    }

    private $messages = [
        'email.required' => 'O campo e-mail é obrigatório',
        'email.email' => 'O e-mail informado não é válido',
        'password.required' => 'O campo senha é obrigatório',
        'password.confirmed' => 'As senhas devem ser iguais',
        'password.min' => 'A senha deve ter pelo menos 8 caracteres',
        'password.regex' => 'A senha deve conter letras maiúsculas e caracteres especiais.',
        'email.exists' => 'O e-mail informado não está cadastrado no nosso sistema'
    ];

    public function Register(Request $request){
        return view('Users.cadastro');
    }

    public function AlterarSenha(Request $request){
        return view('Users.alterar_senha');
    }

    public function Login(){
        return view('Users.login');
    }
    public function Create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', 'regex:/[A-Z]/', 'regex:/\W/'],
            'terms' => 'required'
        ], $this->messages);



        try {
                $this->loginService->CreateUser($validated);
                return redirect()->route('user.login')->with('success', 'Conta criada com sucesso!');
            }
         catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar uma conta: ' . $e->getMessage());
        }
    }

    public function Update(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[A-Z]/', 'regex:/\W/'],
        ], $this->messages);

        try {
            $this->loginService->UpdateUser($validated);
            return redirect()->route('user.login')->with('success', 'Senha alterada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao alterar a senha: ' . $e->getMessage());
        }
    }

}
