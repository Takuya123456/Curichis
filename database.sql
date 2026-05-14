-- ============================================================
-- 🧊 Curichis Shop — Sistema de Ventas
-- Base de datos: curichis_db
-- ============================================================

CREATE DATABASE IF NOT EXISTS curichis_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE curichis_db;

-- Tabla: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    usuario    VARCHAR(60)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    nombre     VARCHAR(100) NOT NULL,
    rol        ENUM('admin','usuario') DEFAULT 'usuario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: clientes
CREATE TABLE IF NOT EXISTS clientes (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nombre     VARCHAR(100) NOT NULL,
    email      VARCHAR(100),
    telefono   VARCHAR(20),
    direccion  VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: productos
CREATE TABLE IF NOT EXISTS productos (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio      DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock       INT NOT NULL DEFAULT 0,
    categoria   VARCHAR(60),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: ventas
CREATE TABLE IF NOT EXISTS ventas (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id  INT,
    producto_id INT,
    cantidad    INT NOT NULL DEFAULT 1,
    total       DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    estado      ENUM('completada','pendiente','cancelada') DEFAULT 'completada',
    notas       TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id)  REFERENCES clientes(id)  ON DELETE SET NULL,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE SET NULL
);

-- ============================================================
-- Datos de prueba
-- ============================================================

-- Usuario admin (contraseña: admin123)
INSERT INTO usuarios (usuario, password, nombre, rol) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'admin');

-- Clientes de prueba
INSERT INTO clientes (nombre, email, telefono, direccion) VALUES
('María Pérez',    'maria@mail.com',  '987654321', 'Mercado Central, Pucallpa'),
('José Quispe',    'jose@mail.com',   '912345678', 'Jr. Ucayali 456, Pucallpa'),
('Rosa Flores',    'rosa@mail.com',   '998877665', 'Av. Centenario 789, Pucallpa');

-- Productos de prueba (sabores de curichis)
INSERT INTO productos (nombre, descripcion, precio, stock, categoria) VALUES
('Curichi de Maracuyá',    'Clásico curichi de maracuyá natural, bien helado y ácido',         0.50, 100, 'Curichi'),
('Curichi de Fresa',       'Sabor a fresa natural con un toque dulce, favorito de los niños',  0.50, 120, 'Curichi'),
('Curichi de Coco',        'Cremoso y tropical, con trozos de coco natural',                   0.50,  80, 'Curichi'),
('Curichi de Chicha',      'Sabor a chicha morada, bien dulce y moradito',                     0.50,  90, 'Curichi'),
('Marciano de Tamarindo',  'Combinación ácida y dulce de tamarindo puro',                      0.50,  60, 'Marciano'),
('Marciano Especial',      'Mezcla de frutas amazónicas: aguaje, camu camu y cocona',          1.00,  40, 'Marciano'),
('Paleta de Aguaje',       'Paleta artesanal de aguaje, el fruto amazónico más popular',       1.50,  50, 'Paleta'),
('Granizado de Limón',     'Hielo granizado con jugo de limón y azúcar, refrescante total',    1.00,  30, 'Granizado');

-- Ventas de prueba
INSERT INTO ventas (cliente_id, producto_id, cantidad, total, estado) VALUES
(1, 1, 10, 5.00,  'completada'),
(2, 5,  5, 2.50,  'completada'),
(3, 7,  2, 3.00,  'completada'),
(1, 2, 20, 10.00, 'pendiente'),
(2, 6,  3, 3.00,  'completada');
