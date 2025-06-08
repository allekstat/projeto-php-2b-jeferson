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
