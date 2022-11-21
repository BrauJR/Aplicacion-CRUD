/*
SQL: Structure Query Language - Lenguaje Estructurado de Consulta

Base de Datos: Una colección de datos que están organizados.

Gestores o Manejadores de BD son los programas que nos permiten administrar los datos

Ejemplos de Gestores de BD: Microsoft Access, Microsoft SQL Server, Oracle, Informix, DBASE, SQL Lite, PostgreSQL, MySQL

Existen 2 tipos de sentencias SQL:
1) Sentencias Estructurales: Son las que nos premitirán crear, modificar, o eliminar objetos, usuarios, y propiedades de nuestra BD

2) Sentencias de Datos: Son las que nos permitirán insertar, eliminar, modificar y buscar información en nuestra BD

En MySQL existen 2 tipos de engine para tablas:
 1. MyISAM - Tablas planas, son cómo si fuera a trabajar datos en excel
 2. InnoDB - Tablas relacionales, son cómo si fuera a trabajar datos en Access
*/

CREATE DATABASE mis_contactos;
USE mis_contactos;

CREATE TABLE contactos (
    email       VARCHAR(50) NOT NULL,
    nombre      VARCHAR(50) NOT NULL,
    sexo        CHAR(1),
    nacimiento  DATE,
    telefono    VARCHAR(13), 
    pais        VARCHAR(50) NOT NULL,
    imagen      VARCHAR(50),
    PRIMARY KEY(email), 
    FULLTEXT KEY buscador(email, nombre, sexo, telefono, pais)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE pais(
    id_pais     INT NOT NULL AUTO_INCREMENT,
    pais        VARCHAR(50) NOT NULL,
    PRIMARY KEY(id_pais)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO pais (id_pais, pais) VALUES
(1, "México"),
(2, "Colombia"),
(3, "Guatemala"),
(4, "Espala"),
(5, "Brasil"),
(6, "Uruguay"),
(7, "Perú"),
(8, "Argentina"),
(9, "Chile"),
(10, "Paraguay"),
(11, "Honduras"),
(12, "El Salvador"),
(13, "Nicaragua"),
(14, "Costa Rica"),
(15, "Panamá");