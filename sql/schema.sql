-- Script MySQL para cafeteria_pit
CREATE DATABASE IF NOT EXISTS cafeteria_pit;
USE cafeteria_pit;

CREATE TABLE clientes (
 id_cliente INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE,
 telefone VARCHAR(20),
 cpf VARCHAR(14) UNIQUE,
 endereco VARCHAR(160),
 cidade VARCHAR(100),
 uf CHAR(2),
 cep VARCHAR(9)
);
CREATE TABLE produtos (
 id_produto INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(120) NOT NULL,
 categoria VARCHAR(60),
 preco DECIMAL(10,2) NOT NULL,
 estoque INT NOT NULL DEFAULT 0,
 ativo TINYINT(1) NOT NULL DEFAULT 1
);