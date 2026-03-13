-- =========================
-- EMPRESAS (25)
-- =========================
INSERT INTO empresas (nombre, nit, direccion, telefono) VALUES
('Nike Colombia', '900123456-1', 'Calle 12 #34-56, Bogotá', '6012345678'),
('PepsiCo Colombia', '900234567-2', 'Carrera 45 #12-78, Medellín', '6045678901'),
('Coca-Cola FEMSA', '900345678-3', 'Calle 67 #45-12, Cali', '6023456789'),
('Grupo Éxito', '900456789-4', 'Carrera 12 #34-90, Barranquilla', '6056789012'),
('Bavaria S.A.', '900567890-5', 'Calle 100 #56-78, Bucaramanga', '6078901234'),
('Alpina', '900678901-6', 'Carrera 22 #10-45, Pereira', '6067890123'),
('Tecnoglass', '900789012-7', 'Calle 45 #23-67, Barranquilla', '6090123456'),
('Rappi', '900890123-8', 'Carrera 30 #12-34, Bogotá', '6089012345'),
('Servientrega', '900901234-9', 'Calle 80 #15-90, Medellín', '6012340987'),
('Avianca', '901012345-0', 'Carrera 50 #23-78, Bogotá', '6023450987'),
('Postobón', '901123456-1', 'Calle 12 #34-89, Medellín', '6034567890'),
('Ecopetrol', '901234567-2', 'Carrera 40 #12-56, Bogotá', '6045671234'),
('Grupo Nutresa', '901345678-3', 'Calle 70 #45-12, Medellín', '6056782345'),
('Colpatria', '901456789-4', 'Carrera 22 #34-78, Bogotá', '6067893456'),
('Alsea Colombia', '901567890-5', 'Calle 35 #12-90, Bogotá', '6078904567'),
('Carvajal S.A.', '901678901-6', 'Carrera 10 #45-12, Cali', '6089015678'),
('Postobón Bottling', '901789012-7', 'Calle 90 #34-56, Medellín', '6090126789'),
('Grupo Sura', '901890123-8', 'Carrera 23 #12-45, Medellín', '6012347890'),
('Terpel', '901901234-9', 'Calle 15 #34-78, Bogotá', '6023458901'),
('Almacenes La 14', '902012345-0', 'Carrera 50 #23-90, Cali', '6034569012'),
('Carulla', '902123456-1', 'Calle 60 #12-34, Bogotá', '6045670123'),
('D1', '902234567-2', 'Carrera 80 #45-12, Bogotá', '6056781234'),
('Homecenter', '902345678-3', 'Calle 10 #23-56, Medellín', '6067892345'),
('Falabella', '902456789-4', 'Carrera 12 #34-78, Bogotá', '6078903456'),
('Éxito Express', '902567890-5', 'Calle 20 #45-12, Cali', '6089014567');

-- =========================
-- PACIENTES (40)
-- =========================
INSERT INTO pacientes 
(empresa_id, nombre_completo, tipo_documento, numero_documento, direccion, telefono, celular, fecha_nacimiento, edad, eps, contacto_emergencia, parentesco)
VALUES
(1,'Juan Camilo Pérez','CC','1032456781','Calle 45 #23-12, Bogotá','6014567890','3102456781','1970-04-12',56,'Sura','María Pérez','Esposa'),
(3,'María Fernanda Rodríguez','CC','1019876543','Carrera 32 #15-90, Medellín','6046782345','3114567892','1965-08-21',60,'Sanitas','Carlos Rodríguez','Padre'),
(5,'Carlos Andrés Gómez','CC','1024567832','Calle 70 #44-22, Cali','6023459876','3127894561','1980-02-10',46,'Nueva EPS','Lucía Gómez','Madre'),
(2,'Ana Sofía Martínez','CC','1098765432','Carrera 18 #22-56, Bogotá','6013456789','3136782345','1995-11-05',30,'Sura','Pedro Martínez','Padre'),
(7,'Luis Fernando Hernández','CC','1045678934','Calle 12 #8-30, Barranquilla','6052345678','3149876543','1975-06-17',51,'Sanitas','Laura Hernández','Esposa'),
(6,'Sofía Torres Díaz','CC','1013456789','Carrera 44 #78-12, Pereira','6065678901','3151239876','1998-09-13',27,'Coomeva','Jorge Torres','Padre'),
(9,'Diego Alejandro Ramírez','CC','1076543210','Calle 90 #12-45, Santa Marta','6053456789','3162345678','1987-12-09',38,'Sura','Carolina Ramírez','Madre'),
(4,'Valentina Ríos López','CC','1009876543','Carrera 15 #45-22, Barranquilla','6057890123','3173456789','1993-01-24',32,'Compensar','Luis Ríos','Padre'),
(10,'Javier Morales Ruiz','CC','1034567812','Calle 55 #66-10, Bogotá','6012349876','3184567890','1984-03-15',42,'Nueva EPS','Paula Morales','Hermana'),
(8,'Laura Castro Jiménez','CC','1023456789','Carrera 72 #15-40, Bogotá','6018765432','3195678901','1958-07-11',67,'Sura','Miguel Castro','Padre'),

