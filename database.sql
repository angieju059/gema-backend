CREATE DATABASE IF NOT EXISTS gema_db;
USE gema_db;
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    estado INT NOT NULL -- 1: Activo, 2: Inactivo, 3: Espera
);