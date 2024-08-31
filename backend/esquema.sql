-- Crear la base de datos
CREATE DATABASE control;

-- Seleccionar la base de datos
USE control;

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    Cedula INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Sexo CHAR(1) NOT NULL,
    NumeroTelefono VARCHAR(15),
    Correo VARCHAR(100) UNIQUE NOT NULL,
    Contraseña VARCHAR(255) NOT NULL,
    INT(3) NOT NULL,
    INT(3) NOT NULL
);

-- Tabla Administrador
CREATE TABLE Administrador (
    Cedula INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Correo VARCHAR(100) UNIQUE NOT NULL,
    Contraseña VARCHAR(255) NOT NULL,
    NumeroTelefono VARCHAR(15)
);

-- Tabla Entrenador
CREATE TABLE Entrenador (
    Cedula INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Correo VARCHAR(100) UNIQUE NOT NULL,
    Contraseña VARCHAR(255) NOT NULL,
    NumeroTelefono VARCHAR(15)
);

-- Tabla Membresías
CREATE TABLE Membresias (
    CodigoMembresia INT PRIMARY KEY,
    NombreMembresia VARCHAR(100) NOT NULL,
    TiempoMembresia VARCHAR(50) NOT NULL,
    DescripcionMembresia TEXT
);
