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
