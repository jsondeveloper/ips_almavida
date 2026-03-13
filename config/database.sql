CREATE DATABASE ips_almavida;
USE ips_almavida;


-- =========================
-- TABLA EMPRESAS
-- =========================

CREATE TABLE empresas (

id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(150) NOT NULL,
nit VARCHAR(20),
direccion VARCHAR(255),
telefono VARCHAR(20),
creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);


-- =========================
-- TABLA PACIENTES
-- =========================

CREATE TABLE pacientes (

id INT AUTO_INCREMENT PRIMARY KEY,
empresa_id INT,

nombre_completo VARCHAR(150) NOT NULL,
tipo_documento VARCHAR(20),
numero_documento VARCHAR(20) UNIQUE,

direccion VARCHAR(150),
telefono VARCHAR(20),
celular VARCHAR(20),

fecha_nacimiento DATE,
edad INT,

eps VARCHAR(100),

contacto_emergencia VARCHAR(150),
parentesco VARCHAR(50),

creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (empresa_id)
REFERENCES empresas(id)
ON DELETE SET NULL

);


-- =========================
-- TABLA CITAS
-- =========================

CREATE TABLE citas (

id INT AUTO_INCREMENT PRIMARY KEY,
paciente_id INT NOT NULL,

tipo_examen VARCHAR(100),
fecha_cita DATETIME,

creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (paciente_id)
REFERENCES pacientes(id)
ON DELETE CASCADE

);


-- =========================
-- TABLA USUARIOS (LOGIN)
-- =========================

CREATE TABLE usuarios (

id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
email VARCHAR(100) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);