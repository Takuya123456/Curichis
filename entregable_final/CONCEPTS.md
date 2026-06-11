# CONCEPTS.md

Explicacion rapida de la estructura y del flujo del sistema de ventas.

## Estructura general

```text
entregable_final/
  app/
    config/       Configuracion general y lectura de .env
    controllers/  Controladores MVC
    core/         App, Router, Controller y Database
    models/       Consultas SQL con PDO
    views/        Pantallas PHP/HTML
  public/
    css/          Estilos del sistema
    js/           JavaScript del dashboard y landing
    video/        Videos usados en la portada y dashboard
  database.sql    Script para crear la base de datos
  .env.example    Ejemplo de configuracion local
  .htaccess       Reglas de rutas para Apache
```

## Flujo MVC

1. Apache recibe una URL como `/clientes/eliminar/5`.
2. `.htaccess` envia la ruta a `app/index.php?url=clientes/eliminar/5`.
3. `app/index.php` carga la configuracion y arranca `App`.
4. `App` inicia la sesion y ejecuta `Router`.
5. `Router` convierte la URL en `ClientesController::eliminar(5)`.
6. El controlador valida sesion/datos y llama al modelo.
7. El modelo ejecuta SQL con PDO.
8. El controlador redirige o carga una vista con `$this->view()`.

## Carpetas principales

### `app/config`

Contiene `config.php`, que lee `.env` y define constantes como:

- `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`.
- `BASE_URL`, usada en enlaces y redirecciones.
- `TITLE_BUSINESS`, usada en titulos de paginas.

### `app/core`

- `App.php`: inicia sesion y llama al router.
- `Router.php`: lee la URL y decide que controlador/metodo ejecutar.
- `Controller.php`: clase base con el metodo `view()`.
- `Database.php`: crea la conexion PDO a MySQL.

### `app/controllers`

Reciben peticiones del navegador y conectan modelos con vistas:

- `LoginController`: inicio de sesion.
- `LogoutController`: cierre de sesion.
- `DashboardController`: panel principal.
- `ClientesController`: CRUD de clientes.
- `ProductosController`: CRUD de productos.
- `VentasController`: registro, reporte y detalle de ventas.
- `UsuariosController`: CRUD de usuarios.

### `app/models`

Contienen las consultas SQL:

- `Cliente.php`: clientes y bloqueo de eliminacion si tienen compras.
- `Producto.php`: productos y bloqueo de eliminacion si tienen ventas.
- `Venta.php`: registro de venta y descuento de stock con transaccion.
- `Usuario.php`: administracion de usuarios con claves cifradas.
- `Login.php`: validacion de credenciales.

### `app/views`

Son las pantallas que ve el usuario:

- `auth/`: login.
- `home/`: portada publica.
- `dashboard/`: panel principal.
- `clientes/`: registro, edicion y reporte.
- `productos/`: registro, edicion y reporte.
- `ventas/`: registro, reporte y detalle.
- `usuarios/`: registro, edicion y reporte.
- `layouts/`: sidebar, header y footer reutilizables.

## Reglas importantes

- Un cliente con compras no se elimina; se muestra un mensaje de aviso.
- Un producto con ventas no se elimina; se conserva el historial de ventas.
- Al registrar una venta, se descuenta el stock del producto.
- Si falla una venta, la transaccion hace rollback para no dejar datos incompletos.
- Las claves de usuarios creados desde el sistema se guardan con `password_hash()`.

## Rutas utiles

- `/` portada publica.
- `/login` inicio de sesion.
- `/dashboard` panel principal.
- `/clientes` reporte de clientes.
- `/productos` reporte de productos.
- `/ventas` reporte de ventas.
- `/usuarios` reporte de usuarios.
