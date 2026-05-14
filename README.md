# 🧊 Curichis — Sistema de Ventas

Sistema de gestión de ventas de **curichis y marcianos** (helados artesanales peruanos), construido en **PHP puro con arquitectura MVC**.

---

## 📁 Estructura del proyecto

```
curichis/
├── .env                  ← Variables de entorno (NO subir a git)
├── .env.example          ← Plantilla de variables
├── .gitignore
├── CONCEPTS.md           ← Conceptos y diseño del sistema
├── README.md
├── database.sql          ← Script de base de datos
├── app/
│   ├── config/           → config.php (lee desde .env)
│   ├── controllers/      → HomeController, LoginController, Dashboard,
│   │                        ProductosController, ClientesController, VentasController
│   ├── core/             → App.php, Controller.php, Database.php, Router.php
│   ├── models/           → Login.php, Producto.php, Cliente.php, Venta.php
│   └── views/
│       ├── auth/         → login.php, register.php
│       ├── dashboard/    → index.php
│       ├── home/         → index.php
│       ├── ventas/       → index.php, create.php, edit.php
│       ├── productos/    → index.php, create.php, edit.php
│       ├── clientes/     → index.php, create.php, edit.php
│       └── layouts/      → header.php, footer.php
└── public/
    ├── css/style.css
    ├── js/app.js
    ├── img/              ← Pon tu video/foto de hero aquí
    ├── index.php
    └── .htaccess
```

---

## ⚙️ Instalación

### 1. Copiar el proyecto
Renombra la carpeta a `curichis/` y colócala en `htdocs/` (XAMPP) o `www/` (WAMP).

### 2. Configurar el entorno
Copia `.env.example` → `.env` y edita tus datos:
```env
DB_HOST=localhost
DB_USER=root
DB_PASS=          # tu contraseña MySQL
DB_NAME=curichis_db
APP_URL=http://localhost/curichis/public
```

### 3. Crear la base de datos
Abre **phpMyAdmin** y ejecuta el archivo `database.sql`.

### 4. Habilitar mod_rewrite
Asegúrate de tener `mod_rewrite` activo y `AllowOverride All` en Apache.

### 5. Acceder al sistema
```
http://localhost/curichis/public
```

---

## 🔐 Credenciales de prueba

| Usuario | Contraseña |
|---------|------------|
| admin   | password   |

---

## 🧊 Sabores incluidos en datos de prueba
- Curichi de Maracuyá / Fresa / Coco / Chicha
- Marciano de Tamarindo / Especial (aguaje + camu camu + cocona)
- Paleta de Aguaje
- Granizado de Limón

---

## 🎬 Agregar video o foto al hero
Sube tu archivo a `public/img/` y edita `app/views/home/index.php`:

**Video:**
```html
<video autoplay muted loop playsinline>
    <source src="<?= APP_URL ?>/img/hero.mp4" type="video/mp4">
</video>
```
**Foto:**
```html
<img src="<?= APP_URL ?>/img/hero.jpg" alt="Curichis">
```
