USE Palabras;

--
-- Tabla Usuario
--

CREATE TABLE usuario (
  idUsuario SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  correo VARCHAR(100) NOT NULL,
  pw VARCHAR(50) NOT NULL,
  tipo CHAR(1) NOT NULL DEFAULT 'u'
  CHECK (tipo IN ('u', 'a'))
);

--
-- Tabla Categoria
--

CREATE TABLE categoria (
  idCategoria SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

--
-- Tabla Actividad
--

CREATE TABLE actividad (
  idActividad INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fechaHora DATETIME NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  idCategoria SMALLINT UNSIGNED NOT NULL,
  CONSTRAINT fk_actividad_categoria FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria)
);

--
-- Tabla Palabra
--

CREATE TABLE palabra (
  idPalabra SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ingles VARCHAR(50) NOT NULL,
  español VARCHAR(50) NOT NULL,
  idCategoria SMALLINT UNSIGNED NOT NULL,
  CONSTRAINT fk_categoria FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria)
);

--
-- Tabla Realiza
--

CREATE TABLE realiza (
  idRealiza SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idUsuario SMALLINT UNSIGNED NOT NULL,
  idActividad INT UNSIGNED NOT NULL,
  puntuacion TINYINT UNSIGNED NOT NULL,
  fecha DATETIME NOT NULL,
  CONSTRAINT fk_usuario FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario),
  CONSTRAINT fk_actividad FOREIGN KEY (idActividad) REFERENCES actividad (idActividad)
);

--
-- Tabla Aparece
--

CREATE TABLE aparece (
  idActividad INT UNSIGNED NOT NULL,
  idPalabra SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (idActividad, idPalabra),
  CONSTRAINT fk_actividad2 FOREIGN KEY (idActividad) REFERENCES actividad (idActividad),
  CONSTRAINT fk_palabra2 FOREIGN KEY (idPalabra) REFERENCES palabra (idPalabra)
);


--
-- Insercción
--

Insert into usuario (nombre, correo, pw, tipo) 
values ('admin', 'admin@gmail.com', 1234, 'a'),
        ('juan', 'juan@gmail.com', 1234, 'u');

Insert into categoria (nombre) values ('animales'),
('colores'),
('deportes');

Insert into palabra (ingles,español,idCategoria) values ('dog','perro',1),
('cat','gato',1),
('bird','pajaro',1),
('horse','caballo',1),
('cow','vaca',1),
('sheep','oveja',1),
('pig','cerdo',1),  
('rabbit','conejo',1),
('fish','pez',1),
('jiraf','jirafa',1),
('red','rojo',2),
('blue','azul',2),
('green','verde',2),
('yellow','amarillo',2),
('orange','naranja',2),
('purple','morado',2),
('brown','marron',2),
('black','negro',2),
('pink','rosa',2),
('white','blanco',2),
('football','futbol',3),
('basketball','baloncesto',3),
('tennis','tenis',3),
('boxing','boxeo',3),
('swimming','natacion',3),
('golf','golf',3),
('hiking','senderismo',3),
('karate','karate',3),
('baseball','beisbol',3),
('hunting','caza',3);
