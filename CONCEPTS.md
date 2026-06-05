# CONCEPTS.md
Explicación detallada de cada carpeta y archivo del proyecto.

---

## Estructura general

```
employee-attendance-system/
├── app/
├── config/
├── public/
├── sql/
├── .env
├── .env.example
├── .gitignore
├── .htaccess
├── README.md
└── CONCEPTS.md
```

---

## `app/`
Contiene toda la lógica de la aplicación. Los alumnos trabajarán principalmente aquí.
No es accesible directamente desde el navegador, solo desde el código.

---

### `app/core/`
Clases base del framework MVC que construimos desde cero.

| Archivo | Descripción |
|---|---|
| `App.php` | Inicializa la aplicación: arranca la sesión y lanza el Router |
| `Router.php` | Lee la URL del navegador y decide qué Controller y método ejecutar |
| `Controller.php` | Clase base. Todos los controllers heredan de esta clase y pueden usar su método `view()` |
| `Model.php` | Clase base. Todos los modelos heredan de esta clase. Contiene la conexión PDO |

#### ¿Cómo funciona el Router?

El Router lee el parámetro `?url=` que le pasa el `.htaccess` y lo divide en tres partes:

```
URL: /empleados/ver/5

Segmento 0 → "empleados" → EmpleadosController
Segmento 1 → "ver"       → método ver()
Segmento 2 → "5"         → parámetro $id
```

Si la URL está vacía (raíz del proyecto), el Router usa `HomeController::index()` por defecto.
Si la URL tiene solo un segmento, el método por defecto es `index`.

Tabla de ejemplos:

| URL | Controller | Método | Parámetros |
|---|---|---|---|
| `/` | HomeController | index | ninguno |
| `/login` | LoginController | index | ninguno |
| `/empleados` | EmpleadosController | index | ninguno |
| `/empleados/ver/5` | EmpleadosController | ver | 5 |
| `/empleados/editar/3` | EmpleadosController | editar | 3 |

#### ¿Para qué sirve Controller.php?

Antes del Router, cada controlador cargaba sus vistas con `require_once` manualmente.
Ahora todos los controladores heredan de `Controller` y usan el método `view()`:

```php
// Antes (manual, repetitivo)
require_once __DIR__ . '/../views/auth/login.php';

// Ahora (usando la clase base)
$this->view('auth/login', ['error' => $error]);
```

El método `view()` también recibe un array de datos y los convierte en variables
para que la vista los use directamente:

```php
// En el controller
$this->view('empleados/index', ['empleados' => $lista, 'titulo' => 'Mi lista']);

// En la vista, ya puedes usar $empleados y $titulo directamente
```

#### ¿Por qué ya no necesitamos archivos como app/login.php?

Antes del Router, necesitabas un archivo físico por cada página que arrancara el controlador:

```
Usuario entra a /app/login.php → carga LoginController → ejecuta login()
```

Ahora el Router hace ese trabajo automáticamente para cualquier URL:

```
Usuario entra a /login → Router lee "login" → LoginController::index()
```

Ya no necesitas crear un archivo .php por cada página. Solo creas el Controller
y el Router lo encuentra por la URL.

---

### `app/controllers/`
Aquí van los controllers del sistema. Cada controller maneja las peticiones del usuario
y conecta los modelos con las vistas.

**Ejemplo de flujo:**
```
Usuario entra a /employees → Router → EmployeeController → Employee (model) → vista employees/index.php
```

---

### `app/models/`
Aquí van los modelos del sistema. Cada modelo representa una tabla de la base de datos
y contiene los métodos para consultar, insertar, actualizar y eliminar registros usando PDO.

**Ejemplo:**
```php
class Employee extends Model {
    // métodos: getAll(), findById(), save(), delete()
}
```

---

### `app/views/`
Aquí van los archivos HTML/PHP que el usuario ve en el navegador.
Cada carpeta representa un módulo del sistema.

| Carpeta | Descripción |
|---|---|
| `layouts/` | Elementos que se repiten en todas las páginas (header, footer, navbar) |
| `home/` | Vista del dashboard principal después del login |
| `employees/` | Vistas del módulo de empleados (listar, crear, editar) |
| `departments/` | Vistas del módulo de departamentos |
| `attendance/` | Vistas del módulo de asistencia y reportes |
| `auth/` | Vistas de autenticación (login, registro) |

---

### `app/views/layouts/`
Archivos que se incluyen en todas las vistas para no repetir código (principio DRY).

