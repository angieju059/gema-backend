CREATE DATABASE gema_db;
USE gema_db;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  nombre VARCHAR(100),
  apellido VARCHAR(100),
  estado INT NOT NULL
);
