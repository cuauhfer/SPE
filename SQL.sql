create table Usuario(
	codigo int primary key,
	nivel int not null,
	username varchar (30) not null,
	password varchar (30) not null
);

create table Persona(
	codigo int primary key,
	nombre varchar (40) not null,
	apellidoM varchar (20) not null,
	apellidoP varchar (20) not null,
	email varchar (50) not null,
	telefono varchar (15) not null, 
	division varchar (40) not null,
	escolaridad varchar (40) not null,
	foreign key(codigo) references Usuario(codigo)
);

create table LineaInn(
	id int primary key AUTO_INCREMENT,
	nombre varchar (50) not null,
	campo varchar (40) not null,
	codigoPersona int not null,
	borrador boolean,
	foreign key(codigoPersona) references Persona(codigo)
);

create table Estadia(
	id int primary key AUTO_INCREMENT,
	nombreEmpresa varchar (50) not null,
	codigoPersona int not null,
	borrador boolean,
	descripcion varchar (300),
	foreign key(codigoPersona) references Persona(codigo)
);

create table DireccionInd(
	id int primary key AUTO_INCREMENT,
	fecha date,
	nombreEmpresa varchar (50) not null,
	nombreProyecto varchar (50) not null,
	codigoPersona int not null,
	borrador boolean,
	descripcion varchar (300),
	foreign key(codigoPersona) references Persona(codigo)
);

create table Alumno(
	idAlumno int primary key AUTO_INCREMENT,
	nombreAlumno varchar (50),
	apellidoP varchar (30),
	apellidoM varchar (30),
	carrera varchar (40)
);

create table AlumnoDireccion(
	idAlumno int not null,
	idDireccion int not null,
	foreign key(idAlumno) references Alumno(idAlumno),
	foreign key(idDireccion) references DireccionInd(id)
);

create table AlumnoEstadia(
	idAlumno int not null,
	idEstadia int not null,
	foreign key(idAlumno) references Alumno(idAlumno),
	foreign key(idEstadia) references Estadia(id)
);

create table Proyecto(
	id int primary key AUTO_INCREMENT,
	nombre varchar (50) not null,
	fechaInicio date,
	fechaFin date,
	institucion varchar (40),
	borrador boolean,
	aprobacion boolean,
	rechazo boolean,
	descripcion varchar (300),
	autor int not null,
	foreign key(autor) references Persona(codigo)
);

create table PersonaProyecto(
	codigoPersona int not null,
	idProyecto int not null,
	foreign key(codigoPersona) references Persona(codigo),
	foreign key(idProyecto) references Proyecto(id)
);

create table Produccion(
	id int primary key AUTO_INCREMENT,
	nombre varchar (40) not null,
	autor int not null,
	fecha date,
	borrador boolean,
	aprobacion boolean,
	tipoPublicacion int not null,
	rechazo boolean,
	descripcion varchar (300),
	foreign key(autor) references Persona(codigo)
);

create table PersonaProduccion(
	codigoPersona int not null,
	idProduccion int not null,
	foreign key(codigoPersona) references Persona(codigo),
	foreign key(idProduccion) references Produccion(id)
);

create table Articulo(
	id int primary key AUTO_INCREMENT,
	revista varchar (50) not null,
	paginas varchar (40),
	linea int not null,
	issn varchar (30) not null,
	idProduccion int not null,
	tipoArticulo varchar (50) not null,
	foreign key(idProduccion) references Produccion(id),
	foreign key(linea) references LineaInn(id)
);

create table InformeTec(
	id int primary key AUTO_INCREMENT,
	dependencia varchar(40) not null,
	idProduccion int not null,
	foreign key(idProduccion) references Produccion(id)
);

create table Manual(
	id int primary key AUTO_INCREMENT,
	registro varchar(40) not null,
	idProduccion int not null,
	tipoManual varchar (50) not null,
	foreign key(idProduccion) references Produccion(id)
);

create table Libro(
	id int primary key AUTO_INCREMENT,
	paginas varchar (40),
	editorial varchar(50) not null,
	linea int not null,
	isbn varchar (30) not null,
	idProduccion int not null,
	tipoLibro varchar (50) not null,
	foreign key(idProduccion) references Produccion(id),
	foreign key(linea) references LineaInn(id)
);

create table Log(
	id int primary key AUTO_INCREMENT,
	codigoUsuario int not null,
	actividad varchar (100),
	fecha datetime,
	foreign key (codigoUsuario) references Usuario(codigo)
);