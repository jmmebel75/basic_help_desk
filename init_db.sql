CREATE DATABASE IF NOT EXISTS sistema_incidencias;
USE sistema_incidencias;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  correo VARCHAR(100) UNIQUE NOT NULL,
  contraseña VARCHAR(255) NOT NULL,
  rol ENUM('usuario', 'admin') DEFAULT 'usuario'
);

CREATE TABLE tickets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT,
  titulo VARCHAR(100),
  descripcion TEXT,
  categoria VARCHAR(50),
  estado ENUM('abierto','en proceso','cerrado') DEFAULT 'abierto',
  solucion TEXT,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

INSERT INTO usuarios (nombre, correo, contraseña, rol)
VALUES ('Juan Pérez', 'juan@empresa.com', '1234', 'usuario');

INSERT INTO usuarios (nombre, correo, contraseña, rol)
VALUES ('Admin General', 'admin@empresa.com', 'admin', 'admin');

USE sistema_incidencias;

CREATE TABLE IF NOT EXISTS tickets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  tipo_incidencia VARCHAR(100) NOT NULL,
  fecha_apertura DATETIME DEFAULT CURRENT_TIMESTAMP,
  estado ENUM('Abierta', 'Pendiente', 'Asignada', 'Finalizada') DEFAULT 'Abierta',
  solucion TEXT,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
