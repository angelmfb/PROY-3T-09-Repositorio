USE Palabras;

--
-- Tabla Usuario
--

CREATE TABLE usuario (
  idUsuario SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  correo VARCHAR(100) NOT NULL,
  pw VARCHAR(50) NOT NULL,
  tipo CHAR(1) NOT NULL DEFAULT 'u',
  CHECK (tipo IN ('u', 'a'))
);

--
-- Tabla Actividad
--

CREATE TABLE actividad (
  idActividad INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fechaHora DATETIME NOT NULL,
  nombre VARCHAR(50) NOT NULL
);

--
-- Tabla Categoria
--

CREATE TABLE categoria (
  idCategoria SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
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
  idUsuario SMALLINT UNSIGNED NOT NULL,
  idActividad INT UNSIGNED NOT NULL,
  puntuacion TINYINT UNSIGNED NOT NULL,
  fecha DATETIME NOT NULL,
  PRIMARY KEY (idUsuario, idActividad),
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
  CONSTRAINT fk_actividad FOREIGN KEY (idActividad) REFERENCES actividad (idActividad),
  CONSTRAINT fk_palabra FOREIGN KEY (idPalabra) REFERENCES palabra (idPalabra)
);