| Archivo | Descripción |
|---|---|
| `header.php` | Parte superior de la página: navbar, menú, estilos CSS |
| `footer.php` | Parte inferior de la página: scripts JS, copyright |

**¿Cómo se usan?**
```php
include '../layouts/header.php';
// ... contenido de la vista ...
include '../layouts/footer.php';
```

---

## `config/`

| Archivo | Descripción |
|---|---|
| `database.php` | Clase Database que gestiona la conexión PDO a MariaDB. Lee las credenciales del archivo `.env` |

---

## `public/`
**Única carpeta accesible desde el navegador.** El servidor web apunta aquí.
Los archivos fuera de `public/` no son accesibles directamente por seguridad.

| Archivo/Carpeta | Descripción |
|---|---|
| `index.php` | Punto de entrada único de toda la aplicación. Carga el core y arranca el Router |
| `css/` | Archivos de estilos CSS |
| `js/` | Archivos JavaScript |
| `image/` | Imágenes del sistema (fotos de empleados, íconos) |

---

## Archivos raíz

| Archivo | Descripción |
|---|---|
| `.env` | Credenciales reales de la base de datos. **Nunca se sube a GitHub** |
| `.env.example` | Plantilla del `.env` sin datos reales. Se sube a GitHub para que otros sepan qué variables configurar |
| `.gitignore` | Lista de archivos que Git debe ignorar (ej: `.env`) |
| `.htaccess` | Intercepta todas las peticiones y las redirige a `app/index.php` para que el Router funcione |
| `README.md` | Información principal del proyecto: descripción, instalación, tecnologías |
| `CONCEPTS.md` | Este archivo. Explicación detallada de cada carpeta y archivo del proyecto |

### ¿Qué hace el `.htaccess` exactamente?

El `.htaccess` es un archivo de configuración que Apache lee en cada petición.
Sin él, Apache intentaría buscar el archivo físico que coincida con la URL, y como no existe, mostraría un error o el listado de carpetas.

El nuestro tiene dos reglas:

**Regla 1: La raíz del proyecto**
```
RewriteRule ^$ app/index.php [L]
```
Cuando el usuario entra a `http://localhost/2026/employee-attendance-system/`, la URL no tiene nada después de la última barra. La regla `^$` detecta esa URL vacía y redirige directo a `app/index.php`.

Esta regla no lleva condiciones porque la raíz ES una carpeta real y las condiciones `!-d` (no es carpeta) la bloquearían.

**Regla 2: Todo lo demás**
```
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)$ app/index.php?url=$1 [QSA,L]
```
Las dos condiciones dicen: "solo aplica esta regla si lo que se pide NO es un archivo real y NO es una carpeta real". Eso protege los assets (CSS, JS, imágenes) para que se sirvan directamente sin pasar por el Router.

Si se cumple, captura todo lo que hay en la URL con `(.+)` y lo pasa como parámetro `?url=` a `app/index.php`.

Ejemplo completo:
```
El usuario entra a:  /2026/employee-attendance-system/login
"login" no es archivo ni carpeta real
.htaccess redirige a: app/index.php?url=login
Router lee ?url=login y despacha LoginController::index()
```

**Flags que usa la regla:**
- `[L]` — Last: si esta regla se aplica, detiene el proceso y no sigue revisando más reglas
- `[QSA]` — Query String Append: si la URL ya tenía parámetros GET, los conserva y agrega `url=` encima

---

## Flujo completo de una petición

```
Navegador escribe: http://localhost/2026/employee-attendance-system/login

1. .htaccess detecta que "login" no es un archivo real
   y redirige a: app/index.php?url=login

2. app/index.php carga config.php y arranca App.php

3. App.php inicia la sesión (session_start) y crea el Router

4. Router.php lee ?url=login
   divide la URL: controller = LoginController, método = index

5. Router carga app/controllers/LoginController.php
   crea una instancia y ejecuta LoginController::index()

6. LoginController llama al Model si hay POST,
   o carga la vista si es GET

7. Login Model consulta MariaDB con PDO

8. La vista app/views/auth/login.php muestra el resultado al usuario
```

## ¿Por qué BASE_URL en config.php?

Cuando hacemos una redirección con `header('Location: ...')` o ponemos un link en HTML,
necesitamos saber la URL completa del proyecto. Esto cambia según el entorno:

```
En tu computadora:  http://localhost/2026/employee-attendance-system
En producción:      https://miempresa.com
```

Por eso guardamos la URL base en el archivo `.env` y la leemos en `config.php`.
Así solo cambias un valor en `.env` y todo el proyecto se adapta.

# PHP NO SE PUEDE LEER ENV