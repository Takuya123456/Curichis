# Raspalocos - Sistema de Ventas e Inventario

## TRELLO
![Trello](Imagenes-fotos/Trello.png)

Aplicación web para el registro de ventas, control de stock y gestión de fiados de curichis artesanales, desarrollada en **PHP puro con arquitectura MVC desde cero**, **Programación Orientada a Objetos (POO)**, **PDO** y **MariaDB** como base de datos.

## Tabla de Contenidos

* Descripción del Negocio
* Problema y Solución
* Preanálisis
* Análisis de Requisitos
* Stack Tecnológico
* Arquitectura del Proyecto
* Instalación
* Trello
* Diagrama de Figma UI/UX
* Base de Datos

## 1. Descripción del Negocio

**Raspalocos** es un negocio familiar dedicado a la preparación y venta de curichis artesanales peruanos hechos con frutas locales (aguaje, coco, chapo, maní, fresa, etc.). 

La dueña maneja todo el negocio de forma individual. Actualmente, el registro de ventas, control de stock y fiados se realiza de manera manual en cuadernos.

## 2. Problema y Solución

**Problema Identificado**  
La dueña registra las ventas y fiados de forma manual, lo que provoca:
- Dificultad para conocer las ventas diarias exactas
- Pérdida de control sobre el stock de productos
- Confusión y posibles pérdidas por fiados mal registrados
- Imposibilidad de generar reportes rápidos de ventas e ingresos

**Solución Propuesta**  
Desarrollar un **Sistema Web de Control de Ventas e Inventario** que permita:
- Registrar ventas al contado y a crédito (fiados)
- Controlar el stock de productos automáticamente
- Gestionar clientes y sus deudas pendientes
- Generar reportes de ventas de forma sencilla

## 3. Preanálisis

**Necesidades Identificadas**
- Registrar y gestionar clientes
- Administrar productos con control de stock
- Registrar ventas al contado y fiados
- Actualizar stock automáticamente al vender
- Consultar historial de ventas y fiados pendientes
- Interfaz sencilla e intuitiva para la dueña

**Estudio de Viabilidad**
- **Técnica**: PHP 8+, MariaDB y MVC
- **Económica**: Todo el stack es gratuito
- **Operacional**: Fácil de usar desde cualquier navegador

**Alcance del Sistema**
Dentro del alcance: Clientes, Productos, Ventas y Stock.  
Fuera del alcance: App móvil y facturación electrónica.

## 4. Análisis de Requisitos

**Requisitos Funcionales**
- CRUD de Clientes
- CRUD de Productos con stock
- Registro de ventas (contado y fiado)
- Actualización automática de stock
- Visualización de fiados pendientes

**Requisitos No Funcionales**
- Interfaz intuitiva y responsive
- Código limpio y mantenible
- Buenas prácticas de programación

## Stack Tecnológico

| Capa          | Tecnología |
|---------------|----------|
| Backend       | PHP 8+ — POO — MVC desde cero |
| Base de datos | MariaDB — PDO con prepared statements |
| Frontend      | HTML5, CSS3, JavaScript, Bootstrap |
| Servidor      | Apache |
| Control de versiones | Git + GitHub |

## Arquitectura del Proyecto

El sistema aplica **POO** y el patrón **MVC** implementado desde cero.

## Instalación

### Requisitos
- PHP 8+
- MariaDB / MySQL
- XAMPP o servidor Apache

### Pasos
```bash
git clone https://github.com/tuusuario/raspalocos.git
cd raspalocos
cp .env.example .env
# Configurar base de datos en .env
```
## Diagrama de Figma UI/UX
*(Pendiente de subir las capturas del diseño en Figma)*

## Base de Datos

```sql
CREATE DATABASE raspalocos_db;
USE raspalocos_db;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apodo VARCHAR(50),
    telefono VARCHAR(15),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(6,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0
);

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    tipo ENUM('contado', 'fiado') NOT NULL,
    total DECIMAL(8,2) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE detalle_ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT,
    producto_id INT,
    cantidad INT NOT NULL,
    subtotal DECIMAL(8,2) NOT NULL,
    FOREIGN KEY (venta_id) REFERENCES ventas(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);
