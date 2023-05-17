# TRABALHO DE PI:  Time In
Trabalho de desenvolvimento de software realizado no ano de 2023

# Sumário

### 1. COMPONENTES<br>
Integrantes do grupo<br>
Fellipy Silva: fellipywagmacker123@gmail.com<br> 
Gustavo Caetano: gustavo.gustavovat@gmail.com<br>
João Pedro Barcellos: jpzbarcellos@gmail.com<br>
Pedro Ramos: pedro05042006@gmail.com<br>

### 2. MINIMUNDO<br>
> Você já teve dificuldade em encontrar pessoas para praticar esportes? Conseguiu marcar um local para realizar a prática?  
Nosso sistema tem o objetivo de facilitar o contato entre pessoas que querem praticar esportes e tem dificuldade de encontrar outros esportistas. Buscamos permitir aos usuários organizar e participar de eventos esportivos através de um sistema web e mobile. 
No sistema, existirão informações de usuários e eventos. Dos usuários são armazenadas as informações de nome completo, cpf, email, idade. Dos eventos serão armazenados a localização, imagem do local, horário, quantidade de vagas, custo e outras informações que se mostrarem pertinentes. Da localização, serão armazenadas a cidade, o bairro, a rua.
 
### 3. PMC<br>
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/b48af196-75ed-44ba-b167-4ce31d74e1c4)
<br>

#### 3.1. EAP - Estrutura Analítica do Projeto
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/f23ff293-beab-4d88-ad96-2ec319b46cb6)
<br>
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/d05e50be-843e-4044-8913-4f689da40c06)
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/70c65b2a-0d04-4bd7-b174-64010cebbaa2)
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/033061a0-ebff-4b24-8067-6e10e68e592f)
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/1e570287-23b5-4278-ab37-403e312297e0)
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/38c0e1ba-dc70-4813-9f52-6476a218d5ab)
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/514e3cfe-65c5-46ad-82fb-656067e9c675)
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/5dea9f2b-fa05-4558-bf82-b8f9eb7d55b4)


#### 3.2. Requisitos funcionais e não funcionais
a) <br> 
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/62cddfc3-05be-4316-9414-908efaddf95a) <br>
b) <br>
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/d385892d-add3-4650-8d31-951c689be891) <br>
c) <br>
![image](https://github.com/jpzb/projeto-integrador/assets/91470894/73f1ea7c-7315-48f7-a79a-c8ea85c30435) <br>

#### 3.3 Validação da Ideia.
a) [Link do formulário desenvolvido](https://forms.gle/joFpcFsEGCkWMErW7) <br>
b) [Link para Relatório/Apresentação de resultados obtidos](https://docs.google.com/presentation/d/1fz1FTr4W_PyjrZAZudigT8LeLHav8KxwQgftTyCD5IA/edit?usp=sharing)

### 4. Personas e Histórias de usuário<br>
Não foi desenvolvido.
<br>


### 5. PROTÓTIPOS DO SISTEMA<br>
#### 5.1 PROTÓTIPO DO SISTEMA MOBILE
a) [Link para teste do protótipo](https://quant-ux.com/#/test.html?h=a2aa10aNp1hKiT3NPSm7Au7sejqNeysKYczM42YiQPKrwnMVZneAe4zybf1a&ln=en) <br>
b) [Link da visão geral das telas](https://quant-ux.com/#/share.html?h=a2aa10aNp1hKiT3NPSm7Au7sejqNeysKYczM42YiQPKrwnMVZneAe4zybf1a) <br>
c) [Link para edição das telas](https://quant-ux.com/#/apps/641ae83c05d7232656948b97/design/s10061_93161.html) <br>

#### 5.2 PROTÓTIPO DO SISTEMA WEB

#### 5.3 QUAIS PERGUNTAS PODEM SER RESPONDIDAS COM OS SISTEMA WEB/MOBILE PROPOSTOS?
    a) O sistema proposto poderá fornecer quais tipos de relatórios e informaçes? 
    b) Crie uma lista com os 5 principais relatórios que poderão ser obtidos por meio do sistema proposto!
    
