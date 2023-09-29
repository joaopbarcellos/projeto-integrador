drop table if exists ESTADO, CIDADE, BAIRRO, TIPO_LOGRADOURO, INTUITO, ENDERECO, EVENTO, HORARIO_FIM, CLASSIFICACAO, EVENTO_CLASSIFICACAO, USUARIO, USUARIO_EVENTO, USUARIO_USUARIO;

    create table ESTADO(
     id serial primary key,
     nome varchar(2)
    );

    create table CIDADE(
     id serial primary key,
     nome varchar(30),
     FK_ESTADO_id integer,
     foreign key (FK_ESTADO_id) references ESTADO(id)
    );

    create table BAIRRO(
     id serial primary key,
     nome varchar(30),
     FK_CIDADE_id integer,
     foreign key (FK_CIDADE_id) references CIDADE(id)
    );

    create table TIPO_LOGRADOURO(
     id serial primary key,
     tipo varchar(30)
    );

    create table INTUITO(
     id serial primary key,
     nome varchar(12)
    );

    create table ENDERECO(
     id serial primary key,
     numero integer,
     cep integer,
     descricao varchar(200),
     FK_TIPO_LOGRADOURO_id integer,
     FK_BAIRRO_id integer,
     foreign key (FK_TIPO_LOGRADOURO_id) references TIPO_LOGRADOURO(id),
     foreign key (FK_BAIRRO_id) references BAIRRO(id)
    );


    create table USUARIO(
     id serial primary key,
     email varchar(100) unique,
     nome varchar(200),
     data_nascimento date,
     token varchar(100),
     foto varchar(500),
     telefone varchar(12),
     FK_INTUITO_id integer,
     FK_ENDERECO_id integer,
     foreign key (FK_INTUITO_id) references INTUITO(id),
     foreign key (FK_ENDERECO_id) references ENDERECO(id)
    );

    create table EVENTO(
     id serial primary key,
     descricao varchar(300),
     nome varchar(100),
     foto varchar(500),
     data date,
     FK_USUARIO_telefone varchar(12),
     min_pessoas integer,
     preco float,
     horario_inicio time,
     max_pessoas integer,
     FK_INTUITO_id integer,
     FK_ENDERECO_id integer,
     FK_USUARIO_id integer,
     foreign key (FK_USUARIO_telefone) references USUARIO(telefone),
     foreign key (FK_INTUITO_id) references INTUITO(id),
     foreign key (FK_ENDERECO_id) references ENDERECO(id),
     foreign key (FK_USUARIO_id) references USUARIO(id)
    );

    create table HORARIO_FIM(
     id serial primary key,
     horario time,
     FK_EVENTO_id integer,
     foreign key (FK_EVENTO_id) references EVENTO(id)
    );

    create table CLASSIFICACAO(
     id serial primary key,
     nome varchar(50)
    );

    create table EVENTO_CLASSIFICACAO(
     id serial primary key,
     FK_EVENTO_id integer,
     FK_CLASSIFICACAO_id integer,
     foreign key (FK_EVENTO_id) references EVENTO(id),
     foreign key (FK_CLASSIFICACAO_id) references CLASSIFICACAO(id)
    );

    create table USUARIO_EVENTO(
     id serial primary key,
     data_inscricao date,
     FK_USUARIO_id integer,
     FK_EVENTO_id integer,
     foreign key (FK_USUARIO_id) references USUARIO(id), 
     foreign key (FK_EVENTO_id) references EVENTO(id)
    );

    create table USUARIO_USUARIO(
     id serial primary key,
     FK_USUARIO_PAI_id integer,
     FK_USUARIO_FILHO_id integer,
     foreign key (FK_USUARIO_PAI_id) references USUARIO(id),
     foreign key (FK_USUARIO_FILHO_id) references USUARIO(id)
    );
