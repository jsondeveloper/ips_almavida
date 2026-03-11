CREATE DATABASE ips_almavida;
USE ips_almavida;

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
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
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT,
    tipo_examen VARCHAR(100),
    empresa VARCHAR(150),
    fecha_cita DATETIME,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (paciente_id) REFERENCES pacientes(id)
    ON DELETE CASCADE
);

CREATE TABLE usuarios (

id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
email VARCHAR(100) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

INSERT INTO pacientes 
(nombre_completo,tipo_documento,numero_documento,direccion,telefono,celular,fecha_nacimiento,edad,eps,contacto_emergencia,parentesco)
VALUES
('Carlos Ramirez','CC','10101010','Bogota','1234567','3001111111','1990-05-10',34,'Sura','Maria Ramirez','Madre'),
('Laura Torres','CC','20202020','Soacha','7654321','3002222222','1995-08-12',29,'Sanitas','Pedro Torres','Padre');

INSERT INTO citas (paciente_id,tipo_examen,empresa,fecha_cita)
VALUES
(1,'Audiometria','Constructora ABC','2026-03-20 08:00:00'),
(1,'Examen Visual','Constructora ABC','2026-03-21 10:00:00'),
(2,'Examen de Sangre','Empresa XYZ','2026-03-22 09:00:00');