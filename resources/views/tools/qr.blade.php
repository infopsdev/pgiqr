@extends('layouts.app')

{{-- SECCIÓN DE SEO Y METADATOS COMPLEMENTARIOS --}}
@section('title', 'Generador de Códigos QR Institucionales - PGIQR')

@section('content')
    <div class="container-fluid px-4 fade-up">

        {{-- ENCABEZADO DE LA HERRAMIENTA --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-danger bg-gradient text-white rounded-3 shadow-sm">
                        <i class="fa-solid fa-qrcode fs-3"></i>
                    </div>
                    <div>
                        <h1 class="h3 fw-bold text-gray-800 mb-1">Generadores de QR</h1>
                        <p class="text-muted mb-0 sm:text-sm">
                            Módulo tecnológico de creación de códigos QR estáticos y dinámicos para operaciones del Departamento de Informática.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-gray-200 my-4">

        {{-- CONTENEDOR PRINCIPAL TRABAJO (DIVIDIDO EN DOS COLUMNAS DE CONTROL) --}}
        <div class="row g-4">

            {{-- COLUMNA I: CONFIGURACIÓN Y PARÁMETROS DEL QR --}}
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm border border-gray-100">
                    <h2 class="h5 fw-bold text-gray-700 mb-3 border-bottom pb-2">
                        <i class="fa-solid fa-sliders me-2 text-primary"></i>Configuración del Código
                    </h2>

                    <div class="alert alert-info text-xs py-3 mb-0" role="alert">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        <strong>Estructura lista:</strong> Aquí se implementará el formulario interactivo para capturar la URL, texto o credencial QR de acuerdo a la elección.
                    </div>
                </div>
            </div>

            {{-- COLUMNA II: PREVISUALIZACIÓN Y DESCARGA --}}
            <div class="col-lg-6">
                <div class="bg-white p-4 rounded-3 shadow-sm border border-gray-100 text-center">
                    <h2 class="h5 fw-bold text-gray-700 mb-3 text-start border-bottom pb-2">
                        <i class="fa-solid fa-eye me-2 text-success"></i>Previsualización
                    </h2>

                    <div class="py-5 my-3 border border-dashed border-gray-300 rounded-3 bg-light d-flex flex-column align-items-center justify-content-center" style="min-height: 250px;">
                        <i class="fa-solid fa-qrcode text-gray-300 mb-2" style="font-size: 5rem;"></i>
                        <span class="text-muted small">El código QR generado aparecerá en esta zona</span>
                    </div>

                    <button class="btn btn-secondary btn-sm w-100" disabled>
                        <i class="fa-solid fa-download me-2"></i>Descargar Archivo QR
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