(12,'Andrés Felipe Jiménez','CC','1043219876','Calle 33 #22-78, Bogotá','6015678901','3106547890','1985-10-05',40,'Sanitas','Carolina Jiménez','Esposa'),
(14,'Camila Vargas Torres','CC','1087654321','Carrera 12 #65-43, Medellín','6042345678','3118765432','1992-05-14',33,'Sura','Daniel Vargas','Padre'),
(11,'Fernando Castillo Mora','CC','1012233445','Calle 88 #11-67, Cali','6025678901','3122345678','1972-04-28',54,'Nueva EPS','Mónica Castillo','Esposa'),
(13,'Natalia Salazar Gómez','CC','1029988776','Carrera 44 #21-78, Medellín','6047890123','3137654321','1994-09-10',31,'Sura','Andrés Salazar','Hermano'),
(16,'Andrés Torres Medina','CC','1055566677','Calle 60 #34-20, Bucaramanga','6074567890','3148765432','1988-12-01',37,'Sanitas','Sandra Torres','Esposa'),
(15,'Sara Medina Rojas','CC','1033344556','Carrera 28 #19-50, Pereira','6062345678','3154567890','1996-01-22',29,'Compensar','Oscar Medina','Padre'),
(17,'Santiago Herrera Díaz','CC','1066677889','Calle 23 #45-76, Cartagena','6058765432','3169876543','1987-05-18',38,'Sura','Lucía Herrera','Madre'),
(18,'Isabella Ruiz Castro','CC','1044499887','Carrera 55 #32-90, Manizales','6085678901','3171234567','1963-02-09',63,'Nueva EPS','Mateo Ruiz','Padre'),
(20,'Sebastián Ortiz Lara','CC','1015544332','Calle 45 #90-22, Bogotá','6013459876','3188765432','1983-07-30',42,'Sanitas','Ana Ortiz','Hermana'),
(19,'Valeria Mendoza Díaz','CC','1099123456','Carrera 88 #21-67, Cali','6027890123','3192345678','1955-11-03',70,'Sura','Luis Mendoza','Padre'),

(21,'Daniel Pardo Vega','CC','1037778899','Calle 30 #14-22, Bogotá','6012343456','3105678901','1989-08-11',36,'Coomeva','Patricia Vega','Madre'),
(22,'Paula Guerrero Silva','CC','1048889900','Carrera 10 #55-19, Medellín','6043456789','3116789012','1993-06-29',32,'Sura','Alberto Guerrero','Padre'),
(23,'Miguel Ángel León','CC','1071122334','Calle 70 #33-14, Cali','6022345678','3128901234','1984-10-19',41,'Nueva EPS','Sandra León','Esposa'),
(24,'Luisa Fernanda Mora','CC','1053344556','Carrera 18 #45-87, Bogotá','6017890123','3139012345','1971-12-17',54,'Compensar','Carlos Mora','Padre'),
(25,'Esteban Parra López','CC','1067788991','Calle 90 #12-33, Medellín','6045672345','3140123456','1986-03-09',39,'Sura','María López','Madre'),
(3,'Natalia Gómez Peña','CC','1082233445','Carrera 34 #78-44, Cali','6026789012','3151234567','1992-09-01',33,'Sanitas','Luis Peña','Padre'),
(6,'Kevin Suárez Castro','CC','1093344556','Calle 12 #98-23, Pereira','6063456789','3162345679','1999-05-05',26,'Nueva EPS','Rosa Castro','Madre'),
(5,'Juliana Castaño Ríos','CC','1026677889','Carrera 66 #32-11, Medellín','6044567890','3173456781','1994-04-14',31,'Sura','Pedro Castaño','Padre'),
(8,'Felipe Quintero Díaz','CC','1035566778','Calle 45 #76-33, Bogotá','6016547890','3184567892','1959-11-22',66,'Compensar','Ana Díaz','Esposa'),
(9,'Daniela Vargas Herrera','CC','1049988776','Carrera 22 #90-45, Santa Marta','6056789012','3195678903','1996-07-07',29,'Sanitas','Carlos Vargas','Padre'),

