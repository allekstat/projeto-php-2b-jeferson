DROP DATABASE IF EXISTS Loja_Madeira;
CREATE DATABASE Loja_Madeira;
USE Loja_Madeira;

CREATE TABLE Estado (
    Sigla_Est CHAR(2) NOT NULL PRIMARY KEY,
    Nome_Est VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Cidade (
    Cod_Cidade INT NOT NULL PRIMARY KEY,
    Sigla_Est CHAR(2) NOT NULL,
    FOREIGN KEY (Sigla_Est) REFERENCES Estado(Sigla_Est)
);

CREATE TABLE Cliente (
    Cod_Cli INT NOT NULL PRIMARY KEY,
    Cod_Cid INT NOT NULL,
    Nome_Cli VARCHAR(200) NOT NULL,
    Sexo_Cli CHAR(1) NOT NULL CHECK (Sexo_Cli IN ('F','M')),
    FOREIGN KEY (Cod_Cid) REFERENCES Cidade(Cod_Cidade)
);

CREATE TABLE Madeira_Tipo (
    Cod_Tipo INT NOT NULL PRIMARY KEY,
    Nome_Tipo VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Chapa (
    Cod_Chapa INT NOT NULL PRIMARY KEY,
    Cod_Tipo INT NOT NULL,
    Largura_MM DECIMAL(10,2) NOT NULL,
    Altura_MM DECIMAL(10,2) NOT NULL,
    Espessura_MM DECIMAL(10,2) NOT NULL,
    Valor_Chapa DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (Cod_Tipo) REFERENCES Madeira_Tipo(Cod_Tipo)
);

CREATE TABLE Peca (
    Cod_Peca INT NOT NULL PRIMARY KEY,
    Nome_Peca VARCHAR(100) NOT NULL,
    Largura_MM DECIMAL(10,2) NOT NULL,
    Altura_MM DECIMAL(10,2) NOT NULL,
    Espessura_MM DECIMAL(10,2) NOT NULL,
    Quantidade INT NOT NULL CHECK (Quantidade > 0),
    Valor_Unitario DECIMAL(10,2) NOT NULL CHECK (Valor_Unitario >= 0)
);

CREATE TABLE Producao_Peca (
    Cod_Producao INT NOT NULL PRIMARY KEY,
    Cod_Chapa INT NOT NULL,
    Cod_Peca INT NOT NULL,
    Qtde_Pecas INT NOT NULL CHECK(Qtde_Pecas > 0),
    FOREIGN KEY (Cod_Chapa) REFERENCES Chapa(Cod_Chapa),
    FOREIGN KEY (Cod_Peca) REFERENCES Peca(Cod_Peca)
);

INSERT INTO Madeira_Tipo VALUES
(1, 'Mogno'),
(2, 'Itaúba'),
(3, 'Carvalho'),
(4, 'Cedro'),
(5, 'Pinus'),
(6, 'Cumaru'),
(7, 'Eucalipto'),
(8, 'Nogueira'),
(9, 'Jequitibá'),
(10, 'Ipê'),
(11, 'Jacarandá'),
(12, 'Jatobá'),
(13, 'Pinho'),
(14, 'MDF Branco'),
(15, 'MDP Texturizado');


INSERT INTO Chapa VALUES 
 (1, 1, 2750, 1850, 18, 82.42),
 (2, 1, 2200, 1600, 15, 47.52),
 (3, 1, 1830, 1220, 15, 30.14),
 (4, 2, 2750, 1850, 18, 50.37),
 (5, 2, 2200, 1600, 15, 29.04),
 (6, 2, 1830, 1220, 15, 18.42),
 (7, 3, 2750, 1850, 18, 54.95),
 (8, 3, 2200, 1600, 15, 31.68),
 (9, 3, 1830, 1220, 15, 20.09),
 (10, 4, 2750, 1850, 18, 91.58),
 (11, 4, 2200, 1600, 15, 52.80),
 (12, 4, 1830, 1220, 15, 33.49),
 (13, 5, 2750, 1850, 18, 22.89),
 (14, 5, 2200, 1600, 15, 13.20),
 (15, 5, 1830, 1220, 15, 8.37),
 (16, 6, 2750, 1850, 18, 64.10),
 (17, 6, 2200, 1600, 15, 36.96),
 (18, 6, 1830, 1220, 15, 23.44),
 (19, 7, 2750, 1850, 18, 18.31),
 (20, 7, 2200, 1600, 15, 10.56),
 (21, 7, 1830, 1220, 15, 6.70),
 (22, 8, 2750, 1850, 18, 45.79),
 (23, 8, 2200, 1600, 15, 26.40),
 (24, 8, 1830, 1220, 15, 16.74),
 (25, 9, 2750, 1850, 18, 54.95),
 (26, 9, 2200, 1600, 15, 31.68),
 (27, 9, 1830, 1220, 15, 20.09),
 (28, 10, 2750, 1850, 18, 68.68),
 (29, 10, 2200, 1600, 15, 39.60),
 (30, 10, 1830, 1220, 15, 25.12),
 (31, 11, 2750, 1850, 18, 41.21),
 (32, 11, 2200, 1600, 15, 23.76),
 (33, 11, 1830, 1220, 15, 15.07),
 (34, 12, 2750, 1850, 18, 54.95),
 (35, 12, 2200, 1600, 15, 31.68),
 (36, 12, 1830, 1220, 15, 20.09),
 (37, 13, 2750, 1850, 18, 32.05),
 (38, 13, 2200, 1600, 15, 18.48),
 (39, 13, 1830, 1220, 15, 11.72),
 (40, 14, 2750, 1850, 18, 16.48),
 (41, 14, 2200, 1600, 15, 9.50),
 (42, 14, 1830, 1220, 15, 6.03),
 (43, 15, 2750, 1850, 18, 18.31),
 (44, 15, 2200, 1600, 15, 10.56),
 (45, 15, 1830, 1220, 15, 6.70);


CREATE VIEW view_custo_peca_madeira AS 
SELECT
    mt.Nome_Tipo AS Madeira,
    p.Nome_Peca,
    pp.Qtde_Pecas,
    c.Largura_MM * c.Altura_MM * c.Espessura_MM AS Volume_Chapa_mm3,
    p.Largura_MM * p.Altura_MM * p.Espessura_MM * pp.Qtde_Pecas AS Volume_Total_Peca_mm3,
    ROUND(c.Valor_Chapa / (c.Largura_MM * c.Altura_MM * c.Espessura_MM), 8) AS Preco_mm3,
    ROUND((p.Largura_MM * p.Altura_MM * p.Espessura_MM * pp.Qtde_Pecas) * (c.Valor_Chapa / (c.Largura_MM * c.Altura_MM * c.Espessura_MM)), 2) AS Custo_Total
FROM 
    Producao_Peca pp
JOIN Peca p ON p.Cod_Peca = pp.Cod_Peca
JOIN Chapa c ON c.Cod_Chapa = pp.Cod_Chapa
JOIN Madeira_Tipo mt ON mt.Cod_Tipo = c.Cod_Tipo;