> A Empresa DevCom precisa inicialmente dos seguintes relatórios:
* Relatório que informe quais são os gerentes de cada departamento incluindo as seguintes informações: número do departamento,  nome do departamento, e nome do gerente.
* Relatório de empregados por projeto incluindo as seguintes informações: número do projeto, nome do projeto, rg do empregado, nome do empregado e quantidade de horas de trabalho do empregado alocadas ao projeto.
* Relatório de empregados com dependentes incluindo as seguintes informações: rg do empregado, nome do empregado, nome do dependente, tipo de relação, data de nascimento do dependente e sexo do dependente.
* Relatório com a quantidade de empregados por cada departamento incluindo as seguintes informações: nome do departamento, supervisor e quantidade de empregados alocados no departamento.
* Relatório de supervisores e supervisionados incluindo as seguintes informações: nome do supervisor e nome do supervisionado.
 
 ### 6. MODELO CONCEITUAL<br>
 
 ![Conceitual](https://github.com/jpzb/projeto-integrador/assets/91470894/5231e082-6c2e-4a8e-bea9-b7a832823945)
    
#### 7. Descrição dos dados 
    USUARIO: tabela que irá armazenar os dados de usuário;
     email: campo que armazena o email do usuário;
     nome: campo que armazena o nome do usuário;
     data_nascimento: campo que armazena a data de nascimento do usuário;
     senha:  campo que armazena a senha do usuário;
     foto: campo que armazena o link da foto do usuário.

    INTUITO: tabela que irá armazenar informações relativas ao intuito do usuário/evento;
     id: campo que armazena o id do intuito;
     nome: campo que armazena o nome do intuito.

    EVENTO: tabela que irá receber informações dos eventos;
     id: campo que armazena o id do evento;
     descricao: campo que armazena a descrição do evento;
     nome: campo que armazena o nome do evento;
     foto: campo que armazena o link da foto do evento;
     data: campo que armazena a data que o evento acontecerá;
     min_pessoas:  campo que armazena o número mínimo de pessoas do evento;
     preco: campo que armazena o preço do evento;
     horario_inicio: campo que armazena o horário de início do evento;
     max_pessoas: campo que armazena o número máximo de pessoas do evento.

    CLASSIFICACAO: tabela que irá receber informações da classificação de cada evento;
     id: campo que armazena o id da classificação;
     nome: campo que armazena o nome da classificação;

    HORARIO_FIM: tabela que terá o horário final do evento;
     id: campo que armazena o id da classificação;
     nome: campo que armazena o nome da classificação;

    TIPO_LOGRADOURO: tabela com as informações do tipo do logradouro;
     id: campo que armazena o id do tipo de logradouro;
     tipo: campo que armazena o tipo do logradouro; 

    ENDERECO: tabela referente às informações do endereço do usuário/evento; 
     id: campo que armazena o id do endereço;
     cep: campo que armazena o cep do endereço;
     numero: campo que armazena o número do endereço;
     descricao: campo que armazena a descrição do endereço;

    BAIRRO: tabela referente às informações do bairro;
     id: campo que armazena o id do bairro;
     nome: campo que armazena o nome do bairro;

    CIDADE: tabela referente às informações do cidade;
     id: campo que armazena o id da cidade;
     nome: campo que armazena o nome da cidade;

    ESTADO: tabela referente às informações do estado;
     id: campo que armazena o id do estado;
     nome: campo que armazena o nome do estado em sigla;


### 8.	RASTREABILIDADE DOS ARTEFATOS<br>
        a) Historia de usuários vs protótipo (Histórias de Usuário e em qual tela do protótipo aquela HU está sendo realizada).
        b) Protótipo vs Modelo conceitual (Histórias de Usuário e em quais tabelas aquele dado está sendo registrado).
        (modelos devem obrigatoriamente estar em conformidade de rastreabilidade)

