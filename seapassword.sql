create database seapassword;
use seapassword;

create table usuario(
id_usuario int primary key auto_increment,
nome varchar(50),
email_usuario varchar(150) unique,
senha varchar(50)
);

create table plano(
id_plano int primary key auto_increment,
nome_plano varchar(50) unique,
valor decimal(10,2),
quantidade_arm numeric(10)
);

create table pagamento(
id_pagamento int primary key auto_increment,
id_plano int,
id_usuario int,
num_cartao numeric(16) unique,
agencia numeric(4) unique,
cod_seguranca numeric(3) unique,
cpf numeric(11) unique,
data_pagamento_expiracao timestamp,
data_pagamento timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
foreign key (id_plano) references plano(id_plano),
foreign key (id_usuario) references usuario(id_usuario)
);

create table armazenamento(
id_arm int primary key auto_increment,
id_usuario int,
descricao varchar(200),
email_arm varchar(150),
senha_arm varchar(150),
foreign key (id_usuario) references usuario(id_usuario)
);


drop database projeto1;


insert into usuario(nome, email_usuario, senha) VALUES 
('João', 'joao@example.com', 'senha123'),
('Maria', 'maria@example.com', 'senha456'),
("Rodrigo", "rodrigo@gamil.com","senha123"),
 ("Livia", "livia@gmail.com", "livia123!"),
 ("Regiane", "regianesilva@gmail.com", "bolochocolate123!"),
 ("Ana", "anabarbosa@gmail.com", "s3nh@!!"),
 ('Maria', 'maria@gmail.com', 'maria123'),
 ('João', 'joao@gmail.com', 'joao456!'),
 ('Carla', 'carla@gmail.com', 'carla789!'),
 ('Pedro', 'pedro@gmail.com', 'pedro@123'),
 ('Juliana', 'juliana@gmail.com', 'juliana456!');
 
 insert into plano(nome_plano, valor, quantidade_arm)values
 ('essencial', '9.99', 5),
 ('plus', '14.99', 15),
 ('premium', '19.99', 20);
 
 
 #aqui temos que colocar a id do plano e usuario pois no PHP a gente consegue fazer ele fazer a tarefa de achar essas ids e colocar certinho
 insert into pagamento(id_plano, id_usuario, num_cartao, agencia, cod_seguranca, cpf ) values
 (2, 1, 2133456362636483, 4923, 996, 55264738592),
 (3, 5, 5364782645649876, 9835, 887, 98364910384),
 (1, 3, 5364782647859876, 2579, 537, 51982745186);
 
 
 #o mesmo aqui com a id de usuario 
 insert into armazenamento(id_usuario,descricao, email_arm, senha_arm) values
 (1,'apex', 'joaopvp@gmail.com','joaopvp123!'),
 (1, 'epic games', 'joaoalmeida@gmail.com', 'almjoa777'),
 (1, 'faculdade','umc@joao.com.br', 'aaa123!!'),
 (11, 'E-mail da faculdade', 'pastel.aloba@gmail.com', 'senha123'),
 (11, 'E-mail do trabalho', 'juliana.work@gmail.com', 'trabalho456'),
 (8, 'Conta de rede social', 'joao.social@gmail.com', 'social789'),
 (3, 'E-mail pessoal', 'rodrigo.personal@gmail.com', 'personal123'),
 (5, 'E-mail profissional', 'regiane.professional@gmail.com', 'professional456');
 
select * from usuario;
select * from plano;
select * from pagamento;
select * from armazenamento;