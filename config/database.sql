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

INSERT INTO empresas (nombre, nit, direccion, telefono) VALUES
('Constructora Andina', '900123001', 'Bogotá', '6014001001'),
('Servicios Industriales SAS', '900123002', 'Medellín', '6044002002'),
('Transporte Nacional', '900123003', 'Cali', '6024003003'),
('Logística Integral', '900123004', 'Barranquilla', '6054004004'),
('Minería del Norte', '900123005', 'Bucaramanga', '6074005005'),
('Seguridad Atlas', '900123006', 'Bogotá', '6014006006'),
('Industria Textil Colombia', '900123007', 'Medellín', '6044007007'),
('Servicios Petroleros', '900123008', 'Villavicencio', '6084008008'),
('AgroCampo SAS', '900123009', 'Ibagué', '6084009009'),
('Tecnología Empresarial', '900123010', 'Bogotá', '6014010000');

INSERT INTO pacientes
(empresa_id,nombre_completo,tipo_documento,numero_documento,direccion,telefono,celular,fecha_nacimiento,edad,eps,contacto_emergencia,parentesco)
VALUES

(1,'Carlos Ramirez','CC','1001001','Bogotá','6012001001','3005001001','1990-04-10',34,'Sura','3106001001','Esposa'),
(2,'Laura Martinez','CC','1001002','Medellín','6042001002','3005001002','1988-07-15',36,'Sanitas','3106001002','Madre'),
(3,'Juan Gomez','CC','1001003','Cali','6022001003','3005001003','1995-01-20',29,'Nueva EPS','3106001003','Hermano'),
(4,'Diana Torres','CC','1001004','Barranquilla','6052001004','3005001004','1992-11-02',32,'Sura','3106001004','Padre'),
(5,'Andres Perez','CC','1001005','Bucaramanga','6072001005','3005001005','1987-03-18',37,'Compensar','3106001005','Esposa'),
(6,'Natalia Rojas','CC','1001006','Bogotá','6012001006','3005001006','1993-08-22',31,'Sanitas','3106001006','Hermana'),
(7,'Felipe Castro','CC','1001007','Medellín','6042001007','3005001007','1985-05-30',39,'Sura','3106001007','Esposa'),
(8,'Paola Vargas','CC','1001008','Cali','6022001008','3005001008','1991-09-12',33,'Nueva EPS','3106001008','Madre'),
(9,'Camilo Herrera','CC','1001009','Ibagué','6082001009','3005001009','1994-02-05',30,'Compensar','3106001009','Padre'),
(10,'Sandra Molina','CC','1001010','Bogotá','6012001010','3005001010','1989-12-28',35,'Sura','3106001010','Esposo'),
(1,'Ricardo Silva','CC','1001011','Bogotá','6012001011','3005001011','1990-03-12',34,'Sura','3106001011','Madre'),
(2,'Tatiana Duarte','CC','1001012','Medellín','6042001012','3005001012','1996-07-17',28,'Sanitas','3106001012','Padre'),
(3,'Oscar Pardo','CC','1001013','Cali','6022001013','3005001013','1984-06-01',40,'Nueva EPS','3106001013','Esposa'),
(4,'Mariana Lopez','CC','1001014','Barranquilla','6052001014','3005001014','1998-10-23',26,'Sura','3106001014','Hermana'),
(5,'Sebastian Ortiz','CC','1001015','Bucaramanga','6072001015','3005001015','1992-02-14',32,'Compensar','3106001015','Padre'),
(6,'Valentina Ruiz','CC','1001016','Bogotá','6012001016','3005001016','1997-04-09',27,'Sanitas','3106001016','Madre'),
(7,'Daniel Quintero','CC','1001017','Medellín','6042001017','3005001017','1991-08-25',33,'Sura','3106001017','Esposa'),
(8,'Karen Morales','CC','1001018','Cali','6022001018','3005001018','1993-05-05',31,'Nueva EPS','3106001018','Hermano'),
(9,'Julian Vega','CC','1001019','Ibagué','6082001019','3005001019','1986-01-16',38,'Compensar','3106001019','Esposa'),
(10,'Angela Peña','CC','1001020','Bogotá','6012001020','3005001020','1994-11-11',30,'Sura','3106001020','Madre');

