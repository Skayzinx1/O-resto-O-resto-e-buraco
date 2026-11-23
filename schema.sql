DROP DATABASE IF EXISTS stranger_things_db;
CREATE DATABASE stranger_things_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE stranger_things_db;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'investigador',
  `criado_em` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `locais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'seguro',
  `descricao` text DEFAULT NULL,
  `pos_x` int(11) NOT NULL DEFAULT 50,
  `pos_y` int(11) NOT NULL DEFAULT 50,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `monstros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `perigo` tinyint(4) NOT NULL DEFAULT 3,
  `descricao` text DEFAULT NULL,
  `fraqueza` varchar(150) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id_local` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_local`) REFERENCES `locais` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id_local` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_local`) REFERENCES `locais` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `desaparecidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `data_desaparecimento` date DEFAULT NULL,
  `situacao` varchar(30) NOT NULL DEFAULT 'Desaparecido',
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id_local` int(11) DEFAULT NULL,
  `id_monstro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_local`) REFERENCES `locais` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`id_monstro`) REFERENCES `monstros` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(80) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(80) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `usuarios` (`nome`, `email`, `senha`, `tipo`) VALUES
('Las Vegas', 'lasvegas@gmail.com', '$2y$10$jzTVZk2fKWAUDFp0mELyVe38IKzE3OjQ7eS19bdT6ZfONEbpnzvPC', 'admin');

INSERT INTO `locais` (`id`, `nome`, `tipo`, `descricao`, `pos_x`, `pos_y`) VALUES
(1, 'Laboratório Nacional de Hawkins', 'perigo', 'Área restrita do governo. Foi aqui que abriram o primeiro portal para o Mundo Invertido.', 42, 45),
(2, 'Floresta Mirkwood', 'perigo', 'Floresta escura onde a bicicleta de Will Byers foi encontrada em 1983.', 16, 30),
(3, 'Casa dos Byers', 'alerta', 'Casa de Joyce e Will. As luzes de Natal piscam sozinhas na parede da sala.', 26, 72),
(4, 'Delegacia de Hawkins', 'seguro', 'Base do chefe de polícia Jim Hopper. Ponto de encontro dos investigadores.', 60, 20),
(5, 'Hawkins Middle School', 'seguro', 'Escola dos garotos e sede do clube de rádio amador.', 64, 82),
(6, 'Shopping Starcourt', 'alerta', 'Shopping novo da cidade. Esconde um laboratório secreto no subsolo.', 84, 42);

INSERT INTO `monstros` (`id`, `nome`, `perigo`, `descricao`, `fraqueza`, `id_local`) VALUES
(1, 'Demogorgon', 4, 'Predador sem rosto, com a cabeça que se abre como uma flor. Caça sozinho e atravessa paredes entre os dois mundos.', 'Fogo e luz forte', 2),
(2, 'Demo-cães', 3, 'Filhotes de Demogorgon que andam em matilha pelos túneis embaixo da cidade.', 'Calor intenso', 1),
(3, 'Devorador de Mentes', 5, 'Uma sombra gigante que controla as outras criaturas e possui pessoas da cidade.', 'Fechar o portal', 6),
(4, 'Vecna', 5, 'Ser poderoso que invade a mente das vítimas usando os medos e traumas delas.', 'Música favorita da vítima', 3),
(5, 'Demo-morcegos', 2, 'Criaturas voadoras que vivem no céu vermelho do Mundo Invertido e atacam em bando.', 'Fogo', 2);

INSERT INTO `personagens` (`nome`, `idade`, `descricao`, `id_local`) VALUES
('Eleven (Onze)', 12, 'Garota com poderes telecinéticos que fugiu do laboratório. Adora waffles Eggo.', 1),
('Will Byers', 12, 'Garoto que desapareceu e ficou preso no Mundo Invertido.', 3),
('Joyce Byers', 40, 'Mãe de Will. Usou luzes de Natal para conversar com o filho.', 3),
('Jim Hopper', 42, 'Chefe de polícia de Hawkins. Cuida de Eleven como uma filha.', 4),
('Dustin Henderson', 13, 'Amigo dos garotos, o cérebro do grupo e operador de rádio.', 5),
('Steve Harrington', 18, 'Ex-popular da escola que virou protetor do grupo. Trabalha na Scoops Ahoy.', 6);

INSERT INTO `desaparecidos` (`nome`, `idade`, `data_desaparecimento`, `situacao`, `descricao`, `id_local`, `id_monstro`) VALUES
('Will Byers', 12, '1983-11-06', 'Encontrado', 'Sumiu voltando de bicicleta para casa à noite. Foi resgatado no Mundo Invertido.', 2, 1),
('Barbara Holland', 16, '1983-11-07', 'Não sobreviveu', 'Vista pela última vez na beira da piscina dos Harrington.', 2, 1),
('Chrissy Cunningham', 17, '1986-03-21', 'Não sobreviveu', 'Líder de torcida que andava tendo visões e pesadelos.', NULL, 4),
('Bob Newby', 45, '1984-11-02', 'Não sobreviveu', 'Funcionário da RadioShack que ajudou a reiniciar o sistema do laboratório.', 1, 2);

INSERT INTO `categorias` (`id`, `categoria`, `descricao`) VALUES
(1, 'Camisetas', 'Camisetas temáticas de Hawkins.'),
(2, 'Comidas', 'Lanches e doces favoritos dos personagens.'),
(3, 'Colecionáveis', 'Objetos clássicos dos anos 80.');

INSERT INTO `produtos` (`produto`, `valor`, `descricao`, `id_categoria`) VALUES
('Camiseta Hellfire Club', 79.90, 'Camiseta do clube de Dungeons & Dragons da escola.', 1),
('Camiseta Scoops Ahoy', 69.90, 'Uniforme de marinheiro da sorveteria do Shopping Starcourt.', 1),
('Waffles Eggo', 19.90, 'O lanche preferido da Eleven.', 2),
('Sorvete Scoops Ahoy', 14.90, 'Sorvete servido no Shopping Starcourt.', 2),
('Luzes de Natal do alfabeto', 49.90, 'Pisca-pisca com as letras pintadas na parede, igual ao da Joyce.', 3),
('Walkie-talkie 1983', 129.90, 'Rádio para falar com o grupo durante as investigações.', 3);
