CREATE DATABASE bd_procedimientos;

USE bd_procedimientos;

CREATE TABLE alumnos(
    id tinyint,
    nombre varchar(85) NOT NULL,
    repite bit NOT NULL,
    CONSTRAINT PK_ID PRIMARY KEY(id)
);

INSERT INTO alumnos VALUES
    (1, "Sergio", 0),
    (2, "Pablo", 0),
    (3, "Guillermo", 1);
