create table cidades
(
    id_cidade int unsigned not null auto_increment,
    estado_cidade char(2) not null,
    primary key (id_cidade),
    foreign key (estado_cidade) references estados (sigla_estado)
);
