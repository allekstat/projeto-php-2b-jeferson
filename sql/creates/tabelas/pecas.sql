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
