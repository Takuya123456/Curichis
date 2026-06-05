# Sistema de Ventas - Curichis y Marcianos
**TRELLO**
![Trello](Imagenes-fotos/Trello.png)

Aplicacion web desarrollada en PHP puro con arquitectura MVC, PDO y MySQL/MariaDB. Permite iniciar sesion, administrar clientes, productos, usuarios y registrar ventas descontando stock automaticamente.

## Figma
**Wireframe**
![Wireframe](Imagenes-fotos/Wireframe.png)


## Ui
![Ui](Imagenes-fotos/Ui.png)


## Ux
![Ux](Imagenes-fotos/Ux.png)


## Funcionalidades

- Login con sesiones PHP.
- CRUD de clientes.
- CRUD de productos.
- CRUD de usuarios.
- Registro de ventas con validacion de stock.
- Reporte y detalle de ventas.
- Conexion a MySQL usando variables de entorno en `.env`.

## Tecnologias

| Capa | Tecnologia |
| --- | --- |
| Backend | PHP 8+ |
| Base de datos | MySQL / MariaDB |
| Acceso a datos | PDO |
| Frontend | HTML, CSS, JavaScript, Bootstrap |
| Servidor local | Apache con XAMPP |

## Estructura

```text
app/
  config/       Configuracion general y lectura de .env
  controllers/  Controladores MVC
  core/         Router, App, Controller y Database
  models/       Modelos con consultas PDO
  views/        Vistas PHP
public/
  css/          Estilos
  js/           Scripts
  video/        Videos usados por la landing
database.sql    Script para crear la base de datos MySQL
.env.example    Ejemplo de configuracion local
```

## Requisitos

- XAMPP o equivalente con Apache, PHP 8+ y MySQL/MariaDB.
- Navegador web.
- Extension PDO MySQL habilitada en PHP.

## Instalacion

1. Copia la carpeta del proyecto en:

```powershell
C:\xampp\htdocs\entregable_final
```

2. Inicia Apache y MySQL desde el panel de XAMPP.

3. Configura el archivo `.env`:

```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=senai_asistencia
DB_USERNAME=root
DB_PASSWORD=
APP_URL=http://localhost/entregable_final
```

4. Importa la base de datos desde phpMyAdmin o con consola:

```powershell
C:\xampp\mysql\bin\mysql.exe -u root < database.sql
```

Si tu usuario MySQL tiene clave:

```powershell
C:\xampp\mysql\bin\mysql.exe -u root -p < database.sql
```

5. Abre la aplicacion:

```text
http://localhost/entregable_final
```

## Acceso inicial

```text
Usuario: admin
Clave: admin123
```

La clave inicial esta guardada con `password_hash`. Los usuarios creados desde el modulo de usuarios tambien se guardan cifrados.

## Base de datos

El archivo `database.sql` crea la base `senai_asistencia` y estas tablas:

- `usuarios`: cuentas para iniciar sesion.
- `clientes`: datos de clientes.
- `productos`: catalogo, precios, stock y categoria.
- `ventas`: venta realizada, cliente, producto, cantidad, total, estado y fecha.

Relaciones:

- `ventas.id_cliente` referencia a `clientes.id_cliente`.
- `ventas.id_producto` referencia a `productos.id_producto`.

Importante: `database.sql` elimina y vuelve a crear las tablas del sistema. Usalo para instalacion inicial o cuando quieras reiniciar los datos de prueba.

## Rutas principales

- `/` landing page.
- `/login` inicio de sesion.
- `/dashboard` panel principal.
- `/clientes` reporte de clientes.
- `/clientes/registro` nuevo cliente.
- `/productos` reporte de productos.
- `/productos/registro` nuevo producto.
- `/ventas` reporte de ventas.
- `/ventas/registro` nueva venta.
- `/usuarios` reporte de usuarios.
- `/usuarios/registro` nuevo usuario.

## Verificacion rapida

Validar sintaxis PHP:

```powershell
Get-ChildItem app -Recurse -Filter *.php | ForEach-Object { C:\xampp\php\php.exe -l $_.FullName }
```

Probar conexion a MySQL:

```powershell
C:\xampp\mysql\bin\mysqladmin.exe -u root ping
```

Ver tablas creadas:

```powershell
C:\xampp\mysql\bin\mysql.exe -u root -e "USE senai_asistencia; SHOW TABLES;"
```

## Notas de configuracion

- Si cambias el nombre de la carpeta en `htdocs`, actualiza `APP_URL`.
- Si MySQL usa clave, actualiza `DB_PASSWORD`.
- Si usas otro puerto MySQL, actualiza `DB_PORT`.
