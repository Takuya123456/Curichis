# Sistema de Ventas de Curichis
**RaspaLocos** — Sistema web para el registro y gestión de ventas de curichis o marcianos.

## 1. Descripción del Negocio

El pequeño negocio de venta de curichis o marcianos necesitan gestionar sus ventas, productos y clientes de forma precisa y centralizada. Este sistema reemplaza los registros manuales en papel o planillas físicas, eliminando problemas como:

- Registros incompletos o manipulados
- Alto costo administrativo por procesar ventas manualmente
- Imposibilidad de generar reportes históricos de forma automática
- Falta de trazabilidad sobre las transacciones realizadas
- Dependencia de personal para consolidar información

---

## 2. Problema y Solución

### Problema Identificado
El negocio de venta de curichis carecen de un sistema digital accesible para registrar, monitorear y gestionar sus ventas, productos y clientes. El control manual genera imprecisiones, pérdidas de información y dificulta la toma de decisiones basadas en datos confiables.

### Causas
- Ausencia de una herramienta digital centralizada para registrar ventas
- Los registros en papel se pierden, deterioran o se alteran fácilmente
- No existe diferenciación de roles entre quién administra el sistema
- Es imposible generar reportes históricos de forma automática

### Efectos
- Pérdida económica por registros incorrectos de ventas
- Incapacidad de detectar productos más vendidos
- Mayor carga operativa para el dueño del negocio

### Solución Propuesta
Desarrollar una aplicación web con PHP + POO + MVC que permita:

- Autenticar usuarios con acceso seguro al sistema
- Registrar ventas con fecha, cliente y producto exactos usando PDO y MariaDB
- Gestionar el catálogo de productos y clientes (CRUD completo)
- Consultar y filtrar el historial de ventas
- Visualizar un dashboard con acceso rápido a los módulos principales

---

## 3. Preanálisis

### Necesidades Identificadas
- Registrar cada venta con cliente, producto, cantidad y total
- Panel de control con acceso rápido a ventas, productos y clientes
- Administrar el catálogo de productos (crear, editar, eliminar)
- Gestionar la cartera de clientes
- Autenticar usuarios para proteger la información del sistema

### Estudio de Viabilidad

**Viabilidad Técnica**
- PHP 8+ disponible en prácticamente cualquier servidor web
- MariaDB es un gestor gratuito, robusto y ampliamente documentado
- Apache con mod_rewrite disponible en XAMPP para desarrollo local
- La POO permite estructurar el sistema con clases, herencia y encapsulamiento
- El patrón MVC está documentado en CONCEPTS.md

**Viabilidad Económica**
- Stack completamente open source y gratuito (PHP, MariaDB, Apache, Git)
- Entorno de desarrollo levantable localmente con XAMPP sin costo
- No se requieren licencias de software adicionales

**Viabilidad Operacional**
- Los usuarios solo necesitan un navegador web para acceder
- Administrable de forma remota una vez desplegado
- La separación en módulos facilita la capacitación del personal

### Alcance del Sistema

**Dentro del alcance**
- Autenticación con sesiones PHP
- Módulo de productos: CRUD completo
- Módulo de clientes: CRUD completo
- Módulo de ventas: registro e historial
- Dashboard con acceso rápido a todos los módulos
- Layouts reutilizables (sidebar, header) — principio DRY

**Fuera del alcance**
- Integración con dispositivos de pago
- Módulo de facturación electrónica
- Aplicación móvil nativa (iOS / Android)
- Notificaciones por correo o SMS
- Integración con sistemas ERP externos

---

## 4. Análisis de Requisitos

### 4.1 Requisitos Funcionales
| ID | Requisito |
|----|-----------|
| RF01 | El sistema debe permitir iniciar sesión con usuario y clave |
| RF02 | El sistema debe listar todos los productos registrados |
| RF03 | El sistema debe permitir crear, editar y eliminar productos |
| RF04 | El sistema debe listar todos los clientes registrados |
| RF05 | El sistema debe permitir crear, editar y eliminar clientes |
| RF06 | El sistema debe registrar nuevas ventas asociando cliente y producto |
| RF07 | El sistema debe mostrar el historial de ventas |
| RF08 | El sistema debe mostrar un dashboard con acceso rápido a los módulos |
| RF09 | El sistema debe cerrar sesión correctamente |

### 4.2 Requisitos No Funcionales
| ID | Requisito |
|----|-----------|
| RNF01 | El sistema debe responder en menos de 2 segundos |
| RNF02 | El sistema debe funcionar en cualquier navegador moderno |
| RNF03 | Las contraseñas no deben almacenarse en texto plano |
| RNF04 | El sistema debe ser responsive para dispositivos móviles |
| RNF05 | El código debe seguir el patrón MVC para facilitar el mantenimiento |

