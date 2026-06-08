@extends('layouts.app')

@section('title', 'Generador de Códigos QR Institucionales - PGIQR')

{{-- SECCIÓN DE ESTILOS MODULARES --}}
@push('styles')
    <style>
        .input-url-personalizado {
            padding: 0.75rem 1rem;
            font-size: 1.05rem; /* Tamaño cómodo y legible para la URL real */
            border-radius: 0.5rem;
        }

        /* Ajuste de escala exclusivo y elegante para el placeholder */
        .input-url-personalizado::placeholder {
            font-size: 0.88rem; /* Más pequeño, tipo texto secundario/muted */
            letter-spacing: 0.3px;
            opacity: 0.75;
        }
    </style>
@endpush

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

                        {{-- SECCIÓN CONTENEDORA DE PASO 1 --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary mb-3">
                                <i class="fas fa-sliders-h me-2 text-primary"></i>1. Seleccione el Tipo de Contenido
                            </label>

                            {{-- PESTAÑAS CON ICONOS (NAV TABS CONDICIONALES) --}}
                            <ul class="nav nav-tabs mb-4 border-bottom border-gray-200" id="qrTabs" role="tablist">
                                {{-- Pestaña Enlace: Visible para TODOS --}}
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-bold" id="tab-link-btn" data-bs-toggle="tab" data-bs-target="#panel-link" type="button" role="tab" data-type="link">
                                        <i class="fa-solid fa-link me-1 text-primary"></i> Enlace
                                    </button>
                                </li>

                                {{-- Pestañas Avanzadas: EXCLUSIVAS para TI / Administrador --}}
                                @can('access-full-ti')
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-bold" id="tab-location-btn" data-bs-toggle="tab" data-bs-target="#panel-location" type="button" role="tab" data-type="location">
                                            <i class="fa-solid fa-location-dot me-1 text-danger"></i> Ubicación
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-bold" id="tab-zoom-btn" data-bs-toggle="tab" data-bs-target="#panel-zoom" type="button" role="tab" data-type="zoom">
                                            <i class="fa-solid fa-video me-1 text-info"></i> Zoom
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-bold" id="tab-wifi-btn" data-bs-toggle="tab" data-bs-target="#panel-wifi" type="button" role="tab" data-type="wifi">
                                            <i class="fa-solid fa-wifi me-1 text-warning"></i> WiFi
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link text-muted" disabled><i class="fa-solid fa-id-card me-1"></i> V-card</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link text-muted" disabled><i class="fa-solid fa-calendar-days me-1"></i> Evento</button>
                                    </li>
                                @endcan
                            </ul>

                            {{-- CONTENIDO DINÁMICO DE LAS PESTAÑAS --}}
                            <div class="tab-content bg-light p-3 border rounded shadow-sm mb-3" id="qrTabsContent">

                                {{-- FORMULARIO I: ENLACE / URL (Compartido) --}}
                                <div class="tab-pane fade show active" id="panel-link" role="tabpanel" aria-labelledby="tab-link-btn">
                                    <div class="mb-2">
                                        <label for="qr_url" class="form-label small fw-bold text-secondary">Enlace del Formulario / URL</label>
                                        <input type="url" id="qr_url" class="form-control input-url-personalizado bg-white"
                                               placeholder="Pegue la URL del formulario de la convocatoria actual (https://forms.gle/...)" value="">
                                    </div>
                                </div>

                                {{-- FORMULARIO II: UBICACIÓN (Exclusivo TI / Administrador) --}}
                                @can('access-full-ti')
                                    <div class="tab-pane fade" id="panel-location" role="tabpanel" aria-labelledby="tab-location-btn">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="qr_geo_address" class="form-label small fw-bold text-secondary">Sede / Dirección Descriptiva</label>
                                                <input type="text" id="qr_geo_address" class="form-control bg-white" placeholder="Ej. Aula Magna - Planta Alta HMZ">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="qr_geo_lat" class="form-label small fw-bold text-muted">Latitud</label>
                                                <input type="text" id="qr_geo_lat" class="form-control bg-white" placeholder="Ej. 22.7709">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="qr_geo_lng" class="form-label small fw-bold text-muted">Longitud</label>
                                                <input type="text" id="qr_geo_lng" class="form-control bg-white" placeholder="Ej. -102.5832">
                                            </div>
                                        </div>
                                        <p class="mt-2 small text-muted mb-0">
                                            <i class="fa-solid fa-info-circle text-danger me-1"></i> Al escanear, el smartphone abrirá la ubicación de forma nativa en Google Maps.
                                        </p>
                                    </div>
                                @endcan

                                {{-- FORMULARIO III: SESIONES ZOOM (Exclusivo TI / Administrador) --}}
                                @can('access-full-ti')
                                    <div class="tab-pane fade" id="panel-zoom" role="tabpanel" aria-labelledby="tab-zoom-btn">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="qr_zoom_id" class="form-label small fw-bold text-secondary">ID de la Reunión *</label>
                                                <input type="text" id="qr_zoom_id" class="form-control bg-white" placeholder="Ej. 985 1774 4535">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="qr_zoom_pwd" class="form-label small fw-bold text-secondary">Código de Acceso / Password *</label>
                                                <input type="text" id="qr_zoom_pwd" class="form-control bg-white" placeholder="Ej. abc123">
                                            </div>
                                            <div class="col-12">
                                                <label for="qr_zoom_topic" class="form-label small fw-bold text-muted">Tema de la Videoconferencia (Opcional)</label>
                                                <input type="text" id="qr_zoom_topic" class="form-control bg-white" placeholder="Ej. Capacitación SIGHO Consulta Externa">
                                            </div>
                                        </div>
                                        <p class="mt-2 small text-muted mb-0">
                                            <i class="fa-solid fa-circle-info text-info me-1"></i> El QR empaquetará las credenciales de forma segura para saltarse la pantalla de logueo manual de Zoom.
                                        </p>
                                    </div>
                                @endcan

                                {{-- FORMULARIO IV: REDES WIFi (Exclusivo TI / Administrador) --}}
                                @can('access-full-ti')
                                    <div class="tab-pane fade" id="panel-wifi" role="tabpanel" aria-labelledby="tab-wifi-btn">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="qr_wifi_ssid" class="form-label small fw-bold text-secondary">Nombre de la Red (SSID) *</label>
                                                <input type="text" id="qr_wifi_ssid" class="form-control bg-white" placeholder="Ej. HMZ_Medicos_Alta">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="qr_wifi_pwd" class="form-label small fw-bold text-secondary">Contraseña / Password</label>
                                                <input type="text" id="qr_wifi_pwd" class="form-control bg-white" placeholder="Ej. SeguridadHMZ2026">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="qr_wifi_type" class="form-label small fw-bold text-muted">Seguridad (Cifrado)</label>
                                                <select id="qr_wifi_type" class="form-select bg-white">
                                                    <option value="WPA" selected>WPA / WPA2 / WPA3 (Estándar)</option>
                                                    <option value="WEP">WEP (Antiguo)</option>
                                                    <option value="nopass">Sin Contraseña / Abierta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-center pt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="qr_wifi_hidden" value="true">
                                                    <label class="form-check-label small fw-bold text-muted" for="qr_wifi_hidden">¿Es una red oculta?</label>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-2 small text-muted mb-0">
                                            <i class="fa-solid fa-triangle-exclamation text-warning me-1"></i> Respete las mayúsculas y minúsculas exactas configuradas en el Access Point o Firewall Fortigate.
                                        </p>
                                    </div>
                                @endcan

                            </div>
                            <small class="text-muted"><i class="fas fa-info-circle me-1 mt-2"></i> El código QR se actualizará dinámicamente al escribir o cambiar de pestaña.</small>
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
                                                    <option value="extra-rounded">Extra Redondo</option>
                                                    <option value="classy">Elegante</option>
                                                    <option value="classy-rounded">Elegante Redondeado</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="shape_corners_ext" class="form-label small fw-bold text-muted">Esquinas (Externas)</label>
                                                <select id="shape_corners_ext" class="form-select">
                                                    <option value="square" selected>Cuadrado</option>
                                                    <option value="dot">Punto</option>
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

                            {{-- Contenedor del Isotipo Circular --}}
                            <div id="qr_logo_overlay" class="position-absolute d-none"
                                 style="z-index: 10; width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 50%; border: 3px solid #ffffff; background-color: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                <img src="" alt="Logo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            </div>

                            {{-- Marcador temporal --}}
                            <div id="qr_placeholder" class="text-center">
                                <i class="fa-solid fa-qrcode text-gray-300 mb-2" style="font-size: 5rem;"></i>
                                <p class="text-muted small mb-0">Esperando Datos de Configuración...</p>
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
            // Selectores de Enlace
            const urlInput = document.getElementById('qr_url');

            // Selectores de Ubicación (Nuevos)
            const geoLat = document.getElementById('qr_geo_lat');
            const geoLng = document.getElementById('qr_geo_lng');
            const geoAddress = document.getElementById('qr_geo_address');

            // Selectores de Zoom (Nuevos)
            const zoomId = document.getElementById('qr_zoom_id');
            const zoomPwd = document.getElementById('qr_zoom_pwd');
            const zoomTopic = document.getElementById('qr_zoom_topic');

            // Selectores de WiFi (Nuevos)
            const wifiSsid = document.getElementById('qr_wifi_ssid');
            const wifiPwd = document.getElementById('qr_wifi_pwd');
            const wifiType = document.getElementById('qr_wifi_type');
            const wifiHidden = document.getElementById('qr_wifi_hidden');

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

            // Variable de estado para controlar la pestaña activa (Por defecto: link)
            let currentTab = 'link';

            if (overlayImg) {
                overlayImg.src = LOGO_ASSET_URL;
            }

            // Cambiar de modo de procesamiento al dar clic en las pestañas de Bootstrap
            const tabButtons = document.querySelectorAll('#qrTabs button[data-bs-toggle="tab"]');
            tabButtons.forEach(button => {
                button.addEventListener('shown.bs.tab', function (e) {
                    currentTab = e.target.getAttribute('data-type');
                    generateQR(); // Forzar actualización de matriz inmediata al saltar de módulo
                });
            });

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
                let textData = "";

                // PARSEO EN CALIENTE DEPENDIENDO DEL MÓDULO ACTIVO
                if (currentTab === 'link') {
                    textData = urlInput ? urlInput.value.trim() : "";
                }
                else if (currentTab === 'location') {
                    const lat = geoLat ? geoLat.value.trim() : "";
                    const lng = geoLng ? geoLng.value.trim() : "";

                    if (lat && lng) {
                        textData = `geo:${lat},${lng}`;
                    }
                }
                else if (currentTab === 'zoom') {
                    // Eliminar espacios en blanco que el usuario suele meter en el ID de Zoom
                    const idClean = zoomId ? zoomId.value.replace(/\s+/g, '') : "";
                    const pwdClean = zoomPwd ? zoomPwd.value.trim() : "";

                    if (idClean && pwdClean) {
                        // Estructura oficial de Deep Linking de Zoom
                        textData = `https://zoom.us/j/${idClean}?pwd=${pwdClean}`;
                    }
                }
                else if (currentTab === 'wifi') {
                    const ssid = wifiSsid ? wifiSsid.value.trim() : "";
                    const pwd = wifiPwd ? wifiPwd.value.trim() : "";
                    const type = wifiType ? wifiType.value : "WPA";
                    const isHidden = (wifiHidden && wifiHidden.checked) ? "true" : "false";

                    // Regla: Para generar el QR se requiere mínimo el SSID corporativo
                    if (ssid) {
                        // Estándar estricto: Si es abierta (nopass), omitimos el parámetro P o lo mandamos vacío
                        if (type === 'nopass') {
                            textData = `WIFI:S:${ssid};T:nopass;H:${isHidden};;`;
                        } else {
                            textData = `WIFI:S:${ssid};T:${type};P:${pwd};H:${isHidden};;`;
                        }
                    }
                }

                // Si la pestaña actual no tiene datos suficientes, limpiar canvas y restaurar placeholder
                if (!textData) {
                    canvasWrapper.innerHTML = '';
                    canvasWrapper.appendChild(overlay);
                    if (placeholder) {
                        // Actualizar texto dinámico del marcador
                        if (currentTab === 'link') placeholder.querySelector('p').textContent = 'Esperando URL del Formulario...';
                        else if (currentTab === 'location') placeholder.querySelector('p').textContent = 'Esperando Coordenadas...';
                        else if (currentTab === 'zoom') placeholder.querySelector('p').textContent = 'Esperando Credenciales de Zoom...';
                        else if (currentTab === 'wifi') placeholder.querySelector('p').textContent = 'Esperando Nombre de Red (SSID)...';

                        canvasWrapper.appendChild(placeholder);
                    }
                    overlay.classList.add('d-none');
                    btnDownload.disabled = true;
                    return;
                }

                if (placeholder) placeholder.remove();
                canvasWrapper.innerHTML = '';
                canvasWrapper.appendChild(overlay);
                overlay.classList.remove('d-none');

                qrCodeEngine = initQREngine(textData);

                // Forzar búfer transparente para limpiar el centro geométrico
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

            // Listeners reactivos unificados para refresco inmediato
            if (urlInput) urlInput.addEventListener('input', generateQR);
            if (geoLat) geoLat.addEventListener('input', generateQR);
            if (geoLng) geoLng.addEventListener('input', generateQR);
            if (zoomId) zoomId.addEventListener('input', generateQR);

            if (wifiSsid) wifiSsid.addEventListener('input', generateQR);
            if (wifiPwd) wifiPwd.addEventListener('input', generateQR);
            if (wifiType) wifiType.addEventListener('change', generateQR);
            if (wifiHidden) wifiHidden.addEventListener('change', generateQR);

            shapeDots.addEventListener('change', generateQR);
            shapeCornersExt.addEventListener('change', generateQR);
            shapeCornersInt.addEventListener('change', generateQR);

            // MOTOR DE DESCARGA CON MÁSCARA CIRCULAR ESTILO STARBUCKS
            btnDownload.addEventListener('click', function () {
                const qrCanvas = canvasWrapper.querySelector('canvas');
                if (qrCanvas) {
                    const tempCanvas = document.createElement('canvas');
                    tempCanvas.width = qrCanvas.width;
                    tempCanvas.height = qrCanvas.height;
                    const ctx = tempCanvas.getContext('2d');

                    // 1. Clonar la matriz del QR
                    ctx.drawImage(qrCanvas, 0, 0);

                    // 2. Coordenadas y radios para el escudo blanco central
                    const centerX = qrCanvas.width / 2;
                    const centerY = qrCanvas.height / 2;
                    const outerRadius = 28;
                    const logoRadius = 25;

                    ctx.fillStyle = "#ffffff";
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, outerRadius, 0, 2 * Math.PI);
                    ctx.fill();

                    // 3. Recorte circular e inyección del logo
                    const downloadImg = new Image();
                    downloadImg.src = LOGO_DINA_DATA;
                    downloadImg.crossOrigin = "anonymous";

                    downloadImg.onload = function () {
                        ctx.save();
                        ctx.beginPath();
                        ctx.arc(centerX, centerY, logoRadius, 0, 2 * Math.PI);
                        ctx.clip();

                        const logoSize = logoRadius * 2;
                        ctx.drawImage(downloadImg, centerX - logoRadius, centerY - logoRadius, logoSize, logoSize);
                        ctx.restore();

                        // 4. Disparar el flujo de descarga binaria
                        const downloadLink = document.createElement('a');
                        downloadLink.href = tempCanvas.toDataURL("image/png");
                        downloadLink.download = `QR_Premium_TI_${Date.now()}.png`;
                        downloadLink.click();
                    };
                }
            });

            // Disparar generación automática inicial si el input cuenta con valor por defecto
            if (urlInput && urlInput.value.trim()) {
                generateQR();
            }
        });
    </script>
@endpush