### 9.	MODELO LÓGICO<br>

  ![Lógico](https://github.com/jpzb/projeto-integrador/assets/91470894/2e16118f-c266-4194-a260-e3426fa7e4e2)
  
### 10.	MODELO FÍSICO<br>
        drop table if exists ESTADO, CIDADE, BAIRRO, TIPO_LOGRADOURO, INTUITO, ENDERECO, EVENTO, HORARIO_FIM, CLASSIFICACAO, EVENTO_CLASSIFICACAO, USUARIO, USUARIO_EVENTO, USUARIO_USUARIO, FOTO_EVENTO;

        create table ESTADO(
         id integer primary key,
         nome varchar(2)
        );

        create table CIDADE(
         id integer primary key,
         nome varchar(30),
         FK_ESTADO_id integer,
         foreign key (FK_ESTADO_id) references ESTADO(id)
        );

        create table BAIRRO(
         id integer primary key,
         nome varchar(30),
         FK_CIDADE_id integer,
         foreign key (FK_CIDADE_id) references CIDADE(id)
        );

        create table TIPO_LOGRADOURO(
         id integer primary key,
         tipo varchar(30)
        );

        create table INTUITO(
         id integer primary key,
         nome varchar(12)
        );

        create table ENDERECO(
         id integer primary key,
         numero integer,
         cep integer,
         descricao varchar(200),
         FK_TIPO_LOGRADOURO_id integer,
         FK_BAIRRO_id integer,
         foreign key (FK_TIPO_LOGRADOURO_id) references TIPO_LOGRADOURO(id),
         foreign key (FK_BAIRRO_id) references BAIRRO(id)
        );


        create table USUARIO(
         id integer primary key,
         email varchar(100) unique,
         nome varchar(200),
         data_nascimento date,
         senha varchar(30),
         foto varchar(500),
         FK_INTUITO_id integer,
         foreign key (FK_INTUITO_id) references INTUITO(id)
        );

        create table EVENTO(
         id integer primary key,
         descricao varchar(300),
         nome varchar(100),
         data timestamp,
         min_pessoas integer,
         preco float,
         max_pessoas integer,
         FK_INTUITO_id integer,
         FK_ENDERECO_id integer,
         FK_USUARIO_id integer,
         foreign key (FK_INTUITO_id) references INTUITO(id),
         foreign key (FK_ENDERECO_id) references ENDERECO(id),
         foreign key (FK_USUARIO_id) references USUARIO(id)
        );
        
        create table FOTO_EVENTO (
         id integer, 
         FK_EVENTO_id integer,
         foto varchar(500)
        );
        
        create table HORARIO_FIM(
         id integer primary key,
         horario time,
         FK_EVENTO_id integer,
         foreign key (FK_EVENTO_id) references EVENTO(id)
        );

        create table CLASSIFICACAO(
         id integer primary key,
         nome varchar(50)
        );

        create table EVENTO_CLASSIFICACAO(
         id integer primary key,
         FK_EVENTO_id integer,
         FK_CLASSIFICACAO_id integer,
         foreign key (FK_EVENTO_id) references EVENTO(id),
         foreign key (FK_CLASSIFICACAO_id) references CLASSIFICACAO(id)
        );

        create table USUARIO_EVENTO(
         id integer primary key,
         data_inscricao date,
         FK_USUARIO_id integer,
         FK_EVENTO_id integer,
         foreign key (FK_USUARIO_id) references USUARIO(id), 
         foreign key (FK_EVENTO_id) references EVENTO(id)
        );

        create table USUARIO_USUARIO(
         id integer primary key,
         FK_USUARIO_PAI_id integer,
         FK_USUARIO_FILHO_id integer,
         foreign key (FK_USUARIO_PAI_id) references USUARIO(id),
         foreign key (FK_USUARIO_FILHO_id) references USUARIO(id)
        );
       
### 11.	INSERT APLICADO NAS TABELAS DO BANCO DE DADOS<br>
   [Arquivo SQL dos Inserts](https://github.com/jpzb/projeto-integrador/blob/main/Arquivos/inserts.sql)
       

#### 12. PRINCIPAIS CONSULTAS DO SISTEMA 
 Inserir as principais consultas (relativas aos 5 principais relatórios) definidas previamente no iten 3.1 deste template.
 <br>
  a) Você deve apresentar as consultas em formato SQL para cad um dos relatórios.
 <br>
  b) Além da consulta deve ser apresentada uma imagem com o resultado obtido para cada consulta.<br>

 ### 13. Gráficos, relatórios, integração com Linguagem de programação e outras solicitações.<br>
     OBS: Observe as instruções relacionadas a cada uma das atividades abaixo.<br>
 #### 13.1	Integração com Linguagem de programação; <br>
 #### 13.2	Desenvolvimento de gráficos/relatórios pertinentes, juntamente com demais <br>
 #### solicitações feitas pelo professor. <br>
 
 ### 14. Slides e Apresentação em vídeo. <br>
     OBS: Observe as instruções relacionadas a cada uma das atividades abaixo.<br>
 #### 14.1 Slides; <br>
 #### 14.2 Apresentação em vídeo <br>

    
##### About Formatting
    https://help.github.com/articles/about-writing-and-formatting-on-github/
    
##### Basic Formatting in Git
    
    https://help.github.com/articles/basic-writing-and-formatting-syntax/#referencing-issues-and-pull-requests
   
    
##### Working with advanced formatting
    https://help.github.com/articles/working-with-advanced-formatting/

#### Mastering Markdown
    https://guides.github.com/features/mastering-markdown/

### OBSERVAÇÕES IMPORTANTES

#### Todos os arquivos que fazem parte do projeto (Imagens, pdfs, arquivos fonte, etc..), devem estar presentes no GIT. Os arquivos do projeto vigente não devem ser armazenados em quaisquer outras plataformas.
1. Caso existam arquivos com conteúdos sigilosos, comunicar o professor que definirá em conjunto com o grupo a melhor forma de armazenamento do arquivo.

#### Todos os grupos deverão fazer Fork deste repositório e dar permissões administrativas ao usuário deste GIT, para acompanhamento do trabalho.

#### Os usuários criados no GIT devem possuir o nome de identificação do aluno (não serão aceitos nomes como Eu123, meuprojeto, pro456, etc). Em caso de dúvida comunicar o professor.


Link para BrModelo:<br>
http://sis4.com/brModelo/brModelo/download.html
<br>


Link para curso de GIT<br>
![https://www.youtube.com/curso_git](https://www.youtube.com/playlist?list=PLo7sFyCeiGUdIyEmHdfbuD2eR4XPDqnN2?raw=true "Title")
