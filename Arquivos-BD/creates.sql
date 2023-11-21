drop table if exists IDADE_PUBLICO, FOTO_EVENTO, ESTADO, CIDADE, BAIRRO, INTUITO, ENDERECO, EVENTO, CLASSIFICACAO, USUARIO, USUARIO_EVENTO, EVENTO_RECORRENTE, RECORRENTE CASCADE;

create table ESTADO(
 id serial primary key,
 nome varchar(2)
);

create table CIDADE(
 id serial primary key,
 nome varchar(30),
 FK_ESTADO_id integer,
 foreign key (FK_ESTADO_id) references ESTADO(id) ON DELETE CASCADE
);

create table BAIRRO(
 id serial primary key,
 nome varchar(30),
 FK_CIDADE_id integer,
 foreign key (FK_CIDADE_id) references CIDADE(id) ON DELETE CASCADE
);

create table INTUITO(
 id serial primary key,
 nome varchar(12)
);

create table CLASSIFICACAO(
 id serial primary key,
 nome varchar(50)
);

create table ENDERECO(
 id serial primary key,
 numero varchar(10),
 cep varchar(9),
 descricao varchar(200),
 FK_BAIRRO_id integer,
 foreign key (FK_BAIRRO_id) references BAIRRO(id) ON DELETE CASCADE
);

create table USUARIO(
 id serial primary key,
 email varchar(100) unique,
 nome varchar(200),
 data_nascimento date,
 token varchar(100),
 foto varchar(500),
 telefone varchar(15),
 FK_INTUITO_id integer,
 foreign key (FK_INTUITO_id) references INTUITO(id) ON DELETE CASCADE
);

create table IDADE_PUBLICO(
 id serial primary key,
 intervalo varchar(15)
);

create table EVENTO(
 id serial primary key,
 descricao varchar(500),
 nome varchar(100),
 data date,
 horario_inicio time,
 horario_fim time,
 min_pessoas integer,
 preco float,
 foto varchar(500),
 max_pessoas integer,
 FK_INTUITO_id integer,
 FK_ENDERECO_id integer,
 FK_USUARIO_id integer,
 FK_IDADE_PUBLICO_id integer,
 FK_CLASSIFICACAO_id integer,
 foreign key (FK_CLASSIFICACAO_id) references CLASSIFICACAO(id),
 foreign key (FK_INTUITO_id) references INTUITO(id),
 foreign key (FK_ENDERECO_id) references ENDERECO(id) ON DELETE CASCADE,
 foreign key (FK_USUARIO_id) references USUARIO(id) ON DELETE CASCADE,
 foreign key (FK_IDADE_PUBLICO_id) references IDADE_PUBLICO(id)
);

create table USUARIO_EVENTO(
 id serial primary key,
 FK_USUARIO_id integer,
 FK_EVENTO_id integer,
 foreign key (FK_USUARIO_id) references USUARIO(id) ON DELETE CASCADE, 
 foreign key (FK_EVENTO_id) references EVENTO(id) ON DELETE CASCADE
);


create table RECORRENTE(
  id serial primary key,
  recorrencia varchar(12)
);

create table EVENTO_RECORRENTE(
  id serial primary key,
  FK_EVENTO_id integer,
  FK_RECORRENTE_id integer,
  foreign key (FK_EVENTO_id) references EVENTO(id) ON DELETE CASCADE,
  foreign key (FK_RECORRENTE_id) references RECORRENTE(id)
);