---

## 5. Stack Tecnológico

| Capa | Tecnología |
|------|-----------|
| Backend | PHP 8+ — POO (Programación Orientada a Objetos) — MVC desde cero |
| Base de datos | MariaDB — PDO (PHP Data Objects) con prepared statements |
| Frontend | HTML5, CSS3, JavaScript, Bootstrap 5 — Vistas PHP con layouts reutilizables |
| Servidor web | Apache — Reescritura de URLs vía .htaccess |
| Control de versiones | Git + GitHub |
| Configuración | Variables de entorno (.env) para credenciales |

---

## 6. Arquitectura del Proyecto

El sistema aplica POO y MVC implementado desde cero.

### Flujo de una Petición
```
Navegador → .htaccess → app/index.php → App.php → Router.php
                                                        ↓
                                              XxxController.php
                                               ↙            ↘
                                         Modelo.php       vista.php
                                        (Database)       (HTML+PHP)
```

### Estructura del Proyecto
```
entregable_final/
├── .env                  ← Variables de entorno (NO subir a git)
├── .env.example          ← Plantilla de variables
├── .gitignore
├── .htaccess
├── CONCEPTS.md
├── README.md
├── app/
│   ├── index.php         ← Entry point
│   ├── config/
│   │   └── config.php
│   ├── core/
│   │   ├── App.php
│   │   ├── Controller.php
│   │   ├── Database.php
│   │   └── Router.php
│   ├── controllers/
│   │   ├── HomeController.php
│   │   ├── LoginController.php
│   │   ├── LogoutController.php
│   │   ├── DashboardController.php
│   │   ├── ProductosController.php
│   │   ├── ClientesController.php
│   │   ├── VentasController.php
│   │   └── UsuariosController.php
│   ├── models/
│   │   ├── Login.php
│   │   ├── Producto.php
│   │   ├── Cliente.php
│   │   ├── Venta.php
│   │   └── Usuario.php
│   └── views/
│       ├── layouts/
│       │   └── sidebar-dashboard.php
│       ├── home/
│       ├── auth/
│       ├── dashboard/
│       ├── Productos/
│       ├── Clientes/
│       ├── ventas/
│       └── usuarios/
└── public/
    ├── css/
    ├── js/
    └── video/
```

---

## 7. Instalación

### Requisitos previos
- PHP 8+
- XAMPP (Apache + MariaDB)
- Git

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/curichazo.git
cd curichazo

# 2. Configurar variables de entorno
cp .env.example .env
# Editar .env con tus credenciales de base de datos

# 3. Crear la base de datos
# Importar database.sql en phpMyAdmin

# 4. Acceder al sistema
# http://localhost/entregable_final
```

---

## 8. Base de Datos

```sql
CREATE DATABASE senai_asistencia;
USE senai_asistencia;

CREATE TABLE usuarios (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario  VARCHAR(150) NOT NULL,
    clave           VARCHAR(250) NOT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE clientes (
    id_cliente      INT AUTO_INCREMENT PRIMARY KEY,
    nombre          VARCHAR(100) NOT NULL,
    apellido        VARCHAR(100) NOT NULL,
    celular         VARCHAR(20),
    fecha_registro  DATE DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE productos (
    id_producto     INT AUTO_INCREMENT PRIMARY KEY,
    nombre          VARCHAR(100) NOT NULL,
    descripcion     TEXT,
    precio          DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock           INT NOT NULL DEFAULT 0,
    categoria       VARCHAR(60)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE ventas (
    id_venta        INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente      INT,
    id_producto     INT,
    nombre_cliente  VARCHAR(100),
    nombre_producto VARCHAR(100),
    cantidad        INT NOT NULL DEFAULT 1,
    total           DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    estado          VARCHAR(30) DEFAULT 'completada',
    fecha_venta     DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente)  REFERENCES clientes(id_cliente)  ON DELETE SET NULL,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

---

## 9. Diagrama Entidad-Relación

### Cardinalidades

**usuarios** — Tabla independiente. Representa las cuentas de acceso al sistema.

**clientes → ventas (1:N)**
Un cliente puede tener muchos registros de ventas.
Cada venta pertenece a un solo cliente.
```
clientes (1) -----< ventas (N)
```

**productos → ventas (1:N)**
Un producto puede aparecer en muchas ventas.
Cada venta referencia un solo producto.
```
productos (1) -----< ventas (N)
```

---

## 10. Credenciales de prueba

| Usuario | Clave |
|---------|-------|
| Walter  | 12345 |
