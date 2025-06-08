create table usuarios
(
    id_usuario int unsigned not null auto_increment,
    login_usuario varchar(30) not null,
    senha_usuario char(40) not null,
    primary key (id_usuario)
);
