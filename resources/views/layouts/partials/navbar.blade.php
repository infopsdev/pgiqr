<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
    <div class="container">

        <a class="navbar-brand fw-bold text-uppercase tracking-wider" href="{{ url('/dashboard') }}">
            <i class="fa-solid fa-qrcode text-danger me-2"></i> PGIQR
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="fa-solid fa-chart-pie me-1"></i> Dashboard</a>
                </li>

                {{-- Bloque protegido: Solo visible si el usuario inició sesión --}}
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="qrDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-qrcode me-1"></i> Generadores QR
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">

                            {{-- MÓDULO COMPARTIDO: Lo ve tanto Enseñanza como Informática/Administrador --}}
                            @if(Auth::user()->can('access-full-ti') || Auth::user()->can('access-ensenanza'))
                                <li>
                                    <a class="dropdown-item text-primary fw-bold" href="{{ route('tools.qr') }}">
                                        <i class="fa-solid fa-sliders me-2"></i> Enlace Formulario / URL
                                    </a>
                                </li>
                            @endif

                            {{-- SECCIÓN EXCLUSIVA DE INFRAESTRUCTURA: Oculta por completo para Enseñanza --}}
                            @can('access-full-ti')
                                <li><hr class="dropdown-divider border-secondary"></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-wifi me-2"></i> Conectividad Wi-Fi</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-video me-2"></i> Zoom</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-location-dot me-2"></i> Ubicación</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-calendar-days me-2"></i> Evento</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-id-card me-2"></i> Tarjeta V-Card</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-comment-sms me-2"></i> Mensaje SMS</a></li>
                            @endcan

                        </ul>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm px-3 me-2" href="{{ route('login') }}">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Acceder
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-circle-user text-danger me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li>
                                <div class="dropdown-header text-gray-400 small text-uppercase fw-bold border-bottom border-secondary pb-1 mb-1">
                                    Rol: {{ Auth::user()->role_slug }}
                                </div>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-sliders me-2"></i> Mi Perfil</a></li>
                            <li><hr class="dropdown-divider dropdown-divider-light"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="fa-solid fa-power-off me-2"></i> Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
