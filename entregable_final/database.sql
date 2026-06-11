CREATE DATABASE IF NOT EXISTS senai_asistencia
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE senai_asistencia;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS ventas;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS usuarios;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(150) NOT NULL,
  clave VARCHAR(255) NOT NULL,
  creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uk_usuarios_nombre (nombre_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE clientes (
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  celular VARCHAR(20) NULL,
  fecha_registro DATE NOT NULL,
  INDEX idx_clientes_nombre (nombre, apellido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE productos (
  id_producto INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  descripcion TEXT NULL,
  precio DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  categoria VARCHAR(50) NOT NULL,
  fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_productos_categoria (categoria),
  CONSTRAINT chk_productos_precio CHECK (precio >= 0),
  CONSTRAINT chk_productos_stock CHECK (stock >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ventas (
  id_venta INT AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT NOT NULL,
  id_producto INT NOT NULL,
  nombre_cliente VARCHAR(200) NOT NULL,
  nombre_producto VARCHAR(150) NOT NULL,
  cantidad INT NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  estado ENUM('completada', 'cancelada') NOT NULL DEFAULT 'completada',
  fecha_venta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ventas_fecha (fecha_venta),
  INDEX idx_ventas_cliente (id_cliente),
  INDEX idx_ventas_producto (id_producto),
  CONSTRAINT fk_ventas_clientes
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  CONSTRAINT fk_ventas_productos
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  CONSTRAINT chk_ventas_cantidad CHECK (cantidad > 0),
  CONSTRAINT chk_ventas_total CHECK (total >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Usuario inicial del sistema.
-- Acceso: admin / admin123
INSERT INTO usuarios (nombre_usuario, clave) VALUES
('admin', '$2y$10$GS6Bz0JR.t5w3VJgNkzEIO7i2TAb76ecXHXR6THlGVov78vWuCcL6');

INSERT INTO clientes (nombre, apellido, celular, fecha_registro) VALUES
('Ana', 'Torres', '999111222', CURDATE()),
('Luis', 'Rojas', '999333444', CURDATE());

INSERT INTO productos (nombre, descripcion, precio, stock, categoria) VALUES
('Curichi de maracuya', 'Curichi artesanal de maracuya.', 2.50, 50, 'Curichi'),
('Marciano de fresa', 'Marciano helado sabor fresa.', 1.50, 80, 'Marciano'),
('Paleta de coco', 'Paleta helada sabor coco.', 3.00, 40, 'Paleta');

INSERT INTO ventas (
  id_cliente,
  id_producto,
  nombre_cliente,
  nombre_producto,
  cantidad,
  total,
  estado,
  fecha_venta
) VALUES (
  1,
  1,
  'Ana Torres',
  'Curichi de maracuya',
  2,
  5.00,
  'completada',
  NOW()
);

UPDATE productos
SET stock = stock - 2
WHERE id_producto = 1;
