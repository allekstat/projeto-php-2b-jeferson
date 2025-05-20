drop database if exists Loja_Madeira;
create database Loja_Madeira;
use Loja_Madeira;

create table estado( 
    Sigla_Est char (2) not null primary key,
    Nome_Est varchar(50) not null unique
);

create table cidade (
    Cod_Cidade int not null primary key,
    Sigla_est char(2) not null,
    constraint fk_cid foreign key(sigla_est) references Estado(Sigla_Est)
);

create table cliente (
    Cod_cli int not null primary key,
    Cod_cid int not null,
    Nome_cli varchar(200) not null,
    Sexo_cli char(1) not null check (Sexo_cli in ('F','M')),
    foreign key(Cod_cid) references Cidade (Cod_cidade)
);

create table madeira (
    Cod_mad int not null primary key,
    Nome_mad varchar(100) not null unique,
    Area_chapa_m2 decimal(10,4) not null,
    Valor_chapa decimal(10,2) not null
);

create table peca (
    Cod_peca int not null primary key,
    Nome_peca varchar (100) not null,
    Largura_MM decimal (10,2) not null,
    Altura_MM decimal(10,2) not null,
    Quantidade int not null check (Quantidade > 0),
    Valor_Unitario decimal (10,2) not null check (Valor_Unitario >= 0)
);

insert into Madeira values
(1, 'Mogno', 1.65, 400.00),
(2, 'Itaúba', 5.09, 451.90),
(3, 'Carvalho Americano', 5.09, 455.90),
(4, 'Cedro', 4.40, 800.38),
(5, 'Pinus', 3.52, 148.90),
(6, 'Cumaru', 5.06, 510.96),
(7, 'Eucalipto', 5.03, 169.11),
(8, 'Nogueira', 5.09, 409.99),
(9, 'Jequitibá', 5.09, 455.90),
(10, 'Ipê', 5.09, 473.90),
(11, 'Jacarandá', 5.09, 362.05),
(12, 'Jatobá', 5.09, 455.90),
(13, 'Pinho Cuiabano', 4.00, 223.69),
(14, 'MDF Branco', 5.09, 239.90),
(15, 'MDP', 5.06, 247.31);

create table Producao_peca (
    Cod_Producao int not null primary key,
    Cod_mad int not null,
    Cod_peca int not null,
    Qtde_pecas int not null check(Qtde_pecas > 0),
    foreign key(Cod_peca) references peca(Cod_peca),
    foreign key(Cod_mad) references Madeira(Cod_mad)
);

create view view_custo_peca_madeira as 
select
    m.Nome_mad,
    p.Nome_Peca,
    pr.Qtde_Pecas,
    (p.Largura_MM / 1000) * (p.Altura_MM / 1000) * pr.Qtde_Pecas AS Area_Total_M2,
    m.Valor_Chapa / m.Area_Chapa_M2 AS Preco_M2,
    ROUND(((p.Largura_MM / 1000) * (p.Altura_MM / 1000) * pr.Qtde_Pecas) * (m.Valor_Chapa / m.Area_Chapa_M2), 2) AS Custo_Total
from 
    Producao_Peca pr
join
    Peca p ON pr.Cod_Peca = p.Cod_Peca
join
    Madeira m ON pr.Cod_Mad = m.Cod_Mad;