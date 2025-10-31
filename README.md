# 💧 Aguas del Huila

**Aguas del Huila** es un sistema web desarrollado en **Laravel 12** con **Livewire** y **Volt**, diseñado para dinamizar la gestión de contenido institucional, incluyendo noticias, servicios y secciones informativas administrables mediante un panel CRUD moderno y seguro.

---

## 🚀 Características principales

- 📰 **Gestión de Noticias:** creación, edición y eliminación de artículos con portada, contenido, autor y categoría.
- 🧰 **Gestión de Servicios:** módulo dinámico para administrar los servicios ofrecidos por la entidad.
- 📁 **Gestión de Secciones (Posts):** estructura jerárquica de información con subcategorías y archivos adjuntos (PDF, Excel, etc.).
- 👤 **Autenticación segura:** sistema de login y registro integrado con Laravel Breeze/Volt.
- ⚡ **Frontend interactivo:** componentes dinámicos con **Livewire**, **Tailwind CSS** y **Vite**.
- 🗃️ **Base de datos relacional:** diseño optimizado en **MySQL**, con relaciones entre usuarios, categorías, posts y archivos.

---

## 🧩 Tecnologías utilizadas

| Componente | Versión / Descripción |
|-------------|-----------------------|
| **Laravel** | 12.x |
| **PHP** | 8.4.x |
| **Composer** | 2.x |
| **Node.js** | 24.x |
| **npm** | 11.x |
| **Livewire** | 3.x |
| **Volt** | Interfaz dinámica moderna |
| **Tailwind CSS** | Framework CSS utilitario |
| **MySQL / MariaDB** | Motor de base de datos |

---

## ⚙️ Instalación del proyecto

1️⃣ Clonar el repositorio:
```bash
git clone https://github.com/tu_usuario/aguashuila.git
```

2️⃣ Entrar al proyecto:
```bash
cd aguashuila
```

3️⃣ Instalar dependencias de Composer:
```bash
composer install
```

4️⃣ Instalar dependencias de Node:
```bash
npm install
```

5️⃣ Configurar el entorno:
```bash
cp .env.example .env
php artisan key:generate
```

6️⃣ Configurar base de datos en el archivo .env:
```bash
DB_DATABASE=aguashuilaDB
DB_USERNAME=root
DB_PASSWORD=
```

7️⃣ Ejecutar migraciones:
```bash
php artisan migrate
```

8️⃣ Ejecutar el servidor:
```bash
php artisan serve
```
O
```bash
npm run dev
```

🧑‍💻 Autor

Desarrollado por:
William Sabi
👨‍💻 Ingeniero en Sistemas — Desarrollo Web y Móvil
📧 Contacto: sabicriollo@gmail.com
