# CRUD_PDO
Projeto de cadastro de Usuário com PHP Orientado a Objetos
Criar o seguinte banco de dados no phpmyadmin:
CREATE DATABASE CRUDPDO;

USE CRUDPO;

CREATE TABLE PESSOA(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40),
    telefone VARCHAR(20),
    email VARCHAR(40)
 );
