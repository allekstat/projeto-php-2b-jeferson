create database sistema_marcenaria;
use sistema_marcenaria;
create table usuarios
(
    id_usuario int unsigned not null auto_increment,
    login_usuario varchar(30) not null,
    senha_usuario char(40) not null,
    primary key (id_usuario)
);
create table estados
(
    sigla_estado char(2) not null,
    nome_estado varchar(20) not null,
    primary key (sigla_estado)
);
create table cidades
(
    id_cidade int unsigned not null auto_increment,
    estado_cidade char(2) not null,
    primary key (id_cidade),
    foreign key (estado_cidade) references estados (sigla_estado)
);
create table clientes
(
    id_cliente int unsigned not null auto_increment,
    nome_cliente varchar(100) not null,
    sexo_cliente char not null,
    cidade_cliente int unsigned not null,
    primary key (id_cliente),
    foreign key (cidade_cliente) references cidades (id_cidade),
    check (sexo_cliente in ('f', 'm'))
);
create table madeiras
(
    id_madeira int unsigned not null auto_increment,
    nome_madeira varchar(100) not null,
    primary key (id_madeira)
);
create table chapas
(
    id_chapa int unsigned not null auto_increment,
    nome_chapa int unsigned not null,
    largura_chapa int unsigned not null,
    altura_chapa int unsigned not null,
    espessura_chapa int unsigned not null,
    quantidade_chapa int unsigned not null,
    valor_chapa int unsigned not null,
    primary key (id_chapa),
    foreign key (madeira_chapa) references madeiras (id_madeira)
);
create table pecas
(
    id_peca int unsigned not null auto_increment,
    nome_peca varchar(100) not null,
    largura_peca int unsigned not null,
    altura_peca int unsigned not null,
    espessura_peca int unsigned not null,
    quantidade_peca int unsigned not null,
    valor_peca int unsigned not null,
    primary key (id_peca)
);
create table producoes
(
    id_producao int unsigned not null auto_increment,
    chapa_producao int unsigned not null,
    peca_producao int unsigned not null,
    quantidade_pecas_producao int unsigned not null,
    primary key (id_producao),
    foreign key (chapa_producao) references chapas (id_chapa),
    foreign key (peca_producao) references pecas (id_peca)
);
insert into madeiras (nome_madeira) values
    ('Mogno'),
    ('Itaúba'),
    ('Carvalho'),
    ('Cedro'),
    ('Pinus'),
    ('Cumaru'),
    ('Eucalipto'),
    ('Nogueira'),
    ('Jequitibá'),
    ('Ipê'),
    ('Jacarandá'),
    ('Jatobá'),
    ('Pinho'),
    ('MDF Branco'),
    ('MDP Texturizado');
insert into chapas (madeira_chapa, largura_chapa, altura_chapa, espessura_chapa, valor_chapa) values
    (1, 2750, 1850, 18, 8242),
    (1, 2200, 1600, 15, 4752),
    (1, 1830, 1220, 15, 3014),
    (2, 2750, 1850, 18, 5037),
    (2, 2200, 1600, 15, 2904),
    (2, 1830, 1220, 15, 1842),
    (3, 2750, 1850, 18, 5495),
    (3, 2200, 1600, 15, 3168),
    (3, 1830, 1220, 15, 2009),
    (4, 2750, 1850, 18, 9158),
    (4, 2200, 1600, 15, 5280),
    (4, 1830, 1220, 15, 3349),
    (5, 2750, 1850, 18, 2289),
    (5, 2200, 1600, 15, 1320),
    (5, 1830, 1220, 15, 837),
    (6, 2750, 1850, 18, 6410),
    (6, 2200, 1600, 15, 3696),
    (6, 1830, 1220, 15, 2344),
    (7, 2750, 1850, 18, 1831),
    (7, 2200, 1600, 15, 1056),
    (7, 1830, 1220, 15, 670),
    (8, 2750, 1850, 18, 4579),
    (8, 2200, 1600, 15, 2640),
    (8, 1830, 1220, 15, 1674),
    (9, 2750, 1850, 18, 5495),
    (9, 2200, 1600, 15, 3168),
    (9, 1830, 1220, 15, 2009),
    (10, 2750, 1850, 18, 6868),
    (10, 2200, 1600, 15, 3960),
    (10, 1830, 1220, 15, 2512),
    (11, 2750, 1850, 18, 4121),
    (11, 2200, 1600, 15, 2376),
    (11, 1830, 1220, 15, 1507),
    (12, 2750, 1850, 18, 5495),
    (12, 2200, 1600, 15, 3168),
    (12, 1830, 1220, 15, 2009),
    (13, 2750, 1850, 18, 3205),
    (13, 2200, 1600, 15, 1848),
    (13, 1830, 1220, 15, 1172),
    (14, 2750, 1850, 18, 1648),
    (14, 2200, 1600, 15, 950),
    (14, 1830, 1220, 15, 603),
    (15, 2750, 1850, 18, 1831),
    (15, 2200, 1600, 15, 1056),
    (15, 1830, 1220, 15, 670);
create view view_custo_peca_madeira as
(
    select md.nome_madeira as MADEIRA,
        pc.nome_peca,
        pd.quantidade_pecas_producao,
        ch.largura_chapa * ch.altura_chapa * ch.espessura_chapa as VOLUME_CHAPA,
        pc.largura_peca * pc.altura_peca * pc.espessura_peca * pd.quantidade_pecas_producao as VOLUME_TOTAL_PECAS,
        round(ch.valor_chapa / (ch.largura_chapa * ch.altura_chapa * ch.espessura_chapa)) as PRECO,
        round((pc.largura_peca * pc.altura_peca * pc.espessura_peca * pd.quantidade_pecas_producao) * (ch.valor_chapa / (ch.largura_chapa * ch.altura_chapa * ch.espessura_chapa))) as CUSTO
    from producoes pd
        inner join pecas pc on pc.id_peca = pd.peca_producao
        inner join chapas ch on ch.id_chapa = pd.chapa_producao
        inner join madeiras md on md.id_madeira = ch.madeira_chapa
);
