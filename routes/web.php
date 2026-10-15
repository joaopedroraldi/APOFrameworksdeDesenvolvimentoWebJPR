<?php

use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstalacaoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Rotas para quem NÃO está logado (o "guest" manda quem já está logado para o início).
Route::middleware('guest')->group(function () {
    // Tela de login e envio do formulário de login.
    // O throttle deixa tentar no máximo 5 logins por minuto, para ninguém ficar chutando senha.
    Route::get('/login', [AutenticacaoController::class, 'formularioLogin'])->name('login');
    Route::post('/login', [AutenticacaoController::class, 'entrar'])->middleware('throttle:5,1')->name('login.entrar');

    // Tela de cadastro e envio do formulário de cadastro.
    Route::get('/cadastro', [AutenticacaoController::class, 'formularioCadastro'])->name('cadastro');
    Route::post('/cadastro', [AutenticacaoController::class, 'cadastrar'])->middleware('throttle:5,1')->name('cadastro.salvar');
});

// Rotas que só funcionam para quem ESTÁ logado (o "auth" manda quem não está para o login).
Route::middleware('auth')->group(function () {
    // Página inicial: o dashboard com os indicadores.
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD de clientes. Esta linha cria as rotas de uma vez:
    // listar, criar (tela e salvar), editar (tela e salvar) e excluir.
    // O except('show') tira a tela de "ver", porque os dados aparecem num popup na própria lista.
    Route::resource('clientes', ClienteController::class)->except('show');

    // CRUD de livros. Mesma ideia, também sem a tela de "ver".
    Route::resource('livros', LivroController::class)->except('show');

    // Área de usuários. O except('show') tira a tela de "ver", que aqui não é necessária.
    Route::resource('usuarios', UsuarioController::class)->except('show');

    // Sair do sistema. É POST para ninguém deslogar a pessoa só com um link.
    Route::post('/sair', [AutenticacaoController::class, 'sair'])->name('sair');
});

// Roda as migrations pelo navegador.
// O throttle deixa acessar no máximo 10 vezes por minuto, para ninguém ficar chutando a senha.
Route::get('/instalar', [InstalacaoController::class, 'migrar'])
    ->middleware('throttle:10,1')
    ->name('instalar');
