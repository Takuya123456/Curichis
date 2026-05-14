# 🧊 CONCEPTS — Curichis Shop

## ¿Qué es un Curichi?
Un **curichi** (también llamado **marciano** en otras regiones del Perú) es un helado artesanal típico peruano hecho en una bolsita plástica transparente, con sabores de frutas naturales como maracuyá, fresa, coco, chicha morada, entre otros. Se congela y se come chupándolo directamente de la bolsita. Es muy popular en mercados, colegios y calles de ciudades como Pucallpa, Iquitos y otras ciudades amazónicas.

---

## 🎯 Propósito del sistema
**Curichis Shop** es un sistema de gestión de ventas diseñado para pequeños negocios de venta de curichis y helados artesanales peruanos. Permite registrar ventas, controlar el inventario de sabores/productos y gestionar la cartera de clientes.

---

## 🗂️ Entidades principales

### Productos (sabores/presentaciones)
- Nombre del curichi / helado
- Sabor / descripción
- Precio unitario
- Stock disponible
- Categoría (Curichi, Paleta, Granizado, etc.)

### Clientes
- Nombre del cliente
- Contacto (teléfono, email)
- Dirección / zona

### Ventas
- Cliente asociado
- Producto vendido
- Cantidad
- Total cobrado
- Estado (completada, pendiente, cancelada)
- Notas / observaciones

### Usuarios (sistema)
- Usuario + contraseña (acceso al sistema)
- Nombre completo
- Rol (admin / usuario)

---

## 🏗️ Arquitectura
- **Patrón:** MVC (Model - View - Controller)
- **Lenguaje:** PHP 8+ sin frameworks
- **Base de datos:** MySQL con PDO
- **Frontend:** HTML5 + CSS3 + JS Vanilla
- **Estilo:** Tema oscuro con acentos de color tropical

---

## 🌈 Paleta de colores (inspiración tropical peruana)
| Color | Uso | Hex |
|-------|-----|-----|
| Rosa fuerte | Primario / acento | `#e8407a` |
| Azul/morado | Secundario | `#5b6ef5` |
| Amarillo | Acento cálido | `#ffd166` |
| Verde menta | Éxito | `#06d6a0` |
| Fondo oscuro | Background | `#0f0f1a` |

---

## 📋 Módulos del sistema
1. **Home** — Página pública de presentación con hero visual
2. **Login / Registro** — Autenticación de usuarios
3. **Dashboard** — Resumen de estadísticas y ventas recientes
4. **Productos** — CRUD de sabores y presentaciones
5. **Clientes** — CRUD de clientes del negocio
6. **Ventas** — CRUD de transacciones de venta

---

## 🚀 Flujo de uso
```
Visitante → Home → Login/Registro → Dashboard → Gestión
```
