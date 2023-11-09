INSERT INTO INTUITO (id, nome) 
VALUES (1, 'Família'), 
(2, 'Profissional'), 
(3, 'Amador');


INSERT INTO USUARIO (email, nome, data_nascimento, token, foto, telefone, FK_INTUITO_id) 
VALUES ('gustavo@gmail.com', 'Gustavo Alves', '2000-01-01', 'gustavo123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('pedro@gmail.com', 'Pedro Ramos', '2006-05-10', 'pedro123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('joao@gmail.com', 'João Pedro', '1988-12-20', 'barcellos123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('fellipy@gmail.com', 'Fellipy Silva', '1999-07-15', 'pitico123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('moises@gmail.com', 'Moisés Omena', '1992-03-25', 'moises123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('anaclarasantos@gmail.com', 'Ana Clara Santos Lima', '1990-09-12', 'Anaclara123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 3),
('caioferreira@gmail.com', 'Caio Ferreira Alves', '2007-11-05', 'caio123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 3),
('gabrielaoliveira@gmail.com', 'Gabriela Oliveira Costa', '1983-06-14', 'gabriela123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 3),
('felipealmeida@gmail.com', 'Felipe Almeida Castro', '1989-03-31', 'felipe123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('isabelacristina@gmail.com', 'Isabela Cristina Souza', '1977-12-22', 'isabela123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('vitorhugo@gmail.com', 'Vitor Hugo Silva Ferreira', '1997-08-17', 'vitor123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('liviacosta@gmail.com', 'Lívia Costa Lima', '1981-04-28', 'livia123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 3),
('gustavohenrique@gmail.com', 'Gustavo Henrique Oliveira', '1993-01-09', 'gustavo123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('juliapereira@gmail.com', 'Júlia Pereira Santos', '1985-10-19', 'julia123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('davialmeida@gmail.com', 'Davi Almeida Castro', '1973-07-30', 'davi123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('luanacosta@gmail.com', 'Luana Costa Souza', '2008-05-11', 'luana123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('thiagoferreira@gmail.com', 'Thiago Ferreira Alves', '1986-12-02', 'thiago123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('mariaeduardaoliveira@gmail.com', 'Maria Eduarda Oliveira Lima', '1974-09-23', 'maria123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('joaovictorsantos@gmail.com', 'João Victor Santos Ferreira', '1994-06-04', 'joao123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('marianaalves@gmail.com', 'Mariana Alves Castro', '1999-07-15', 'mariana123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('eduardolima@gmail.com', 'Eduardo Lima Oliveira', '1984-10-26', 'eduardo123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('leticiacosta@gmail.com', 'Letícia Costa Almeida', '1990-07-07', 'leticia123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('pedrohenrique@gmail.com', 'Pedro Henrique Santos Castro', '1976-04-18', 'pedro123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('isadora@gmail.com', 'Isadora Ferreira Lima', '1988-11-29', 'isadora123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('rafaela@gmail.com', 'Rafaela Oliveira Costa', '1996-09-10', 'rafaela123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 2),
('brunoh27@gmail.com', 'Bruno Henrique Santos', '1972-06-21', 'bruno123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 3),
('gabrielle@gmail.com', 'Gabrielle Castro Lima', '1987-03-02', 'gabrielle123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 3),
('jacob@gmail.com', 'Jacob Planil Zoka', '2006-03-02', 'Jacob123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 3),
('mark@gmail.com', 'Mark Zukiberg', '2007-07-15', 'Mark123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1),
('junio@gmail.com', 'Junio Oliveira', '2008-05-02', 'junio123', 'https://i.imgur.com/RyUD05p.png', '(99) 99999-9999', 1);


INSERT INTO ESTADO (id, nome)
VALUES (1, 'AC'), (2, 'AL'), (3, 'AM'), (4, 'AP'), (5, 'BA'), 
       (6, 'CE'), (7, 'DF'), (8, 'ES'), (9, 'GO'), (10, 'MA'), 
       (11, 'MG'), (12, 'MS'), (13, 'MT'), (14, 'PA'), (15, 'PB'), 
       (16, 'PE'), (17, 'PI'), (18, 'PR'), (19, 'RJ'), (20, 'RN'), 
       (21, 'RO'), (22, 'RR'), (23, 'RS'), (24, 'SC'), (25, 'SE'), 
       (26, 'SP'), (27, 'TO');

INSERT INTO CIDADE (nome, FK_ESTADO_id) 
VALUES ('Serra', 8), 
('Cariacica', 8), 
('Guarapari', 8), 
('Vitória', 8), 
('Vila Velha', 8),
('Aracruz', 8),
('Rio de Janeiro', 19); 

INSERT INTO BAIRRO(nome, FK_CIDADE_id)
VALUES ('Jardim Limoeiro', 1),
('Mata da Praia', 4),
('Santa Cruz', 6),
('Itaparica', 5),
('Marina da Glória', 7),
('Santa Helena', 4),
('Estância Monazítica', 1);

INSERT INTO ENDERECO(numero, cep, descricao, FK_BAIRRO_id)
VALUES ('1000', 29164018, 'Nelcy Lopes Vieira', 1),
('0', 29066010, 'Ana Viêira Mafra', 2),
('35', 29199548, 'ES-010', 3),
('0', 29103865, 'Est. José Júlio de Souza', 4),
('0', 20021140, 'Infante Dom Henrique', 5),
('189273', 29055070, 'Cristóvão Jaques', 6),
('714', 29175520, 'Abido Saadi', 7);

INSERT INTO IDADE_PUBLICO(id, intervalo)
VALUES (1, 'De 3 a 7'),
(2, 'De 8 a 13'),
(3, 'De 14 a 16'),
(4, 'De 17 a 20'),
(5, 'Acima de 18'),
(6, 'De 20 a 30'),
(7, 'De 30 a 40'),
(8, 'Acima de 40');

INSERT INTO CLASSIFICACAO (id, nome)
VALUES (1, 'Atletismo'),
(2, 'Automobilismo'),
(3, 'Basquete'),
(4, 'Beach Tennis'),
(5, 'Bicicross'),
(6, 'Boxe'),
(7, 'Capoeira'),
(8, 'Canoagem'),
(9, 'Corrida'),
(10, 'Ciclismo'),
(11, 'Escalada Esportiva'),
(12, 'Futebol'),
(13, 'Futebol Americano'),
(14, 'Futsal'),
(15, 'Ginástica Artística'),
(16, 'Handebol'),
(17, 'Hipismo'),
(18, 'Hóquei em Patins'),
(19, 'Jiu-Jitsu'),
(20, 'Judô'),
(21, 'Kitesurf'),
(22, 'Levantamento de Peso'),
(23, 'Mergulho'),
(24, 'MMA'),
(25, 'Motocross'),
(26, 'Mountain Bike'),
(27, 'Natação'),
(28, 'Natação Sincronizada'),
(29, 'Pentatlo Moderno'),
(30, 'Polo Aquático'),
(31, 'Remo'),
(32, 'Rugby'),
(33, 'Rugby em Cadeira de Rodas'),
(34, 'Skate'),
(35, 'Surfe'),
(36, 'Surfe de Remo'),
(37, 'Taekwondo'),
(38, 'Tênis'),
(39, 'Tênis de Mesa'),
(40, 'Tiro Esportivo'),
(41, 'Triatlo'),
(42, 'Vôlei'),
(43, 'Vôlei de Praia'),
(44, 'Vôlei Sentado'),
(45, 'Xadrez'),
(46, 'Outro');


INSERT INTO EVENTO(descricao, nome, data, min_pessoas, preco, max_pessoas, horario_inicio, horario_fim, foto, FK_CLASSIFICACAO_id, FK_INTUITO_id, FK_ENDERECO_id, FK_USUARIO_id, FK_IDADE_PUBLICO_id)
VALUES ('Aula ofertada pelo Zico para crianças de até 12 anos. O evento terá duração de 2 horas. Participação somente com inscrição prévia.','Aula do Zico', '2023-08-16', 2, 97, 10, '12:00:00', '14:00:00', 'https://i.imgur.com/e3zPVU7.png', 12, 1, 1, 7, 2),
('Treino de futebol americano da igreja. Não pode xingamentos! Venha se ajuntar conosco pra praticar este esporte tão raro aqui no Brasil', 'Treino Black Knights', '2023-05-26', 5, 0, 18, '10:00:00', '11:00:00', 'https://i.imgur.com/ebF3p8e.png', 13, 2, 2, 11, 5),
('Aulão de natação no sesc de Aracruz, venha aprender mais sobre natação e se divertir nesse dia!', 'Desafio de Natação', '2023-07-12', 2, 0, 25, '08:00:00', '10:00:00', 'https://i.imgur.com/VCe3NHw.png', 27, 1, 3, 21, 1),
('Este é um projeto da Prefeitura de Vila Velha junto com o Point Mar Dourado de Beach Tennis, para inserir a modalidade nos esportes educacionais ofertados nas escolas futuramente.', 'Mar Dourado Beach Tennis', '2023-09-12', 5, 10, 50, '11:00:00', '12:00:00', 'https://i.imgur.com/o0DzAVc.png', 4, 1, 4, 25, 3),
('O percurso será da Praça dos Ciclista à Prainha. Os participantes passarão pelas avenidas Estudante José Júlio de Souza e Gil Veloso, além das ruas Castelo Branco e Antônio Ataíde. Durante o trajeto, uma das faixas das vias será interditada para passagem dos atletas. A Guarda Municipal dará apoio com batedores da motopatrulha e viaturas no deslocamento.', '10ª corrida da Penha', '2023-04-09', 100, 0, 500, '07:30:00', '08:30:00', 'https://i.imgur.com/3GbNJut.png', 9, 3, 4, 30, 5),
('O L’ÉTAPE RIO DE JANEIRO SANTANDER é um evento de ciclismo amador, cujo objetivo é aproximar os participantes da experiência da maior competição de ciclismo do mundo.', 'L’ÉTAPE RIO DE JANEIRO', '2023-06-30', 500, 130, 1500, '12:00:00', '14:00:00', 'https://i.imgur.com/q24YyoK.png', 10, 2, 5, 12, 5),
('Surf na cidade de Vila Velha - ES na Praia de Itaparica.', 'Surf - Praia de Itaparica', '2023-08-27', 2, 0, 10, '06:00:00', '08:00:00', 'https://i.imgur.com/9Hq0GSy.png', 35, 3, 4, 25, 3),
('Basquete na cidade de Vitória - ES na Praça do Cauê, perto da Terceira Ponte.', 'Basquete - Praça do Cauê', '2023-07-05', 6, 0, 18, '18:00:00', '20:00:00', 'https://i.imgur.com/MH8QB1D.png', 3, 3, 6, 15, 4),
('Motocross na praia de Jacaraípe, venha aproveitar desse esporte conosco!', 'Motocross Arena Jacaraípe', '2023-09-20', 10, 15.9, 50, '08:00:00', '11:00:00', 'https://i.imgur.com/l9I9hL4.png', 25, 2, 7, 8, 5);

INSERT INTO USUARIO_EVENTO(FK_USUARIO_id, FK_EVENTO_id)
VALUES (28, 1), 
(29, 1),
(18, 3),
(19, 3),
(1, 4), 
(2, 4), 
(3, 4),
(4, 4),
(5, 4),
(8, 5),
(22, 5),
(30, 6),
(29, 6),
(2, 7),
(3, 7),
(16, 8),
(17, 8),
(28, 9),
(17, 9);


INSERT INTO RECORRENTE(id, recorrencia)
VALUES (1, 'Domingo'),
(2, 'Segunda'),
(3, 'Terça'),
(4, 'Quarta'),
(5, 'Quinta'),
(6, 'Sexta'),
(7, 'Sábado');

INSERT INTO EVENTO_RECORRENTE(FK_EVENTO_id, FK_RECORRENTE_id)
VALUES (1, 4),
(4, 3),
(2, 6),
(1, 7);
