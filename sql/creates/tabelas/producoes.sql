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
