<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration que cria a tabela "clientes" no banco.
return new class extends Migration
{
    // up(): o que fazer quando a migration roda (criar a tabela).
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();                                  // Número único do cliente.
            $table->string('nome');                        // Nome completo.
            $table->string('cpf', 14)->unique();           // CPF no formato 000.000.000-00. Não pode repetir.
            $table->string('email')->nullable();           // E-mail.
            $table->string('telefone', 20)->nullable();    // Telefone ou celular.
            $table->date('data_nascimento')->nullable();   // Data de nascimento.
            $table->string('cep', 9)->nullable();          // CEP no formato 00000-000.
            $table->string('endereco')->nullable();        // Rua, avenida...
            $table->string('numero', 10)->nullable();      // Número da casa.
            $table->string('complemento')->nullable();     // Apartamento, bloco...
            $table->string('bairro', 100)->nullable();     // Bairro.
            $table->string('cidade', 100)->nullable();     // Cidade.
            $table->char('uf', 2)->nullable();             // Estado com 2 letras (PR, SP...).
            $table->text('observacoes')->nullable();       // Anotações livres.
            $table->timestamps();                          // Datas de criação e de alteração.
        });
    }

    // down(): o que fazer para desfazer a migration (apagar a tabela).
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
