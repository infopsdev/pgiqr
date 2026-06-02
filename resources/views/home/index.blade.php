@extends('layouts.app')

@section('title', 'PGIQR – Plataforma de Gestión de Identidad y Operaciones QR')

@section('content')
    <div class="container my-5 fade-up">
        <div class="row align-items-center justify-content-center g-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">
                    Gestión de Identidad y Operaciones QR
                </h1>
                <p class="lead text-muted fs-5">
                    Plataforma tecnológica del Departamento de Informática diseñada para la automatización, emisión y control centralizado de credenciales y registros operativos institucionales mediante códigos QR de alta seguridad.
                </p>
                <div class="d-flex justify-content-center justify-content-lg-start gap-3 mt-4">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-md-2">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Ingresar al Sistema
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 me-md-2">
                            <i class="fa-solid fa-chart-pie me-2"></i>Ir al Panel de Control
                        </a>
                    @endauth
                </div>
            </div>

            <div class="col-10 col-sm-8 col-lg-5 mx-auto">
                <div class="card mlf-feature-card text-center p-5 shadow-lg border-0">
                    <div class="mb-4">
                        <i class="fa-solid fa-qrcode text-primary" style="font-size: 6rem; filter: drop-shadow(0 0 12px rgba(124, 58, 237, 0.2));"></i>
                    </div>
                    <h3 class="fw-bold text-dark">Acceso Restringido</h3>
                    <p class="text-muted small mb-0">Requiere credenciales válidas asignadas por el administrador de TI.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col">
                <div class="card h-100 p-4 border-0 shadow-sm hover-lift">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-white bg-primary bg-gradient rounded-3 fs-4 mb-3" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                    <h4 class="fw-bold">Identidad Digital</h4>
                    <p class="text-muted small">Generación y enrolamiento de perfiles institucionales vinculados a códigos QR dinámicos únicos.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4 border-0 shadow-sm hover-lift">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-white bg-primary bg-gradient rounded-3 fs-4 mb-3" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="fw-bold">Control y Seguridad</h4>
                    <p class="text-muted small">Validación en tiempo real de operaciones internas minimizando riesgos de suplantación física.</p>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4 border-0 shadow-sm hover-lift">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-white bg-primary bg-gradient rounded-3 fs-4 mb-3" style="width: 48px; height: 48px;">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h4 class="fw-bold">Optimización Operativa</h4>
                    <p class="text-muted small">Métricas y bitácoras automáticas de asistencia y uso de recursos del departamento.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