(11,'Jorge Lozano Castro','CC','1062233445','Calle 70 #34-55, Bogotá','6012348901','3109871234','1983-02-18',43,'Sura','María Castro','Esposa'),
(12,'Karen Pineda Torres','CC','1087766554','Carrera 19 #56-23, Medellín','6044561234','3113456789','1955-06-12',70,'Nueva EPS','Pedro Torres','Padre'),
(13,'Oscar Delgado Ríos','CC','1025566778','Calle 40 #12-88, Cali','6024567890','3126543210','1981-09-30',44,'Sanitas','Claudia Ríos','Esposa'),
(14,'Tatiana Beltrán Díaz','CC','1096655443','Carrera 33 #44-90, Bogotá','6017894561','3139876541','1993-03-11',32,'Sura','Luis Beltrán','Padre'),
(15,'Ricardo Acosta Vega','CC','1045544332','Calle 60 #78-21, Bucaramanga','6075678901','3143210987','1970-12-24',55,'Compensar','Patricia Vega','Esposa'),
(16,'Adriana León Suárez','CC','1039988776','Carrera 21 #19-45, Pereira','6066789012','3156543219','1992-08-02',33,'Nueva EPS','Jorge Suárez','Padre'),
(17,'Cristian Méndez Lara','CC','1074455667','Calle 22 #67-90, Cartagena','6053456123','3167894321','1989-04-16',37,'Sura','Paula Méndez','Madre'),
(18,'Manuela Cabrera Ortiz','CC','1056677889','Carrera 66 #12-44, Manizales','6084567891','3178901234','1955-10-21',70,'Sanitas','Carlos Cabrera','Padre'),
(19,'Héctor Pardo Silva','CC','1017788990','Calle 80 #45-23, Bogotá','6012347788','3189012345','1968-01-03',58,'Nueva EPS','Laura Silva','Esposa'),
(20,'Daniel Rangel Torres','CC','1083344552','Carrera 50 #34-21, Cali','6023456781','3190123456','1991-05-28',34,'Sura','Pedro Rangel','Padre');

-- =========================
-- CITAS (35)
-- =========================
INSERT INTO citas (paciente_id, tipo_examen, fecha_cita) VALUES
(3,'Sangre','2026-03-01 08:00:00'),
(12,'Orina','2026-03-02 14:00:00'),
(7,'Rayos X','2026-03-03 09:00:00'),
(15,'Ultrasonido','2026-03-04 16:00:00'),
(21,'Electrocardiograma','2026-03-05 11:00:00'),

(8,'Orina','2026-03-06 13:00:00'),
(2,'Sangre','2026-03-07 10:00:00'),
(19,'Rayos X','2026-03-08 15:00:00'),
(11,'Electrocardiograma','2026-03-09 09:00:00'),
(26,'Ultrasonido','2026-03-10 17:00:00'),

(5,'Sangre','2026-03-11 08:00:00'),
(17,'Orina','2026-03-12 14:00:00'),
(1,'Rayos X','2026-03-13 11:00:00'),
(29,'Ultrasonido','2026-03-14 16:00:00'),
(33,'Electrocardiograma','2026-03-15 10:00:00'),

(10,'Orina','2026-03-16 13:00:00'),
(14,'Sangre','2026-03-17 09:00:00'),
(6,'Rayos X','2026-03-18 15:00:00'),
(23,'Ultrasonido','2026-03-19 12:00:00'),
(37,'Electrocardiograma','2026-03-20 17:00:00'),

(4,'Sangre','2026-03-21 08:00:00'),
(16,'Orina','2026-03-22 14:00:00'),
(9,'Rayos X','2026-03-23 11:00:00'),
(28,'Ultrasonido','2026-03-24 16:00:00'),
(35,'Electrocardiograma','2026-03-25 09:00:00'),

(22,'Sangre','2026-03-26 13:00:00'),
(31,'Orina','2026-03-27 10:00:00'),
(13,'Rayos X','2026-03-28 15:00:00'),
(24,'Ultrasonido','2026-03-29 12:00:00'),
(18,'Electrocardiograma','2026-03-30 17:00:00'),

(30,'Sangre','2026-03-02 08:00:00'),
(27,'Orina','2026-03-05 15:00:00'),
(34,'Rayos X','2026-03-09 12:00:00'),
(20,'Ultrasonido','2026-03-18 10:00:00'),
(38,'Electrocardiograma','2026-03-24 14:00:00');