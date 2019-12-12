<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ url("assets/images/logo.png") }}" alt="SoftPro" class="logo"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart') }}">
                    Meu Carrinho
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge badge-pill badge-info">
                        @if( Session::has('cart'))
                            {{ Session::get('cart')->totalItems() }}
                        @else
                            0
                        @endif
                    </span>
                </a>
            </li>

            @if(auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">Perfil</a>
                        <a class="dropdown-item" href=" {{ route('user.password') }}">Alterar Senha</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('user.logout') }}">Sair</a>
                    </div>
                </li>

            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>

            @endif
        </ul>
    </div>
</nav>
