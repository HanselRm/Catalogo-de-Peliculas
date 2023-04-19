CREATE DATABASE PFCatalogo;
USE PFCatalogo;


CREATE TABLE Generos
	(
		IdGenero	INT Identity(1,1) PRIMARY KEY,
		Genero		VARCHAR(30) NOT NULL
	);

CREATE TABLE Imagen
	(
		IdImagen	INT Identity(1,1) PRIMARY KEY,
		Ruta		VARCHAR(90) NOT NULL,
		Nombre		VARCHAR(200) NOT NULL
	);

CREATE TABLE Personas
	(
		IdPersona INT Identity(1,1) PRIMARY KEY,
		Nombre	  VARCHAR(40) NOT NULL,
		Apellido  VARCHAR(40) NOT NULL,
		Correo	  VARCHAR(60) NOT NULL,
		Contraseña VARCHAR(60) NOT NULL
	);


CREATE TABLE Peliculas
	(
		IdPelicula INT Identity(1,1) PRIMARY KEY,
		Titulo	   VARCHAR(60) NOT NULL,
		Año		   DATE NOT NULL,
		NombreDirector Varchar(30) NOT NULL,
		ApellidoDirector Varchar(30) NOT NULL,
		IdGenero INT 
			CONSTRAINT IdGenero_FK
			FOREIGN KEY (IdGenero)
			REFERENCES Generos (IdGenero) NOT NULL,
		IdImagen INT 
			CONSTRAINT IdImagen_FK
			FOREIGN KEY (IdImagen)
			REFERENCES Imagen (IdImagen) NOT NULL,
		IdPersona INT 
			CONSTRAINT IdPersona_FK
			FOREIGN KEY (IdPersona)
			REFERENCES Personas (IdPersona) NOT NULL,
	);





	SELECT *
		FROM Generos;
	SELECT *
		FROM Peliculas;
	SELECT *
		FROM Personas;

	SELECT *
		FROM Imagen;

		
		
Drop table Generos;
Drop table Peliculas;
Drop table Personas;
Drop table Imagen;



	INSERT INTO Generos(Genero)
		VALUES ('Terror');

	INSERT INTO Imagen(Ruta, Nombre)
		VALUES ('C:\Imagen','Spiderman')


	INSERT INTO Personas (Nombre, Apellido, Correo, Contraseña)
		VALUES ('Pedro', 'Mejia', 'Pedro@gmail.com', 'Caliso2425.');


