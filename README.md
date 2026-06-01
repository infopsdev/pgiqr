# Plataforma de Gestión de Identidad y Operaciones QR (PGIQR)

<p align="center">
  <a href="https://skillicons.dev">
    <img src="https://skillicons.dev/icons?i=laravel,php,mysql,js,tailwind,nodejs,git,github,phpstorm" />
  </a>
</p>

---

## 📄 Descripción

**PGIQR** (Plataforma de Gestión de Identidad y Operaciones QR) es una solución institucional desarrollada en **Laravel 12** diseñada para automatizar, optimizar y centralizar los flujos de trabajo del departamento de Informática y sus áreas asociadas.

A través de la generación inteligente de códigos QR (dinámicos y estáticos), el sistema agiliza el control de acceso a estacionamientos, la emisión de gafetes con perfiles de identidad encriptados, el registro a capacitaciones y la descarga automatizada de constancias académicas.

---

## 🚀 Funcionalidades Principales

### 1. Control de Roles y Permisos (RBAC)
El sistema implementa una estructura de acceso basada en 4 roles predeterminados:
* **Administrador:** Control total del sistema, auditoría de datos y gestión de usuarios.
* **Operaciones Informáticas:** Administración de inventarios de hardware, configuración de redes y supervisión técnica de enlaces QR.
* **Enseñanza:** Creación de cursos, gestión de inscripciones y emisión automatizada de constancias.
* **Servicios Generales:** Control de acceso vehicular, asignación de espacios de estacionamiento y validación de gafetes institucionales.

### 2. Gestión de Cursos y Constancias (Módulo Enseñanza)
* Registro digital de asistencia para el personal médico, de enfermería, paramédico y administrativo a capacitaciones impartidas en el aula de la institución.
* Captura estandarizada de datos personales y profesionales: CURP, nombre completo, correo electrónico, adscripción/servicio y número telefónico.
* Generación de enlaces QR dinámicos para la descarga directa de constancias validadas.

### 3. Gestión de Gafetes e Identidad (Módulo Recursos Humanos / Servicios Generales)
* Registro estructurado del personal activo (datos personales, institucionales y profesionales como cédula y universidad).
* Creación de gafetes de identidad con códigos QR compactos para control de accesos, evitando la saturación visual de texto plano mediante punteros a la base de datos.
* Administración de jornadas laborales, días asignados y horarios de entrada/salida.

### 4. Módulo de Conectividad (Wi-Fi)
* Generación instantánea de códigos QR para el acceso rápido y seguro a redes inalámbricas asignadas a las aulas y salas de capacitación.

### 5. Notificaciones y Campañas (SMS / WhatsApp)
* Envío automatizado de avisos, recordatorios de capacitaciones y alertas de disponibilidad de constancias académicas a través de canales de mensajería directa.

---

## 🛠️ Tecnologías y Paquetes

* **Backend:** PHP 8.3.16 & Laravel 12.x Framework
* **Frontend:** JavaScript (Vanilla / Alpine.js) & Tailwind CSS
* **Base de Datos:** MySQL
* **Control de Versiones:** Git (Flujo de trabajo Gitflow)
* **IDE Recomendado:** PhpStorm
* **Generación QR:** *[Librería seleccionada en fase de desarrollo]*
* **Seguridad:** Laravel Breeze / Spatie Laravel Permission *(Sujeto a implementación)*

---

## ⚙️ Requisitos del Entorno 🔧

Para inicializar y ejecutar este sistema de forma local, asegúrate de contar con el siguiente entorno técnico:

* **Servidor Local:** Laragon 2025 v8.2.3
* **Servidor Web:** Apache 2.4.62
* **Lenguaje:** PHP 8.3.16 [TS]
* **Entorno de Ejecución:** Node.js & NPM
* **Manejador de Dependencias:** Composer 2.x
* **IDE:** PhpStorm 2024.2+

---

## 🚀 Instalación y Configuración Local

Sigue estos pasos en tu terminal (Git Bash) dentro de la carpeta de tu servidor local (`C:\laragon\www\`):

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/infopsdev/pgiqr.git](https://github.com/infopsdev/pgiqr.git)
   cd pgiqr