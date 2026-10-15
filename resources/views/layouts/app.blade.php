{{-- Layout principal. Todas as páginas do sistema usam este "molde". --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Token de segurança que o Laravel exige nos formulários. --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Título da aba. Cada página pode mudar a primeira parte. --}}
    <title>@yield('titulo', 'Início') | {{ config('app.name') }}</title>

    {{-- Ícone que aparece na aba do navegador (favicon) e na tela inicial do celular. --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ time() }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('favicon-32.png') }}?v={{ time() }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v={{ time() }}">

    {{-- Bootstrap 3.4.1: deixa a tela bonita sem precisar criar CSS do zero. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

    {{-- Font Awesome 4.7: os ícones. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    {{-- DataTables: a tabela com busca, ordem e páginas. --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs@1.13.8/css/dataTables.bootstrap.min.css">

    {{-- Nosso CSS, com os ajustes do sistema. --}}
    {{-- O "?v=" com a hora atual faz o navegador e o Cloudflare sempre baixarem a versão mais nova. --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">

    {{-- Espaço para uma página colocar um CSS só dela. --}}
    @stack('css')
</head>
<body>

    {{-- Menu do topo. --}}
    @include('partials.menu')

    {{-- Conteúdo da página. --}}
    <main class="container conteudo">
        @yield('conteudo')
    </main>

    {{-- Rodapé. --}}
    @include('partials.rodape')

    {{-- jQuery: o Bootstrap 3 e o DataTables precisam dele. --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    {{-- JavaScript do Bootstrap (abre menus, por exemplo). --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

    {{-- DataTables e o visual dele no estilo do Bootstrap 3. --}}
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs@1.13.8/js/dataTables.bootstrap.min.js"></script>

    {{-- jQuery Mask: coloca pontos e traços sozinho no CPF, telefone e CEP. --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>

    {{-- SweetAlert2: as janelinhas bonitas de aviso. --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>

    {{-- Nosso JavaScript, com as funções do sistema. O "?v=" funciona igual ao do CSS. --}}
    <script src="{{ asset('js/app.js') }}?v={{ time() }}"></script>

    {{-- Mostra os avisos de sucesso ou erro, se tiver algum. --}}
    @include('partials.alertas')

    {{-- Espaço para uma página colocar um JavaScript só dela. --}}
    @stack('scripts')
</body>
</html>