INSERT INTO citas (paciente_id, tipo_examen, fecha_cita) VALUES
(1,'Sangre','2026-03-12 08:00:00'),
(2,'Orina','2026-03-12 09:00:00'),
(3,'Rayos X','2026-03-12 10:00:00'),
(4,'Ultrasonido','2026-03-12 11:00:00'),
(5,'Electrocardiograma','2026-03-12 14:00:00'),

(6,'Sangre','2026-03-13 08:00:00'),
(7,'Orina','2026-03-13 09:00:00'),
(8,'Rayos X','2026-03-13 10:00:00'),
(9,'Ultrasonido','2026-03-13 11:00:00'),
(10,'Electrocardiograma','2026-03-13 15:00:00'),

(11,'Sangre','2026-03-14 08:00:00'),
(12,'Orina','2026-03-14 09:00:00'),
(13,'Rayos X','2026-03-14 10:00:00'),
(14,'Ultrasonido','2026-03-14 11:00:00'),
(15,'Electrocardiograma','2026-03-14 16:00:00'),

(1,'Rayos X','2026-03-15 08:00:00'),
(2,'Ultrasonido','2026-03-15 09:00:00'),
(3,'Electrocardiograma','2026-03-15 10:00:00'),
(4,'Sangre','2026-03-15 11:00:00'),
(5,'Orina','2026-03-15 14:00:00'),

(6,'Rayos X','2026-03-16 08:00:00'),
(7,'Ultrasonido','2026-03-16 09:00:00'),
(8,'Electrocardiograma','2026-03-16 10:00:00'),
(9,'Sangre','2026-03-16 11:00:00'),
(10,'Orina','2026-03-16 15:00:00'),

(11,'Rayos X','2026-03-17 08:00:00'),
(12,'Ultrasonido','2026-03-17 09:00:00'),
(13,'Electrocardiograma','2026-03-17 10:00:00'),
(14,'Sangre','2026-03-17 11:00:00'),
(15,'Orina','2026-03-17 16:00:00'),

(16,'Sangre','2026-03-18 08:00:00'),
(17,'Orina','2026-03-18 09:00:00'),
(18,'Rayos X','2026-03-18 10:00:00'),
(19,'Ultrasonido','2026-03-18 11:00:00'),
(20,'Electrocardiograma','2026-03-18 14:00:00'),

(1,'Sangre','2026-03-20 08:00:00'),
(2,'Orina','2026-03-20 09:00:00'),
(3,'Rayos X','2026-03-20 10:00:00'),
(4,'Ultrasonido','2026-03-20 11:00:00'),
(5,'Electrocardiograma','2026-03-20 15:00:00'),

(6,'Sangre','2026-03-22 08:00:00'),
(7,'Orina','2026-03-22 09:00:00'),
(8,'Rayos X','2026-03-22 10:00:00'),
(9,'Ultrasonido','2026-03-22 11:00:00'),
(10,'Electrocardiograma','2026-03-22 16:00:00'),

(11,'Sangre','2026-03-25 08:00:00'),
(12,'Orina','2026-03-25 09:00:00'),
(13,'Rayos X','2026-03-25 10:00:00'),
(14,'Ultrasonido','2026-03-25 11:00:00'),
(15,'Electrocardiograma','2026-03-25 14:00:00'),

(16,'Sangre','2026-03-28 08:00:00'),
(17,'Orina','2026-03-28 09:00:00'),
(18,'Rayos X','2026-03-28 10:00:00'),
(19,'Ultrasonido','2026-03-28 11:00:00'),
(20,'Electrocardiograma','2026-03-30 15:00:00');