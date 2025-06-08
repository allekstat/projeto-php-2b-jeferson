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
    madeira_chapa int unsigned not null,
    largura_chapa int unsigned not null,
    altura_chapa int unsigned not null,
    espessura_chapa int unsigned not null,
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
