@extends('layouts.app')

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
                        <h1 class="h3 fw-bold text-gray-800 mb-1">Generador de Códigos QR</h1>
                        <p class="text-muted mb-0 small">
                            Módulo de generación dinámica en tiempo real para control de identidad, capacitación y operaciones de TI.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-gray-200 my-4">

        <div class="row g-4">

            {{-- COLUMNA I: CONFIGURACIÓN DE DATOS --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold text-gray-700 mb-3">
                            <i class="fa-solid fa-link me-2 text-primary"></i>1. Enlace del Formulario / URL
                        </h5>

                        <div class="p-3 border rounded-3 bg-light mb-3">
                            <label for="qr_url" class="form-label fw-semibold small text-gray-600">Dirección URL del Curso o Registro</label>
                            <input type="url" class="form-control form-control-lg" id="qr_url" placeholder="Pegue la URL del formulario de Google aquí..." value="">
                            <span class="text-muted small mt-2 d-block">
                                <i class="fa-solid fa-circle-info me-1 text-info"></i>
                                Ingrese la URL de la convocatoria actual (ej. Curso RCP Adulto). El código se actualizará al instante.
                            </span>
                        </div>
                    </div>

                    <div class="bg-light p-3 border rounded-3 mt-3">
                        <h6 class="fw-bold text-gray-700 mb-2 small"><i class="fa-solid fa-shield-halved me-1 text-success"></i> Estándar Técnico de Impresión:</h6>
                        <ul class="mb-0 small text-muted ps-3">
                            <li>Dimensión fija de **300px** para evitar pixelado en hojas físicas.</li>
                            <li>Color sólido negro corporativo para garantizar alto contraste de lectura.</li>
                            <li>Matriz con Logotipo Central Institucional del HMZ integrado de forma nativa.</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- COLUMNA II: PREVISUALIZACIÓN Y DESCARGA --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white text-center h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="h5 fw-bold text-gray-700 text-start border-bottom pb-2 mb-4">
                            <i class="fa-solid fa-eye me-2 text-success"></i>Previsualización Dinámica
                        </h2>

                        {{-- CONTENEDOR FÍSICO DEL QR CON EL LOGO SUPERPUESTO --}}
                        <div class="mx-auto my-4 p-3 border border-dashed border-gray-300 rounded-3 bg-light d-flex align-items-center justify-content-center shadow-inner position-relative"
                             id="qr_canvas_wrapper"
                             style="width: 340px; height: 340px; min-height: 340px;">

                            {{-- Contenedor del Isotipo HMZ centrado por CSS --}}
                            <div id="qr_logo_overlay" class="position-absolute bg-white p-1 rounded-3 shadow-sm d-none"
                                 style="z-index: 10; width: 55px; height: 55px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                {{-- Usamos CSS object-fit para recortar y mostrar únicamente el emblema guinda izquierdo de la imagen --}}
                                <img src="{{ asset('assets/img/logo-hmz-qr.png') }}" alt="Logo HMZ"
                                     style="width: 140px; height: auto; max-width: none; object-fit: cover; object-position: left center; margin-left: 2px;">
                            </div>

                            {{-- Marcador temporal si no hay datos --}}
                            <div id="qr_placeholder" class="text-center">
                                <i class="fa-solid fa-qrcode text-gray-300 mb-2" style="font-size: 5rem;"></i>
                                <p class="text-muted small mb-0">Esperando URL del Formulario...</p>
                            </div>
                        </div>
                    </div>

                    {{-- BOTÓN DE DESCARGA --}}
                    <div class="mt-2">
                        <button id="btn_download_qr" class="btn btn-danger btn-lg w-100 fw-bold py-2 shadow-sm" disabled>
                            <i class="fa-solid fa-download me-2"></i>Descargar QR Oficial (PNG)
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    {{-- Dependencia de Infraestructura Local --}}
    <script src="{{ asset('assets/js/qrcode.min.js') }}"></script>

    <script>
        const CACHE_BUSTER = "?v=" + Date.now();
        const LOGO_ASSET_URL = "{{ asset('assets/img/logo-ti-qr.png') }}" + CACHE_BUSTER;

        document.addEventListener('DOMContentLoaded', function () {
            const urlInput = document.getElementById('qr_url');
            const canvasWrapper = document.getElementById('qr_canvas_wrapper');
            const btnDownload = document.getElementById('btn_download_qr');
            const placeholder = document.getElementById('qr_placeholder');
            const overlay = document.getElementById('qr_logo_overlay');
            const overlayImg = overlay.querySelector('img');

            // 1. Forzar un círculo perfecto en la previsualización web (CSS)
            if (overlay) {
                overlay.style.borderRadius = "50%";
                overlay.style.width = "52px";
                overlay.style.height = "52px";
                overlay.style.padding = "0px";
                overlay.style.border = "3px solid #ffffff"; // Anillo blanco protector elegante
                overlay.style.backgroundColor = "#ffffff";
                overlay.style.boxShadow = "0 2px 5px rgba(0,0,0,0.2)";
            }
            if (overlayImg) {
                overlayImg.src = LOGO_ASSET_URL;
                overlayImg.style.width = "100%";
                overlayImg.style.height = "100%";
                overlayImg.style.borderRadius = "50%";
                overlayImg.style.objectFit = "cover"; // Asegura que llene el círculo sin deformarse
            }

            function generateQR() {
                const urlValue = urlInput.value.trim();

                if (!urlValue) {
                    canvasWrapper.innerHTML = '';
                    canvasWrapper.appendChild(overlay);
                    canvasWrapper.appendChild(placeholder);
                    overlay.classList.add('d-none');
                    btnDownload.disabled = true;
                    return;
                }

                if(placeholder) placeholder.remove();
                canvasWrapper.innerHTML = '';
                canvasWrapper.appendChild(overlay);
                overlay.classList.remove('d-none');

                try {
                    // Mantenemos Nivel H para soportar la obstrucción del círculo sin perder legibilidad
                    new QRCode(canvasWrapper, {
                        text: urlValue,
                        width: 300,
                        height: 300,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });

                    btnDownload.disabled = false;
                } catch (e) {
                    console.error("Error al codificar la matriz QR:", e);
                }
            }

            urlInput.addEventListener('input', generateQR);

            // 2. Motor de Fusión del Canvas para la descarga física (Círculo Perfecto)
            btnDownload.addEventListener('click', function () {
                const qrCanvas = canvasWrapper.querySelector('canvas');
                if (qrCanvas) {
                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = qrCanvas.width;
                    tempCanvas.height = qrCanvas.height;
                    const ctx = tempCanvas.getContext('2d');

                    // A. Estampar la matriz QR base
                    ctx.drawImage(qrCanvas, 0, 0);

                    // Parámetros del centro geométrico
                    const centerX = qrCanvas.width / 2;
                    const centerY = qrCanvas.height / 2;
                    const outerRadius = 26; // Radio del fondo blanco protector
                    const logoRadius = 23;  // Radio del área de la imagen

                    // B. Dibujar la "isla" protectora blanca de fondo (Círculo Perfecto)
                    ctx.fillStyle = "#ffffff";
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, outerRadius, 0, 2 * Math.PI);
                    ctx.fill();

                    // C. Cargar el logo y aplicar la máscara de recorte circular transparente
                    const img = new Image();
                    img.src = LOGO_ASSET_URL;
                    img.crossOrigin = "anonymous";

                    img.onload = function () {
                        ctx.save(); // Salvar el estado del lienzo sin recorte

                        // Crear la ruta circular para el recorte del logo
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, logoRadius, 0, 2 * Math.PI);
                        ctx.clip(); // ✂️ Todo lo que se dibuje a partir de aquí quedará dentro de este círculo

                        // Dibujar el logo centrado
                        const logoSize = logoRadius * 2;
                        ctx.drawImage(img, centerX - logoRadius, centerY - logoRadius, logoSize, logoSize);

                        ctx.restore(); // Restaurar el lienzo para remover la máscara de recorte

                        // D. Disparar la descarga del PNG consolidado
                        const downloadLink = document.createElement('a');
                        downloadLink.href = tempCanvas.toDataURL("image/png");
                        downloadLink.download = `QR_Institucional_Circular_${Date.now()}.png`;
                        downloadLink.click();
                    };
                }
            });
        });
    </script>
@endpush
