<?php

namespace Database\Seeders;

use App\Models\Livro;
use Illuminate\Database\Seeder;

// Seeder que cadastra livros de exemplo (livros famosos de verdade).
class LivroSeeder extends Seeder
{
    // Editoras usadas nos exemplos.
    public const EDITORAS = ['Companhia das Letras', 'Penguin', 'Rocco', 'Intrínseca', 'Martin Claret', 'Record', 'HarperCollins', 'Novatec', 'Alta Books', 'Suma'];

    // Lista de livros: título, autor, ano, páginas, gênero, idioma original e uma sinopse curta.
    private const LIVROS = [
        ['Dom Casmurro', 'Machado de Assis', 1899, 256, 'Clássico', 'Bentinho relembra a vida e o ciúme que sentia de Capitu.'],
        ['Memórias Póstumas de Brás Cubas', 'Machado de Assis', 1881, 240, 'Clássico', 'Um defunto autor conta a própria vida com muita ironia.'],
        ['O Alienista', 'Machado de Assis', 1882, 96, 'Clássico', 'Um médico decide internar metade da cidade no seu hospício.'],
        ['O Cortiço', 'Aluísio Azevedo', 1890, 304, 'Clássico', 'A vida dos moradores de um cortiço no Rio de Janeiro.'],
        ['Iracema', 'José de Alencar', 1865, 144, 'Romance', 'O amor entre a índia Iracema e o português Martim.'],
        ['Senhora', 'José de Alencar', 1875, 240, 'Romance', 'Aurélia fica rica e compra o marido que a desprezou.'],
        ['Triste Fim de Policarpo Quaresma', 'Lima Barreto', 1915, 288, 'Clássico', 'Um patriota ingênuo tenta mudar o Brasil.'],
        ['Os Sertões', 'Euclides da Cunha', 1902, 640, 'História', 'O relato da Guerra de Canudos no sertão da Bahia.'],
        ['Macunaíma', 'Mário de Andrade', 1928, 224, 'Clássico', 'As aventuras do herói sem nenhum caráter.'],
        ['O Quinze', 'Rachel de Queiroz', 1930, 160, 'Romance', 'A grande seca de 1915 no Ceará.'],
        ['Capitães da Areia', 'Jorge Amado', 1937, 280, 'Romance', 'Um grupo de meninos de rua em Salvador.'],
        ['Vidas Secas', 'Graciliano Ramos', 1938, 176, 'Clássico', 'Uma família de retirantes foge da seca.'],
        ['Grande Sertão: Veredas', 'João Guimarães Rosa', 1956, 624, 'Clássico', 'O jagunço Riobaldo conta suas lutas e seus amores.'],
        ['A Hora da Estrela', 'Clarice Lispector', 1977, 88, 'Romance', 'A vida simples de Macabéa, uma nordestina no Rio.'],
        ['O Alquimista', 'Paulo Coelho', 1988, 208, 'Romance', 'Um pastor viaja ao Egito atrás de um tesouro.'],
        ['Ensaio sobre a Cegueira', 'José Saramago', 1995, 312, 'Romance', 'Uma cegueira misteriosa se espalha pela cidade.'],
        ['Dom Quixote', 'Miguel de Cervantes', 1605, 1248, 'Clássico', 'Um fidalgo enlouquece lendo livros de cavalaria.'],
        ['Orgulho e Preconceito', 'Jane Austen', 1813, 424, 'Romance', 'Elizabeth Bennet e o orgulhoso senhor Darcy.'],
        ['Frankenstein', 'Mary Shelley', 1818, 280, 'Terror', 'Um cientista dá vida a uma criatura.'],
        ['Crime e Castigo', 'Fiódor Dostoiévski', 1866, 592, 'Clássico', 'Um estudante comete um crime e sofre com a culpa.'],
        ['Drácula', 'Bram Stoker', 1897, 464, 'Terror', 'O conde vampiro sai da Transilvânia rumo a Londres.'],
        ['A Metamorfose', 'Franz Kafka', 1915, 96, 'Clássico', 'Gregor Samsa acorda transformado em um inseto.'],
        ['Admirável Mundo Novo', 'Aldous Huxley', 1932, 312, 'Ficção científica', 'Uma sociedade controlada pela ciência e pelo prazer.'],
        ['O Hobbit', 'J. R. R. Tolkien', 1937, 336, 'Fantasia', 'Bilbo parte em uma aventura com treze anões.'],
        ['O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 1943, 96, 'Infantil', 'Um aviador conhece um pequeno príncipe no deserto.'],
        ['A Revolução dos Bichos', 'George Orwell', 1945, 152, 'Clássico', 'Os animais expulsam o dono e tomam a fazenda.'],
        ['1984', 'George Orwell', 1949, 416, 'Ficção científica', 'O Grande Irmão vigia todos o tempo inteiro.'],
        ['Fahrenheit 451', 'Ray Bradbury', 1953, 216, 'Ficção científica', 'Um bombeiro que queima livros começa a ler.'],
        ['O Senhor dos Anéis: A Sociedade do Anel', 'J. R. R. Tolkien', 1954, 576, 'Fantasia', 'Frodo precisa destruir o Um Anel.'],
        ['Cem Anos de Solidão', 'Gabriel García Márquez', 1967, 448, 'Romance', 'A história da família Buendía em Macondo.'],
        ['It: A Coisa', 'Stephen King', 1986, 1104, 'Terror', 'Um grupo de amigos enfrenta um palhaço assustador.'],
        ['Harry Potter e a Pedra Filosofal', 'J. K. Rowling', 1997, 208, 'Fantasia', 'Um menino descobre que é bruxo.'],
        ['O Programador Pragmático', 'Andrew Hunt e David Thomas', 1999, 352, 'Tecnologia', 'Dicas práticas para ser um programador melhor.'],
        ['Código Limpo', 'Robert C. Martin', 2008, 440, 'Tecnologia', 'Como escrever código fácil de ler e de manter.'],
        ['Sapiens', 'Yuval Noah Harari', 2011, 472, 'História', 'Uma breve história da humanidade.'],
        ['Steve Jobs', 'Walter Isaacson', 2011, 624, 'Biografia', 'A vida do fundador da Apple.'],
    ];

    // Roda o seeder.
    public function run(): void
    {
        foreach (self::LIVROS as [$titulo, $autor, $ano, $paginas, $genero, $sinopse]) {
            // Usa a fábrica para preencher o resto (ISBN, preço, estoque...) e troca pelos dados reais.
            Livro::factory()->create([
                'titulo' => $titulo,
                'subtitulo' => null,
                'autor' => $autor,
                'ano_publicacao' => $ano,
                'numero_paginas' => $paginas,
                'genero' => $genero,
                'idioma' => 'Português',
                'sinopse' => $sinopse,
            ]);
        }
    }
}
