DROP DATABASE IF EXISTS Loja_Madeira;
CREATE DATABASE Loja_Madeira;
USE Loja_Madeira;

create table usuarios
(
    id_usuario int unsigned not null auto_increment,
    login_usuario varchar(30) not null unique,
    senha_usuario varchar(40) not null,
    nome_usuario varchar(100) not null,
    primary key (id_usuario)
);

-- #CREATE TABLE Estado (
-- #    Sigla_Est CHAR(2) NOT NULL PRIMARY KEY,
-- #    Nome_Est VARCHAR(50) NOT NULL UNIQUE
-- #);

-- #CREATE TABLE Cidade (
-- #    Cod_Cidade INT NOT NULL PRIMARY KEY,
-- #    Sigla_Est CHAR(2) NOT NULL,
-- #    FOREIGN KEY (Sigla_Est) REFERENCES Estado(Sigla_Est)
-- #);

-- #CREATE TABLE Cliente (
-- #    Cod_Cli INT NOT NULL PRIMARY KEY,
-- #    Cod_Cid INT NOT NULL,
-- #    Nome_Cli VARCHAR(200) NOT NULL,
-- #    Sexo_Cli CHAR(1) NOT NULL CHECK (Sexo_Cli IN ('F','M')),
-- #    FOREIGN KEY (Cod_Cid) REFERENCES Cidade(Cod_Cidade)
-- #);

-- #CREATE TABLE Madeira_Tipo (
-- #    Cod_Tipo INT NOT NULL PRIMARY KEY,
-- #    Nome_Tipo VARCHAR(100) NOT null UNIQUE
-- #);

CREATE TABLE Chapa (
    Cod_Chapa INT NOT NULL PRIMARY KEY auto_increment,
    Nome_Tipo VARCHAR(100) NOT NULL,
    Largura_MM DECIMAL(10,2) NOT NULL,
    Altura_MM DECIMAL(10,2) NOT NULL,
    Espessura DECIMAL(10,2) NOT NULL,
    Quantidade int not null, 
    Valor_Chapa DECIMAL(10,2) NOT NULL
);

CREATE TABLE Peca (
    Cod_Peca INT NOT NULL PRIMARY KEY auto_increment,
    Nome_Peca VARCHAR(100) NOT NULL,
    Largura_MM DECIMAL(10,2) NOT NULL,
    Altura_MM DECIMAL(10,2) NOT NULL,
    Espessura DECIMAL(10,2) NOT NULL
);

CREATE TABLE Producao_Peca (
    Cod_Producao INT NOT NULL PRIMARY KEY,
    Cod_Chapa INT NOT NULL,
    Cod_Peca INT NOT NULL,
    Qtde_Pecas INT NOT NULL CHECK(Qtde_Pecas > 0),
    FOREIGN KEY (Cod_Chapa) REFERENCES Chapa(Cod_Chapa),
    FOREIGN KEY (Cod_Peca) REFERENCES Peca(Cod_Peca)
);


INSERT INTO Chapa VALUES 
 (1, 'Mogno', 2750, 1850, 18, 2, 82.42),
 (2, 'Mogno', 2200, 1600, 15, 2,47.52),
 (3, 'Mogno', 1830, 1220, 15,  2,30.14),
 (4, 'Itaúba', 2750, 1850, 18,  2,50.37),
 (5, 'Itaúba', 2200, 1600, 15,  2,29.04),
 (6, 'Itaúba', 1830, 1220, 15,  2,18.42),
 (7, 'Carvalho', 2750, 1850, 18,  2,54.95),
 (8, 'Carvalho', 2200, 1600, 15,  2,31.68),
 (9, 'Carvalho', 1830, 1220, 15,  2,20.09),
 (10, 'Cedro', 2750, 1850, 18,  2,91.58),
 (11, 'Cedro', 2200, 1600, 15,  2,52.80),
 (12, 'Cedro', 1830, 1220, 15,  2,33.49),
 (13, 'MDF Branco', 2750, 1850, 18,  2,16.48),
 (14, 'MDF Branco', 2200, 1600, 15,  2,9.50),
 (15, 'MDF Branco', 1830, 1220, 15,  2,6.03),
 (16, 'MDP Texturizado', 2750, 1850, 18,  2,18.31),
 (17, 'MDP Texturizado', 2200, 1600, 15,  2,10.56),
 (18, 'MDP Texturizado', 1830, 1220, 15,  2,6.70);


CREATE VIEW view_custo_peca_madeira AS 
SELECT
    mt.Nome_Tipo AS Chapa,
    p.Nome_Peca,
    pp.Qtde_Pecas,
    c.Largura_MM * c.Altura_MM * c.Espessura AS Volume_Chapa_mm3,
    p.Largura_MM * p.Altura_MM * p.Espessura * pp.Qtde_Pecas AS Volume_Total_Peca_mm3,
    ROUND(c.Valor_Chapa / (c.Largura_MM * c.Altura_MM * c.Espessura), 8) AS Preco_mm3,
    ROUND((p.Largura_MM * p.Altura_MM * p.Espessura * pp.Qtde_Pecas) * (c.Valor_Chapa / (c.Largura_MM * c.Altura_MM * c.Espessura)), 2) AS Custo_Total
FROM 
    Producao_Peca pp
JOIN Peca p ON p.Cod_Peca = pp.Cod_Peca
JOIN Chapa c ON c.Cod_Chapa = pp.Cod_Chapa
JOIN Chapa mt ON mt.Cod_Chapa = c.Cod_Chapa;



select * from usuarios;

select * from peca;

select * from chapa;

