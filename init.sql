insert mydb.estadoevento (idEstadoEvento, DatalleEstadoEve)
values (1, "Abierto"), (2, "Cerrado"), (3, "Suspendido"), (4, "Finalizado");

insert mydb.estadopublicacion (idEstadoPublicacion, DetalleEstadoPub)
values (1, "Abierta"), (2, "Cerrada"), (3, "Finalizada"), (4, "Deshabilitada");

insert mydb.estadopostulacion (idEstadoPostulacion, DetalleEstadoPos)
values (1, "En proceso"), (2, "En contacto"), (3, "Rechazado"), (4, "Finalizado");

insert mydb.jornada (idJornada, DescripcionJornada)
values (1, "FullTime"), (2, "PartTime");

insert mydb.modalidad (idModalidad, DescripcionModalidad)
values (1, "Presencial"), (2, "HomeOffice"), (3, "Hibrido");

insert mydb.habilidad (idHabilidad, Descripcion, Nivel_Grado)
values (1, "Ingles", "Principiante"), (2, "Ingles", "Intermedio"), (3, "Ingles", "Avanzado"),
(4, "Programacion Frondent", "Trainee"), (5, "Programacion Backend", "Trainee"), (6, "Base de datos", "Trainee"),
(7, "Programacion Fullstack", "Trainee"), (8, "Seguridad Informatica", "Trainee");

insert mydb.carrera (NombreCarrera)
values ("Desarrollo de Software"), ("Logistica"), ("Despachante de Aduana");

insert mydb.materia (NombreMateria, DetalleMateria)
values ("introduccion Software", "Inicial de Software 1° Año"), ("Base de Datos I", "Introduccion a SQL"), ("Matematica I", "Introduccion a Matematica Universitaria"),
("Ingles I", "Nivelacion inicial de Ingles"), ("Ingenieria de Software", "Introduccion a la Ingenieria (2° Año de Software)"),
("Estructura de Datos y Algoritmo", "Logica de la Programacion");

insert mydb.usuario (NombreUsuario, Clave, Mail, Telefono, Direccion)
values ("eperez", "River123", "Enzocarp@gmail.com", "1523432112", "Lamadrid 123"), 
("mtorres", "Boca123", "mariobo@gmail.com", "1523432114", "French 912"),
("ggomez", "Clave123", "ggomez@gmail.com", "1523476890", "9 de Julio 5674");

insert mydb.administradoruniversidad (FK_idUsuario, NombreUniversidad, CUIT_Universidad, ResponsableUniversidad)
values (3, "Universidad Provincial de Ezeiza", "30-1234-1221-3", "Mario Torres");

insert mydb.empresa (FK_idUsuario, RazonSocial, CUIT)
values (4, "Coca-Cola", "30-12411231-2");

insert mydb.planestudio (FK_idCarrera, NombrePlanEstudio)
values (1, "Plan 2016 Desarrollo de Software"),
(1, "Plan 2020 Desarrollo de Software"),
(2, "Plan 2016 Logistica"),
(2, "Plan 2020 Logistica"),
(3, "Plan 2016 Despacho de Aduana"),
(3, "Plan 2020 Despacho de Aduana");