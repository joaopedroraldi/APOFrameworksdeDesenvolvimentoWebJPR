<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Livro;

// Controller do dashboard (a página inicial com os números do sistema).
class DashboardController extends Controller
{
    // Conta os registros no banco e manda os números para a tela.
    public function index()
    {
        // count() pergunta ao banco "quantos registros tem nesta tabela?".
        $totalClientes = Cliente::count();
        $totalLivros = Livro::count();

        return view('dashboard', compact('totalClientes', 'totalLivros'));
    }
}
