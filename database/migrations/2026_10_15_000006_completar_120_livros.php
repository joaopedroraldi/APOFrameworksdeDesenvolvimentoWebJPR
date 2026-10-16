<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// Migration que cadastra mais livros de exemplo até o sistema chegar a 120 livros.
// Título, autor, ano, gênero e sinopse são reais. As páginas são aproximadas.
// ISBN, editora, preço, estoque, edição, formato e situação são sorteados (dados de exemplo).
return new class extends Migration
{
    // Quantidade de livros que o sistema deve ter no final.
    private int $meta = 120;

    // Lista: título, autor, ano, páginas, gênero e sinopse.
    private array $livros = [
        // Literatura brasileira e portuguesa
        ['O Primo Basílio', 'Eça de Queirós', 1878, 400, 'Clássico', 'Luísa trai o marido com o primo e passa a ser chantageada pela empregada.'],
        ['Os Maias', 'Eça de Queirós', 1888, 720, 'Clássico', 'A história de três gerações de uma família rica de Lisboa.'],
        ['Quincas Borba', 'Machado de Assis', 1891, 288, 'Clássico', 'Rubião herda a fortuna de um filósofo e também o cachorro dele.'],
        ['Esaú e Jacó', 'Machado de Assis', 1904, 256, 'Clássico', 'Dois irmãos gêmeos rivais disputam tudo, até o amor da mesma moça.'],
        ['A Moreninha', 'Joaquim Manuel de Macedo', 1844, 176, 'Romance', 'Uma aposta entre estudantes vira uma história de amor numa ilha.'],
        ['O Ateneu', 'Raul Pompeia', 1888, 240, 'Clássico', 'As memórias de um menino num colégio interno muito rígido.'],
        ['Inocência', 'Visconde de Taunay', 1872, 192, 'Romance', 'Um amor proibido no sertão de Mato Grosso.'],
        ['São Bernardo', 'Graciliano Ramos', 1934, 224, 'Romance', 'Paulo Honório conta como conquistou uma fazenda e perdeu a esposa.'],
        ['Gabriela, Cravo e Canela', 'Jorge Amado', 1958, 448, 'Romance', 'O romance entre um comerciante árabe e Gabriela, em Ilhéus.'],
        ['Dona Flor e Seus Dois Maridos', 'Jorge Amado', 1966, 528, 'Romance', 'Dona Flor casa de novo, mas o primeiro marido volta como fantasma.'],
        ['A Paixão Segundo G.H.', 'Clarice Lispector', 1964, 176, 'Romance', 'Uma mulher vive uma crise profunda depois de encontrar uma barata.'],
        ['Sagarana', 'João Guimarães Rosa', 1946, 400, 'Clássico', 'Contos sobre a vida e as histórias do sertão mineiro.'],
        ['O Tempo e o Vento: O Continente', 'Erico Verissimo', 1949, 592, 'Romance', 'A formação do Rio Grande do Sul contada pela família Terra Cambará.'],
        ['Fogo Morto', 'José Lins do Rego', 1943, 352, 'Romance', 'A decadência dos engenhos de açúcar no Nordeste.'],
        ['Morte e Vida Severina', 'João Cabral de Melo Neto', 1955, 64, 'Poesia', 'Um retirante atravessa o sertão em direção ao litoral.'],
        ['Alguma Poesia', 'Carlos Drummond de Andrade', 1930, 112, 'Poesia', 'O primeiro livro de poemas de Drummond.'],
        ['Mensagem', 'Fernando Pessoa', 1934, 112, 'Poesia', 'Poemas sobre a história e os heróis de Portugal.'],
        ['Os Lusíadas', 'Luís de Camões', 1572, 448, 'Poesia', 'O poema épico das navegações portuguesas.'],
        ['Auto da Compadecida', 'Ariano Suassuna', 1955, 208, 'Clássico', 'As trapalhadas de João Grilo e Chicó no sertão nordestino.'],
        ['O Meu Pé de Laranja Lima', 'José Mauro de Vasconcelos', 1968, 192, 'Romance', 'Zezé, um menino pobre, faz amizade com um pé de laranja lima.'],
        ['Reinações de Narizinho', 'Monteiro Lobato', 1931, 256, 'Infantil', 'As aventuras de Narizinho e Emília no Sítio do Picapau Amarelo.'],
        ['A Bolsa Amarela', 'Lygia Bojunga', 1976, 136, 'Infantil', 'Raquel esconde seus desejos numa bolsa amarela.'],
        ['O Menino Maluquinho', 'Ziraldo', 1980, 112, 'Infantil', 'Um menino alegre e cheio de imaginação que usa uma panela na cabeça.'],
        ['Torto Arado', 'Itamar Vieira Junior', 2019, 264, 'Romance', 'Duas irmãs crescem numa fazenda no sertão da Bahia.'],
        ['Cidade de Deus', 'Paulo Lins', 1997, 552, 'Romance', 'O crescimento do crime numa comunidade do Rio de Janeiro.'],
        ['Budapeste', 'Chico Buarque', 2003, 176, 'Romance', 'Um escritor fantasma divide a vida entre o Rio e Budapeste.'],
        ['Memorial do Convento', 'José Saramago', 1982, 352, 'Romance', 'Um casal acompanha a construção de um convento e de uma máquina voadora.'],

        // Clássicos internacionais
        ['Os Miseráveis', 'Victor Hugo', 1862, 1500, 'Clássico', 'Jean Valjean tenta recomeçar a vida depois de sair da prisão.'],
        ['O Conde de Monte Cristo', 'Alexandre Dumas', 1844, 1300, 'Clássico', 'Preso injustamente, Edmond Dantès foge e planeja sua vingança.'],
        ['Os Três Mosqueteiros', 'Alexandre Dumas', 1844, 720, 'Clássico', 'D\'Artagnan se junta a três mosqueteiros do rei.'],
        ['Madame Bovary', 'Gustave Flaubert', 1857, 400, 'Clássico', 'Emma, entediada com o casamento, busca uma vida de romance.'],
        ['Guerra e Paz', 'Liev Tolstói', 1869, 1500, 'Clássico', 'Famílias russas durante a invasão de Napoleão.'],
        ['Anna Kariênina', 'Liev Tolstói', 1878, 864, 'Clássico', 'Anna deixa o marido por um amor e enfrenta a sociedade russa.'],
        ['Os Irmãos Karamázov', 'Fiódor Dostoiévski', 1880, 1000, 'Clássico', 'Três irmãos e a morte misteriosa do pai.'],
        ['O Retrato de Dorian Gray', 'Oscar Wilde', 1890, 256, 'Clássico', 'Um jovem continua belo enquanto seu retrato envelhece.'],
        ['O Grande Gatsby', 'F. Scott Fitzgerald', 1925, 208, 'Romance', 'Um milionário misterioso tenta reconquistar um amor do passado.'],
        ['O Sol é para Todos', 'Harper Lee', 1960, 364, 'Romance', 'Um advogado defende um homem negro acusado injustamente.'],
        ['O Apanhador no Campo de Centeio', 'J. D. Salinger', 1951, 256, 'Romance', 'Um adolescente vaga por Nova York depois de ser expulso da escola.'],
        ['Moby Dick', 'Herman Melville', 1851, 656, 'Clássico', 'O capitão Ahab persegue uma baleia branca gigante.'],
        ['As Aventuras de Tom Sawyer', 'Mark Twain', 1876, 272, 'Clássico', 'As travessuras de um menino às margens do rio Mississippi.'],
        ['Alice no País das Maravilhas', 'Lewis Carroll', 1865, 176, 'Fantasia', 'Alice cai numa toca de coelho e encontra um mundo absurdo.'],
        ['Jane Eyre', 'Charlotte Brontë', 1847, 560, 'Romance', 'Uma órfã vira governanta e se apaixona pelo patrão.'],
        ['O Morro dos Ventos Uivantes', 'Emily Brontë', 1847, 416, 'Romance', 'O amor e a vingança de Heathcliff e Catherine.'],
        ['Razão e Sensibilidade', 'Jane Austen', 1811, 424, 'Romance', 'Duas irmãs muito diferentes enfrentam o amor e a falta de dinheiro.'],
        ['O Processo', 'Franz Kafka', 1925, 272, 'Clássico', 'Josef K. é processado sem nunca saber do que é acusado.'],
        ['O Estrangeiro', 'Albert Camus', 1942, 128, 'Romance', 'Meursault comete um crime e encara o julgamento com indiferença.'],
        ['A Peste', 'Albert Camus', 1947, 320, 'Romance', 'Uma epidemia isola a cidade de Orã, na Argélia.'],
        ['O Velho e o Mar', 'Ernest Hemingway', 1952, 128, 'Romance', 'Um velho pescador luta dias com um peixe gigante.'],

        // Suspense e terror
        ['O Nome da Rosa', 'Umberto Eco', 1980, 560, 'Suspense', 'Um frade investiga mortes misteriosas num mosteiro medieval.'],
        ['O Código Da Vinci', 'Dan Brown', 2003, 432, 'Suspense', 'Um professor desvenda um segredo escondido em obras de arte.'],
        ['Assassinato no Expresso do Oriente', 'Agatha Christie', 1934, 256, 'Suspense', 'Hercule Poirot investiga um crime num trem parado pela neve.'],
        ['E Não Sobrou Nenhum', 'Agatha Christie', 1939, 288, 'Suspense', 'Dez pessoas numa ilha morrem uma a uma.'],
        ['O Cão dos Baskervilles', 'Arthur Conan Doyle', 1902, 224, 'Suspense', 'Sherlock Holmes investiga uma lenda sobre um cão assustador.'],
        ['Garota Exemplar', 'Gillian Flynn', 2012, 448, 'Suspense', 'Uma mulher desaparece e o marido vira o principal suspeito.'],
        ['O Silêncio dos Inocentes', 'Thomas Harris', 1988, 368, 'Suspense', 'Uma agente do FBI pede ajuda a Hannibal Lecter para pegar um assassino.'],
        ['Os Homens que Não Amavam as Mulheres', 'Stieg Larsson', 2005, 528, 'Suspense', 'Um jornalista e uma hacker investigam um desaparecimento antigo.'],
        ['O Iluminado', 'Stephen King', 1977, 464, 'Terror', 'Um escritor enlouquece num hotel isolado durante o inverno.'],
        ['Carrie, a Estranha', 'Stephen King', 1974, 256, 'Terror', 'Uma garota humilhada na escola descobre poderes telecinéticos.'],
        ['O Médico e o Monstro', 'Robert Louis Stevenson', 1886, 128, 'Terror', 'O doutor Jekyll cria uma poção que o transforma em Mr. Hyde.'],

        // Ficção científica e fantasia
        ['Duna', 'Frank Herbert', 1965, 680, 'Ficção científica', 'Paul Atreides luta pelo controle de um planeta deserto.'],
        ['Fundação', 'Isaac Asimov', 1951, 320, 'Ficção científica', 'Um matemático prevê a queda do Império Galáctico.'],
        ['Eu, Robô', 'Isaac Asimov', 1950, 320, 'Ficção científica', 'Contos sobre robôs e as Três Leis da Robótica.'],
        ['Neuromancer', 'William Gibson', 1984, 320, 'Ficção científica', 'Um hacker é contratado para um último trabalho no ciberespaço.'],
        ['O Guia do Mochileiro das Galáxias', 'Douglas Adams', 1979, 208, 'Ficção científica', 'Arthur Dent viaja pelo espaço depois que a Terra é destruída.'],
        ['O Conto da Aia', 'Margaret Atwood', 1985, 368, 'Ficção científica', 'Num governo autoritário, mulheres perdem todos os direitos.'],
        ['As Crônicas de Nárnia: O Leão, a Feiticeira e o Guarda-Roupa', 'C. S. Lewis', 1950, 208, 'Fantasia', 'Quatro irmãos entram num mundo mágico por um guarda-roupa.'],
        ['O Nome do Vento', 'Patrick Rothfuss', 2007, 656, 'Fantasia', 'Kvothe conta a história de como virou uma lenda.'],
        ['A Guerra dos Tronos', 'George R. R. Martin', 1996, 592, 'Fantasia', 'Famílias nobres disputam o Trono de Ferro.'],
        ['O Senhor dos Anéis: As Duas Torres', 'J. R. R. Tolkien', 1954, 464, 'Fantasia', 'A Sociedade do Anel se divide e a guerra começa.'],
        ['O Senhor dos Anéis: O Retorno do Rei', 'J. R. R. Tolkien', 1955, 528, 'Fantasia', 'A batalha final pela Terra-média.'],
        ['Harry Potter e a Câmara Secreta', 'J. K. Rowling', 1998, 288, 'Fantasia', 'Alunos de Hogwarts começam a ser petrificados.'],
        ['A Menina que Roubava Livros', 'Markus Zusak', 2005, 480, 'Romance', 'Uma menina rouba livros na Alemanha nazista.'],

        // Biografia e história
        ['O Diário de Anne Frank', 'Anne Frank', 1947, 352, 'Biografia', 'O diário de uma menina judia escondida durante a guerra.'],
        ['Eu Sou Malala', 'Malala Yousafzai', 2013, 360, 'Biografia', 'A jovem que lutou pelo direito das meninas de estudar.'],
        ['Longa Caminhada até a Liberdade', 'Nelson Mandela', 1994, 768, 'Biografia', 'A autobiografia de Nelson Mandela.'],
        ['Armas, Germes e Aço', 'Jared Diamond', 1997, 480, 'História', 'Por que algumas sociedades dominaram outras ao longo da história.'],
        ['1808', 'Laurentino Gomes', 2007, 416, 'História', 'A vinda da família real portuguesa para o Brasil.'],
        ['Homo Deus', 'Yuval Noah Harari', 2015, 448, 'História', 'Uma reflexão sobre o futuro da humanidade.'],

        // Autoajuda
        ['O Poder do Hábito', 'Charles Duhigg', 2012, 408, 'Autoajuda', 'Como os hábitos funcionam e como mudá-los.'],
        ['Hábitos Atômicos', 'James Clear', 2018, 320, 'Autoajuda', 'Pequenas mudanças que geram grandes resultados.'],
        ['Como Fazer Amigos e Influenciar Pessoas', 'Dale Carnegie', 1936, 256, 'Autoajuda', 'Dicas clássicas para se relacionar melhor com as pessoas.'],
        ['Mindset', 'Carol S. Dweck', 2006, 312, 'Autoajuda', 'A diferença entre a mentalidade fixa e a de crescimento.'],

        // Tecnologia
        ['Arquitetura Limpa', 'Robert C. Martin', 2017, 432, 'Tecnologia', 'Como organizar um sistema para ele ser fácil de manter.'],
        ['Refatoração', 'Martin Fowler', 1999, 456, 'Tecnologia', 'Técnicas para melhorar o código sem mudar o que ele faz.'],
        ['Entendendo Algoritmos', 'Aditya Bhargava', 2016, 264, 'Tecnologia', 'Algoritmos explicados de forma simples e ilustrada.'],
    ];

    // Editoras usadas nos exemplos (sorteadas).
    private array $editoras = ['Companhia das Letras', 'Penguin', 'Rocco', 'Intrínseca', 'Martin Claret', 'Record', 'HarperCollins', 'Novatec', 'Alta Books', 'Suma'];

    // Formatos possíveis (sorteados).
    private array $formatos = ['Capa comum', 'Capa dura', 'E-book'];

    public function up(): void
    {
        // Quantos livros faltam para chegar na meta.
        $faltam = $this->meta - DB::table('livros')->count();

        // Títulos que já existem, em minúsculas, para não cadastrar repetido.
        $jaExistem = DB::table('livros')->pluck('titulo')->map(fn ($t) => mb_strtolower($t))->all();

        foreach ($this->livros as [$titulo, $autor, $ano, $paginas, $genero, $sinopse]) {
            // Já chegou na meta? Para aqui.
            if ($faltam <= 0) {
                break;
            }

            // Pula se o livro já estiver cadastrado.
            if (in_array(mb_strtolower($titulo), $jaExistem, true)) {
                continue;
            }

            $agora = now();

            DB::table('livros')->insert([
                'titulo' => $titulo,
                'subtitulo' => null,
                'autor' => $autor,
                'editora' => $this->editoras[array_rand($this->editoras)],
                'isbn' => $this->gerarIsbn(),
                'ano_publicacao' => $ano,
                'edicao' => random_int(1, 10),
                'numero_paginas' => $paginas,
                'idioma' => 'Português',
                'genero' => $genero,
                'formato' => $this->formatos[array_rand($this->formatos)],
                'preco' => random_int(1990, 19990) / 100,     // De R$ 19,90 a R$ 199,90.
                'quantidade_estoque' => random_int(0, 50),
                'sinopse' => $sinopse,
                'ativo' => random_int(1, 100) <= 85,           // 85% ativos.
                'created_at' => $agora,
                'updated_at' => $agora,
            ]);

            $faltam--;
        }
    }

    // down(): não remove nada, porque os livros podem ter sido editados depois.
    public function down(): void
    {
        //
    }

    // Gera um ISBN de 13 dígitos válido (com o dígito verificador certo) que ainda não existe no banco.
    private function gerarIsbn(): string
    {
        do {
            // Começa com 978 e mais 9 números sorteados.
            $numeros = '978';
            for ($i = 0; $i < 9; $i++) {
                $numeros .= random_int(0, 9);
            }

            // Calcula o último dígito (verificador): pesos 1 e 3 alternados.
            $soma = 0;
            for ($i = 0; $i < 12; $i++) {
                $soma += (int) $numeros[$i] * ($i % 2 === 0 ? 1 : 3);
            }
            $isbn = $numeros.((10 - $soma % 10) % 10);
        } while (DB::table('livros')->where('isbn', $isbn)->exists());

        return $isbn;
    }
};
