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

        {{-- Contenedor Grid Balanceado --}}
        <div class="row g-4">

            {{-- COLUMNA I: PANEL MODULAR DE CONFIGURACIÓN --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">

                        {{-- ENLACE PRINCIPAL --}}
                        <div class="mb-4">
                            <label for="qr_url" class="form-label fw-bold text-secondary">
                                <i class="fas fa-link me-2 text-primary"></i>1. Enlace del Formulario / URL
                            </label>
                            <input type="url" id="qr_url" class="form-control form-control-lg"
                                   placeholder="Pegue la URL del formulario de la convocatoria actual..." value="">
                            <small class="text-muted"><i class="fas fa-info-circle me-1 mt-2"></i> El código QR se actualizará dinámicamente al escribir o cambiar opciones.</small>
                        </div>

                        <hr class="text-muted my-4">

                        {{-- ACORDEÓN DE ESTILOS --}}
                        <h5 class="fw-bold text-dark mb-3"><i class="fas fa-sliders-h me-2 text-success"></i>2. Configuración y Estilo Avanzado</h5>

                        <div class="accordion shadow-sm" id="accordionPersonalizacion">

                            {{-- MÓDULO DE GEOMETRÍA --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFormas">
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFormas" aria-expanded="true" aria-controls="collapseFormas">
                                        <i class="fas fa-shapes me-2 text-primary"></i> Formas del QR
                                    </button>
                                </h2>
                                <div id="collapseFormas" class="accordion-collapse collapse show" aria-labelledby="headingFormas" data-bs-parent="#accordionPersonalizacion">
                                    <div class="accordion-body bg-light-50">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="shape_dots" class="form-label small fw-bold text-muted">Puntos (Módulos)</label>
                                                <select id="shape_dots" class="form-select">
                                                    <option value="square" selected>Cuadrado (Estándar)</option>
                                                    <option value="dots">Puntos</option>
                                                    <option value="rounded">Líquido / Orgánico</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="shape_corners_ext" class="form-label small fw-bold text-muted">Esquinas (Externas)</label>
                                                <select id="shape_corners_ext" class="form-select">
                                                    <option value="square" selected>Cuadrado</option>
                                                    <option value="extra-rounded">Redondeado</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="shape_corners_int" class="form-label small fw-bold text-muted">Esquinas (Internas)</label>
                                                <select id="shape_corners_int" class="form-select">
                                                    <option value="square" selected>Cuadrado</option>
                                                    <option value="dot">Redondeado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- MÓDULO DE CARGA DE LOGO --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingLogo">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLogo" aria-expanded="false" aria-controls="collapseLogo">
                                        <i class="fas fa-image me-2 text-danger"></i> Logotipo Distintivo
                                    </button>
                                </h2>
                                <div id="collapseLogo" class="accordion-collapse collapse" aria-labelledby="headingLogo" data-bs-parent="#accordionPersonalizacion">
                                    <div class="accordion-body bg-light-50">
                                        <div class="mb-3">
                                            <label for="input_logo_file" class="form-label small fw-bold text-muted">Subir imagen corporativa (.png, .jpg)</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="input_logo_file" accept="image/*">
                                            </div>
                                            <div class="form-text text-muted mt-2">
                                                <i class="fas fa-magic me-1"></i> El sistema aplicará el aislamiento circular transparente automáticamente.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> {{-- Fin Acordeón --}}
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

                        <div class="mx-auto my-4 p-3 border border-dashed border-gray-300 rounded-3 bg-light d-flex align-items-center justify-content-center shadow-inner position-relative"
                             id="qr_canvas_wrapper"
                             style="width: 340px; height: 340px; min-height: 340px;">

                            {{-- FUSIÓN: Reincorporamos el Overlay HTML para garantizar la estética perfecta en la vista previa --}}
                            <div id="qr_logo_overlay" class="position-absolute d-none"
                                 style="z-index: 10; width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 50%; border: 3px solid #ffffff; background-color: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                <img src="" alt="Logo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            </div>

                            {{-- Marcador temporal --}}
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

        </div> {{-- Fin Row --}}
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>

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
            const inputLogoFile = document.getElementById('input_logo_file');

            const shapeDots = document.getElementById('shape_dots');
            const shapeCornersExt = document.getElementById('shape_corners_ext');
            const shapeCornersInt = document.getElementById('shape_corners_int');

            let LOGO_DINA_DATA = LOGO_ASSET_URL;
            let qrCodeEngine = null;

            if (overlayImg) {
                overlayImg.src = LOGO_ASSET_URL;
            }

            function initQREngine(textData) {
                return new QRCodeStyling({
                    width: 300,
                    height: 300,
                    type: "canvas",
                    data: textData,
                    qrOptions: {
                        typeNumber: "0",
                        mode: "Byte",
                        errorCorrectionLevel: "H"
                    },
                    dotsOptions: {
                        color: "#000000",
                        type: shapeDots.value
                    },
                    backgroundOptions: {
                        color: "#ffffff",
                    },
                    imageOptions: {
                        // Explicación: No pasamos la imagen aquí para la vista previa,
                        // dejando que el overlay HTML renderice de forma impecable y veloz.
                        // Sin embargo, dejamos activo el espacio en blanco intermedio (clear)
                        hideBackgroundDots: true,
                        imageSize: 0.18,
                        margin: 0
                    },
                    cornersSquareOptions: {
                        color: "#000000",
                        type: shapeCornersExt.value
                    },
                    cornersDotOptions: {
                        color: "#000000",
                        type: shapeCornersInt.value
                    }
                });
            }

            function generateQR() {
                const urlValue = urlInput.value.trim();

                if (!urlValue) {
                    canvasWrapper.innerHTML = '';
                    canvasWrapper.appendChild(overlay);
                    if (placeholder) canvasWrapper.appendChild(placeholder);
                    overlay.classList.add('d-none');
                    btnDownload.disabled = true;
                    return;
                }

                if (placeholder) placeholder.remove();
                canvasWrapper.innerHTML = '';
                canvasWrapper.appendChild(overlay);
                overlay.classList.remove('d-none');

                qrCodeEngine = initQREngine(urlValue);

                // Forzar un búfer transparente invisible para que la librería limpie el centro
                // de los módulos QR sin pintar el logo horrendo directamente en la previsualización.
                qrCodeEngine.update({
                    image: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'></svg>"
                });

                qrCodeEngine.append(canvasWrapper);
                btnDownload.disabled = false;
            }

            if (inputLogoFile) {
                inputLogoFile.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            LOGO_DINA_DATA = event.target.result;
                            if (overlayImg) overlayImg.src = LOGO_DINA_DATA;
                            generateQR();
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            urlInput.addEventListener('input', generateQR);
            shapeDots.addEventListener('change', generateQR);
            shapeCornersExt.addEventListener('change', generateQR);
            shapeCornersInt.addEventListener('change', generateQR);

            // FUSIÓN DEL MOTOR DE DESCARGA (Renderizado forzado del círculo perfecto)
            btnDownload.addEventListener('click', function () {
                const qrCanvas = canvasWrapper.querySelector('canvas');
                if (qrCanvas) {
                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = qrCanvas.width;
                    tempCanvas.height = qrCanvas.height;
                    const ctx = tempCanvas.getContext('2d');

                    // 1. Dibujar la matriz geométrica del QR limpia
                    ctx.drawImage(qrCanvas, 0, 0);

                    // 2. Pintar el escudo contenedor blanco (Estilo Starbucks/WhatsApp) en el Canvas de salida
                    const centerX = qrCanvas.width / 2;
                    const centerY = qrCanvas.height / 2;
                    const outerRadius = 28; // Cobertura total del área despejada
                    const logoRadius = 25;  // Radio del Isotipo recortado

                    ctx.fillStyle = "#ffffff";
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, outerRadius, 0, 2 * Math.PI);
                    ctx.fill();

                    // 3. Procesar y recortar el logo en un círculo perfecto dentro del archivo descargable
                    const downloadImg = new Image();
                    downloadImg.src = LOGO_DINA_DATA;
                    downloadImg.crossOrigin = "anonymous";

                    downloadImg.onload = function () {
                        ctx.save();
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, logoRadius, 0, 2 * Math.PI);
                        ctx.clip(); // Aplicar máscara esférica matemática

                        const logoSize = logoRadius * 2;
                        // Dibujar la imagen centrada y escalada proporcionalmente
                        ctx.drawImage(downloadImg, centerX - logoRadius, centerY - logoRadius, logoSize, logoSize);
                        ctx.restore();

                        // 4. Ejecutar la descarga del binario final procesado
                        const downloadLink = document.createElement('a');
                        downloadLink.href = tempCanvas.toDataURL("image/png");
                        downloadLink.download = `QR_Estilizado_HMZ_${Date.now()}.png`;
                        downloadLink.click();
                    };
                }
            });

            if (urlInput.value.trim()) {
                generateQR();
            }
        });
    </script>
@endpush
