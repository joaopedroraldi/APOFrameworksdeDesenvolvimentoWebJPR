{{-- Menu de navegação do topo. --}}
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">

        <div class="navbar-header">
            {{-- Botão "sanduíche" que aparece no celular para abrir o menu. --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false">
                <span class="sr-only">Abrir menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{-- Nome do sistema. Clicando, volta para o início. --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-book"></i> {{ config('app.name') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="menu-principal">

            {{-- @auth: este pedaço só aparece para quem está logado. --}}
            @auth
                {{-- Links do sistema. O "active" deixa marcado o link da página atual. --}}
                <ul class="nav navbar-nav">
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Início</a>
                    </li>
                    <li class="{{ request()->is('livros*') ? 'active' : '' }}">
                        <a href="{{ url('/livros') }}"><i class="fa fa-book"></i> Livros</a>
                    </li>
                    <li class="{{ request()->is('clientes*') ? 'active' : '' }}">
                        <a href="{{ url('/clientes') }}"><i class="fa fa-users"></i> Clientes</a>
                    </li>
                </ul>

                {{-- Lado direito: nome do usuário com o botão de sair. --}}
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle"></i> {{ auth()->user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                {{-- Sair é um formulário POST, por segurança. --}}
                                <form method="POST" action="{{ route('sair') }}" class="form-sair">
                                    @csrf
                                    <button type="submit" class="btn btn-link"><i class="fa fa-sign-out"></i> Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth

            {{-- @guest: este pedaço só aparece para quem NÃO está logado. --}}
            @guest
                <ul class="nav navbar-nav navbar-right">
                    <li class="{{ request()->is('login') ? 'active' : '' }}">
                        <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Entrar</a>
                    </li>
                    <li class="{{ request()->is('cadastro') ? 'active' : '' }}">
                        <a href="{{ route('cadastro') }}"><i class="fa fa-user-plus"></i> Cadastrar</a>
                    </li>
                </ul>
            @endguest

        </div>
    </div>
</nav>
