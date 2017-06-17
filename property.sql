-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Jun-2017 às 08:39
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadastro_unico_imoveis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `title` varchar(144) NOT NULL,
  `slug` varchar(144) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `last_update` datetime NOT NULL,
  `keywords` varchar(144) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `publish_date` datetime NOT NULL,
  `highlighted` smallint(1) NOT NULL DEFAULT '0',
  `area` decimal(10,0) NOT NULL,
  `rooms` int(3) NOT NULL,
  `bathroom` int(3) NOT NULL,
  `garage` smallint(2) NOT NULL,
  `state` int(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `complement` varchar(32) NOT NULL,
  `city` varchar(100) NOT NULL,
  `broker` int(11) NOT NULL,
  `business_type` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `property`
--

INSERT INTO `property` (`id`, `title`, `slug`, `description`, `price`, `last_update`, `keywords`, `status`, `publish_date`, `highlighted`, `area`, `rooms`, `bathroom`, `garage`, `state`, `address`, `complement`, `city`, `broker`, `business_type`, `type`) VALUES
(1, 'Apartamento Chique', 'apartamento-chique', 'PARA PESSOAS DE FINO TRATO!! APTO EM CONSTRUÇÃO NO JARDIM PALOMAR, PRÉDIO PEQUENO, COM SÓ 11 UNIDADES, CONDOMÍNIO COM BAIXO CUSTO DE MANUTENÇÃO, 02 DORMS, SALA COM SACADA, BWC SOCIAL CHURRASQUEIRA INDIVIDUAL, COPA COZINHA, LAVANDERIA E GARAGEM INDIVIDUAL.\r\n', '5000', '0000-00-00 00:00:00', 'apartamento, casa, etc', 1, '2017-06-01 00:00:00', 1, '2400', 2, 3, 4, 1, '', '', '', 1, 1, 1),
(2, 'Casa de Pobre', 'casa-de-pobre', 'PARA PESSOAS DE FINO TRATO!! APTO EM CONSTRUÇÃO NO JARDIM PALOMAR, PRÉDIO PEQUENO, COM SÓ 11 UNIDADES, CONDOMÍNIO COM BAIXO CUSTO DE MANUTENÇÃO, 02 DORMS, SALA COM SACADA, BWC SOCIAL CHURRASQUEIRA INDIVIDUAL, COPA COZINHA, LAVANDERIA E GARAGEM INDIVIDUAL.\r\n', '10000', '0000-00-00 00:00:00', 'apartamento, casa, etc', 1, '2017-06-01 00:00:00', 1, '2400', 2, 3, 4, 22, '', '', '', 1, 1, 1),
(3, 'Apartamento em São Paulo', 'apartamento-em-sao-paulo', 'O Vista Politécnica é um empreendimento Minha Casa Minha Vida há apenas 8 km da Av. Faria Lima, 4,8 km da USP e 2,7 km da Raposo Tavares.\r\n\r\nApartamentos com 2 dormitórios e terraço, servidos por elevador.\r\n\r\nCondomínio fechado com portarias para veículos e pedestres separadas.\r\n\r\nÁrea de lazer com praça central, playgrounds baby e infanto-juvenil, churrasqueira, salão de festas, mini quadra de areia e fitness externo.', '250000', '2017-06-01 00:00:00', 'teste, teste2, teste3', 1, '2017-06-10 15:00:00', 1, '150000', 3, 2, 3, 23, '', '', '', 1, 1, 1),
(4, 'Sobrado em Mogi das Cruzes', 'sobrado-em-mogi-das-cruzes', 'Vendo Sobrado Com 3 dormitórios (todos térreos), sendo 1 suite master com hidro dupla e sauna, sala 2 ou 3 ambientes, copa, cozinha, wc social, despensa com armários em alvenaria, lavanderia com 3 tanques e armários, salão de festas c/vidros e porta blindes e wc, varanda 35 m² com churrasqueira, área livre nos fundos, 2 vagas cobertas, aquecedor elétrico, 3 caixas de 500 litros. Área do terreno: 176 m² (8 x 22) Área Construída: 210 m². Valor R$ 388.000,00 aceita financiamento bancário. <li> Os valores e informações acima exibidos, poderão sofrer mudanças sem prévio aviso. Por este motivo todas as informações deverão ser confirmadas com nossos corretores. (11) 4255 9200 (11) 99975 6666 WhatsApp das 9:00 às 18:00 Hs <li> Temos mais opções em nosso sites: www.bortoneimoveis.com.br & www.bortoneseguros.com.br Mogi das Cruzes é eleita a 7ª Melhor cidade para se viver entre os 100 melhores municípios para se viver no país. Mogi das Cruzes, a Terra do Caqui Localizado a cerca de 60 quilômetros da capital, o município tem pouco mais de 424 mil habitantes, de acordo com IBGE. Além de Indústrias, comércio, serviços e escolas, o município oferece boas opções de lazer. A organização Delta Economics & Finance divulgou, no final do mês de agosto, um ranking, feito com base em dados do IBGE e da ONU, em que estão listados os 100 melhores municípios para se viver no país. No levantamento Mogi das Cruzes apareceu na 7ª colocação, destacando-se não só regionalmente, como perante mais de 5.500 municípios brasileiros. A educação também foi um destaque, com nota de 6,43 – a terceira maior pontuação de todo o ranking. O desempenho econômico-financeiro também pesou positivamente na pontuação geral. A cidade, como se sabe, possui economia mista e se destaca tanto pela produção agrícola como pela expansão industrial e da prestação de serviços, além da crescente atuação de micro e pequenos empreendedores. O parque empresarial reúne mais de 20 mil empresas que desenvolvem as mais diversas atividades nos setores industrial, comercial, de serviços e agronegócios. Hoje, Mogi abriga mais de 400 indústrias, como a General Motors, Valtra, NGK, Gerdau, Kimberley-Clark, Hoganas, Petrom, entre outras, que geram mais de 20 mil empregos. O setor de prestação de serviços é o segundo maior empregador em Mogi das Cruzes. As mais de 12 mil empresas da área gerando empregos diretos. São mais de 5.200 mil estabelecimentos comerciais que empregam 17 mil trabalhadores. Mogi hoje ocupa a 56ª colocação entre os 5.564 municípios brasileiros no Índice de Potencial de Consumo e a 16 ª posição no ranking estadual. A cidade é considerada polo irradiador de tecnologia no cultivo de vários itens do Agronegócio. Hoje, é a maior produtora nacional de caqui (40 mil toneladas/ano), orquídeas (2,5 milhões de vaso/ano), cogumelos comestíveis (8 mil toneladas/ano), nêspera (750 toneladas/ano) e hortaliças (500 mil toneladas/ano). Mais informações em www.bortoneimoveis.com.br', '50000', '2017-06-16 04:17:15', 'sobrado, mogi, das, cruzes', 1, '2017-06-21 08:16:00', 1, '20000', 1, 3, 2, 24, '', '', '', 1, 1, 1),
(5, 'Casa Monstruosamente Monstruosa', 'casa-monstruosamente-monstruosa', 'Casa/Sobrado em Condomínio Fechado. Alto Padrão. Oportunidade! Sobrado com 3 pavimentos, 4 Suites e 4 Vagas. Segurança, Lazer e Boa Localização. Sobrado com 4 Suites no pavimento superior. Sendo 2 maiores (master) com terraço e banheiro com hidro. Amplos armários e ar condicionado. Piso intermediário com ampla sala em L , com Terraço, piso todo em madeira e ar condicionado. Lavabo. Ampla cozinha planejada, com armários e com ótima iluminação e ventilação natural. Área de serviço e área externa de apoio. Piso térreo com amplo salão, lareira e lavabo. Saída para o terraço/varanda, com acesso ao quintal gramado. Quarto externo (escritório ou Serviço) com banheiro, armários e acesso independente. Garagem na frente para 3 ou 4 carros com parte coberta. Condomínio fechado com lazer completo com 2 piscinas, quadra de tênis oficial, sala de ginástica muito bem equipada, salão de festas e cozinha, forno de pizza e churrasqueira, quadra poliesportiva, playground, sauna, estacionamento para visitantes. More com segurança e conforto, localização privilegiada ao lado das melhores escolas, parques e hospitais. Agende sua Visita! Atendimento exclusivo! www.hopremium.com.br 11-36166400', '175000', '2017-06-09 05:18:00', 'teste, casa, monstra', 1, '2017-06-15 10:17:13', 1, '158999', 2, 3, 1, 22, '', '', '', 1, 1, 1),
(6, 'Sou da Mooca não teve progresso', 'sou-da-mooca-nao-teve-progresso', 'Casa em condomínio fechado. Espaço! Conforto! Comodidade e Segurança! Ótima localização, em região residencial e tranquila. Condomínio exclusivo, com apenas 9 Sobrados! Amplo Sobrado com ótima planta (400m²). São 3 Dormitórios, sendo 2 Suítes - uma Master com Closet, Hidro e Terraço. (um segundo dormitório com terraço). Banheiro social. Todos os dormitórios com armários. Living para 3 ambientes, com sala de Jantar, Estar e TV/Video. Espaço para escritório e Lavabo. Ampla cozinha e copa, com bancadas, boa iluminação e ventilação natural. Área de serviço com dependência de empregada/despensa e banheiro. Excelente espaço Gourmet, com bancadas de apoio, Churrasqueira, Forno para pizza. Espaço todo coberto e integrado ao acesso a sala e cozinha. 7 vagas de garagem no subsolo + deposito. Ótimos acabamentos! Repleto de armários. Janelas com persianas. Sistema de aquecimento Solar. Pisos em madeira, granito e porcelanato. - Fácil acesso, tanto da Av. Paes de Barros ou Rua do Oratório como da Av. Salim Sarah Maluf. Condomínio com Sistema de segurança e Salão de Festas. Estuda proposta e avalia permuta como parte do pagamento. Agende sua visita! Atendimento exclusivo www.hopremium.com.br - 3616-6400', '185000', '2017-06-02 07:00:00', 'teste, teste, teste', 1, '2017-06-03 08:16:11', 1, '2302300', 3, 2, 3, 21, '', '', '', 1, 1, 1),
(7, 'Prediao Legal', 'prediao-legal', 'Excelente para: Clínica Médica, Clínica de Estética, Escola de Idiomas, Escritório Comercial. Prédio em ótima localização, ótimo estado de conservação, já com Alvará da Vigilância Sanitária. Térreo: Recepção para deficiente, 1 sala comercial ou consultório para deficiente e 1 sanitário para deficiente, piso frio, (+ou- 24 m²). 1º andar: Recepção com sala de espera e armários, 4 salas comerciais (sendo 1 com escritório e sanitário), salas de esterilização seca e úmida e dois 2 sanitários, piso de granito, tubulação para ar condicionado, ótimo acabamento. 2º andar: Sala de espera, 5 salas comerciais, 1 escritório, 1cozinha, depósito de material de limpeza, 2 sanitário, varanda coberta, piso frio, tubulação para ar condicionado, ótimo acabamento. 3º andar: Sala de espera, 4 salas comerciais sendo 2 com sanitários, área de serviço grande, piso frio, ótimo acabamento. OBS: 2º e 3º andar são interligados por escada interna. 3º andar R$ 2.200,00 2º andar R$ 2.800,00 2º e 3º andar juntos R$ 4.500,00 1º andar + térreo R$4.000,00 Referente ao IPTU relação e valores: 1º andar: R$ 358,85 2º andar : R$ 358,85 3º andar: R$ 317,91', '7500000', '2017-06-22 12:21:19', 'teste, prediao, dahora', 1, '2017-06-16 00:00:00', 1, '455454', 3, 2, 3, 19, '', '', '', 1, 3, 1),
(8, 'Flat Decoravel', 'flat-decoravel', 'Excelente para: Clínica Médica, Clínica de Estética, Escola de Idiomas, Escritório Comercial. Prédio em ótima localização, ótimo estado de conservação, já com Alvará da Vigilância Sanitária. Térreo: Recepção para deficiente, 1 sala comercial ou consultório para deficiente e 1 sanitário para deficiente, piso frio, (+ou- 24 m²). 1º andar: Recepção com sala de espera e armários, 4 salas comerciais (sendo 1 com escritório e sanitário), salas de esterilização seca e úmida e dois 2 sanitários, piso de granito, tubulação para ar condicionado, ótimo acabamento. 2º andar: Sala de espera, 5 salas comerciais, 1 escritório, 1cozinha, depósito de material de limpeza, 2 sanitário, varanda coberta, piso frio, tubulação para ar condicionado, ótimo acabamento. 3º andar: Sala de espera, 4 salas comerciais sendo 2 com sanitários, área de serviço grande, piso frio, ótimo acabamento. OBS: 2º e 3º andar são interligados por escada interna. 3º andar R$ 2.200,00 2º andar R$ 2.800,00 2º e 3º andar juntos R$ 4.500,00 1º andar + térreo R$4.000,00 Referente ao IPTU relação e valores: 1º andar: R$ 358,85 2º andar : R$ 358,85 3º andar: R$ 317,91', '955959', '2017-06-12 09:16:17', 'flat, decoravel, flat, dahora', 1, '2017-06-01 05:16:18', 1, '1515115', 3, 2, 3, 15, '', '', '', 1, 2, 1),
(9, 'Terreno Padrão', 'terreno-padrao', 'Excelente terreno Itaquera - Vila Carmosina, plano 10 x 40 = 400 m², fechado, próximo as Avs. Jacú Pêssego e São Teodoro, ao lado do Atacadão. Somente fiador ou seguro fiança.\r\nExcelente terreno Itaquera - Vila Carmosina, plano 10 x 40 = 400 m², fechado, próximo as Avs. Jacú Pêssego e São Teodoro, ao lado do Atacadão. Somente fiador ou seguro fiança.\r\nExcelente terreno Itaquera - Vila Carmosina, plano 10 x 40 = 400 m², fechado, próximo as Avs. Jacú Pêssego e São Teodoro, ao lado do Atacadão. Somente fiador ou seguro fiança.', '3000000', '2017-06-28 03:13:14', 'terreno, padrao, terreno', 1, '2017-06-22 08:20:00', 1, '299292', 3, 2, 1, 1, '', '', '', 1, 1, 1),
(10, 'Chacara do Seu Antonio', 'chacara-do-seu-antonio', 'é uma chachara dahora', '23000', '2017-06-06 00:00:00', 'chacara, eae', 1, '2017-06-17 00:00:00', 1, '23423', 2, 2, 2, 18, 'Rua do seu Antonio', 'Casa', 'São Sose dos Sampos', 1, 1, 8),
(11, 'Aham ah nem tenta conspira', 'aham-ah-nem-tenta-conspira', 'Sua vida depende do que voce tem na mao, tem que ter disposicao pra seguir na vida loka', '15000', '2017-06-23 00:00:00', 'fieis, de fechar,', 1, '2017-06-17 14:20:14', 1, '23232', 2, 2, 2, 5, 'Rua dos Fieis de Fechar', 'Casa', 'Soldier Sangue Bom', 1, 2, 2),
(12, 'Casa do Dale Capela', 'casa-do-dale-capela', 'Ele desacreditou, os irmãos deram a fila nesse ai pifou', '17000', '2017-06-29 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '12122', 1, 1, 1, 1, 'Rua do DJ Paladino', 'Casa', 'Rua do Seu antonio', 2, 2, 2),
(13, 'Sobrado do Open The Tcheka', 'sobrado-do-open-the-tcheka', 'Open the tcheka, vamos ensinar ingles pras ppk analfabeta vai open the tchecka vai, i love you to co', '450000', '2017-06-16 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '15412', 2, 2, 2, 2, 'Rua da Open The Tcheka', 'Casa', 'Cidade do OTT', 1, 2, 4),
(14, 'Casa da Vitoria', 'casa-da-vitoria', 'venha conhecer a casa da vitoria, mas o tempo passou eu fiz essa cancao', '155151', '2017-06-08 00:00:00', 'teste, eae', 1, '2017-06-17 09:14:13', 1, '5523', 2, 2, 2, 15, 'Rua da Lei do Retorno', 'casa', 'City return lei ingleess', 1, 2, 3),
(15, 'Casa do Porsche Cayenne', 'casa-do-porsche-cayenne', 'De porsche cayenne pego varias gatinha oou ou ipanema só as topa de linha aaaaaaaaaaaaaaaaaaaaa', '454184', '2017-06-10 00:00:00', 'casa', 1, '2017-06-24 00:00:00', 1, '15121', 1, 1, 2, 13, 'Rua do Rio de Janeiro', 'Casa', 'Rio de Janeiro', 1, 1, 3),
(16, 'Que pepeca é essa? Menina rebolante', 'que-pepeca-e-essa-menina-rebolante', 'Ta no baile de favelaaaaaaaaaaa', '78505', '2017-06-17 00:00:00', 'eae, teoi', 1, '2017-06-17 00:00:00', 0, '2322', 2, 2, 2, 11, 'Rua da Rebolante', 'Casa', 'São Paulo', 1, 2, 3),
(17, 'Baile de Favelaaaaaaaaaaaaa', 'baile-de-favelaaaaaaaaaaa', 'menina rebolante ta no baile de favelaa', '230230', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '1201', 1, 1, 1, 1, 'endereco', 'casa', 'sao paulo', 1, 1, 1),
(18, 'Don don don don don', 'don-don-don-don-don', 'o tu ta tao taoooooo linda com esse rabetao', '121212', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '2321', 1, 2, 2, 3, 'adr', 'cas', 'são paulo', 1, 1, 3),
(19, 'É a magia da linguada', 'e-a-magia-da-linguada', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa tive um sonho pesado', '144000', '2017-06-17 00:00:00', 'cas', 1, '2017-06-17 00:00:00', 1, '2020', 2, 2, 2, 1, 'endereco monstro', 'cas', 'amazonas', 1, 2, 5),
(20, 'Cai no delirio baleado pelo som', 'cai-no-delirio-baleado-pelo-som', 'Cai no delirio baleado pelo som é a bola da vez escuta ta ficando bom, ah muleke o baile funk é mó lazeeeeeeeeeeeeeer', '48595', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '232', 1, 1, 1, 1, '1', '1', '1', 1, 1, 1),
(21, 'Baleado pelo Som ', 'baleado-pelo-som', 'ce tu n acredita confere vem conhecer, driblando as pedras e nos espinhos eu vou caminhandoooooooooooooooooooo', '20101', '2017-06-17 00:00:00', 'eae', 1, '2017-06-17 00:00:00', 1, '1111', 1, 1, 1, 1, 'Acre', 'Acre', 'Acre', 1, 1, 4),
(22, 'Eu conheci a andreia da internet', 'Eu-conheci-a-andreia-da-internet', 'Fala igual paulista vishhhhhhhhhhhhhh ', '12111', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '232', 2, 1, 1, 3, 'rua do nao sie oq', 'cas', 'Acre', 1, 2, 3),
(23, 'Oh jorginho me empresta a 12', 'oh-jorginho-me-empresa-a-12', 'Oh jorginho me empresta 12 pra mim fazer um barulho, o jorginho me empresta a 12 vou matar esse maconheiro', '15400', '2017-06-17 00:00:00', '1212', 1, '2017-06-17 00:00:00', 1, '5332', 6, 6, 6, 6, 'casa do jorginho', 'cas', 'Rio Grande do Sul', 1, 2, 3),
(24, 'To usando crack', 'to-usando-crack', 'Larguei minha familia a escola voce sabe, parei com a maconha, to usando crack', '12000', '2017-06-17 00:00:00', 'eae, xd', 1, '2017-06-17 00:00:00', 1, '2292', 1, 1, 1, 1, 'a macas tlight', 'Casa', 'São Paulo', 1, 3, 6),
(25, 'Diamante é monstro caraio', 'diamante-e-monstro-caraio', 'esse sistema vai ficar chave cusao', '2022', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 1, '1223', 2, 3, 4, 13, 'casa', 'casa', 'São Paulo', 1, 1, 1),
(26, 'Nao aguento mais cadastrar', 'nao-aguento-mais-cadastrar', '03:14 da manha e eu aqui cadastrando, desanimei de vez ave maria, so um batidao mesmo pra agitar essa madrugada friaaaaaaaa', '119595', '2017-06-17 00:00:00', '111', 1, '2017-06-17 00:00:00', 1, '433', 3, 2, 3, 19, 'Sei nao', 'Casa', 'Jordao do Ceara', 1, 4, 7),
(27, 'Cheguei sai fora voltei', 'cheguei-sai-fora-voltei', 'Eu sou daleste com as top de angra do lado', '502022', '2017-06-17 00:00:00', 'casa, teste,', 1, '2017-06-17 00:00:00', 1, '4943', 3, 2, 2, 2, '2', '2', '2', 1, 2, 2),
(28, 'Sem responsabilidade ninguem é de ninguem', 'sem-responsabilidade-ninguem-e-de-ninguem', 'antes contava moeda hoje so conta nota de 100000000000000000000000000000000000000', '50202', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '2320', 2, 2, 2, 23, 'Rua Yervant', 'Casa', 'São Paulo', 1, 1, 1),
(29, 'Com as top de angra so aqui', 'com-as-top-de-angra-so-aqui', 'E to até enjoando, de onde ele vem voce vai morrer se perguntando caraio', '293900', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '9492', 6, 5, 5, 5, 'rua do eaeeeeeeeeeeeee', 'casa', 'Uberlandia', 1, 1, 7),
(30, 'Sorry, my english is bad', 'sorry-my-english-is-bad', 'I will insert in table property the data in english, i not will use google translate, why i fuck !!!!!!!!!!!!!', '121212', '2017-06-17 00:00:00', 'test', 1, '2017-06-17 00:00:00', 1, '1022', 4, 2, 3, 2, 'Rua dos Endereços', 'Predio', 'São Paulo', 1, 3, 6),
(31, '200 km por hora eu passei', '200-km-por-hora-eu-passei', '200 km por hora eu passei !!!!!!!!!!!!!!!!', '98000', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 1, '2', 3, 2, 2, 8, 'Rua dos carros', 'Casa', 'São José dos Campos', 1, 1, 2),
(32, 'Predio do Mundo Moderno', 'predio-do-mundo-moderno', 'eu queria falar que esse predio so tem monstro morando nele caraio puta que pariu', '78700', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 1, '9999', 9, 9, 9, 9, 'rua do end', 'casa', 'São Paulo', 1, 4, 10),
(33, 'Chacara do Come coração', 'chacara-do-come-coracao', 'parece o paraiso do lado do inferno brasil mundo modernooooooooo', '95000', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 1, '2', 2, 2, 2, 2, 'felipe boladao', 'casa', 'Paraiso', 1, 2, 10),
(34, 'Sdds da academia kkkkk', 'sdds-da-academia-kkkkk', 'Mas eu vou voltar a malhar, só resolver uns problema e logo logo vamo ficar monstro 150kg no supino', '4545', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 1, '322', 3, 3, 3, 3, '3', '3', 'São José do Rio Preto', 1, 3, 3),
(35, 'Bola gato das paraibana', 'bola-gato-das-paraibana', 'o melhor bola gato q ce pode ganhar é das paraibana', '6053', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '1', 1, 1, 1, 1, '1', '1', '1', 1, 1, 1),
(36, 'Sorry, meu english is pessimo', 'sorry-meu-english-is-pessimo', 'vou fazer um curso pra melhorar', '57888', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '299', 4, 4, 4, 4, '4', '4', '4', 1, 4, 4),
(37, 'Predio do Paradise', 'predio-do-paradise', 'predio mosas', '2020', '2017-06-17 00:00:00', '2017-06-17 00:00:00', 1, '2017-06-17 00:00:00', 0, '200', 2, 2, 2, 20, '2', 'casa', 'Suzano', 1, 3, 8),
(38, 'Ghost Town cidade fantasma? traduzi sem googlek', 'ghost-town-cidade-fantasma-traduzi-sem-googlek', 'sou monstro filho eu consigo traduzir', '2222', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 1, '2', 3, 3, 3, 3, 'Rua dos enderecos', 'casa', 'São Paulo', 1, 3, 3),
(39, 'Nossa velho to mt cansado', 'nossa-velho-to-mt-cansado', 'so queria dormir mas n posso tenho q atingir a meta de cadastro pra dps dobrar a meta', '2200', '2017-06-17 00:00:00', '2017-06-17 00:00:00', 1, '2017-06-17 00:00:00', 0, '2020', 3, 3, 3, 20, 'rua sei la', 'casa', 'sei la', 1, 3, 4),
(40, 'Ja e 3 da manha e eu aqui', 'ja-e-3-da-manha-e-eu-aqui', 'nao aguento mais cadastrar no php my admin', '9999', '2017-06-17 00:00:00', '2017-06-17 00:00:00', 1, '2017-06-17 00:00:00', 0, '8888', 8, 8, 8, 8, '8', '8', '8', 1, 3, 6),
(41, 'php my admin é foda mysql é moda', 'php-my-admin-e-foda-mysql-e-moda', 'workcneh meu aosaosasoasoasosaoasosaooas', '1900', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 0, '3030', 1, 1, 1, 25, 'Endereco do n sei oq', 'casa', 'são paulo', 1, 1, 2),
(42, 'Mais um imovel e eu encerro', 'mais-um-imovel-e-eu-encerro', 'explodeeeeeeeeeeeeeeeeeeee', '64626', '2017-06-17 00:00:00', '2017-06-17 00:00:00', 1, '2017-06-17 00:00:00', 0, '9212', 2, 2, 2, 2, 'asassaasas', 'casa', 'eae', 1, 1, 1),
(43, 'Meu primeiro contato com json foi na prova', 'meu-primeiro-contato-com-json-foi-na-prova', 'Aprendi json na prova mesmo, é assim q nois aprende programador raizzzzzzzzzzz', '45959', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 0, '322', 2, 2, 2, 2, 'Rua dos Cabeça', 'Casa', 'Cidade boa', 1, 2, 1),
(44, 'O mundo ta bem revirado', 'o-mundo', 'vai tomar no cu n aguento mais', '23020', '2017-06-17 00:00:00', '20', 1, '2017-06-17 00:00:00', 0, '2002', 3, 3, 3, 3, 'sai fora velho', 'cansei', 'cansei', 1, 2, 4),
(45, 'Porra velho minhas costas doendo', 'vsf n vou formatar slug', 'n quero saber de mais nada', '10010', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 0, '1', 1, 1, 1, 1, '1', '1', '1', 1, 1, 1),
(46, 'Estaca 0 em relacao a pontos', 'estaca-o-em-relacao-a-pontos', 'preciso fazer uns pontos ', '95000', '2017-06-17 00:00:00', '1', 1, '2017-06-17 00:00:00', 1, '495', 2, 2, 2, 22, '2', '2', 'São Paulo', 1, 2, 2),
(47, 'Ultimo imovel dessa vez', 'ultimo-imovel-dessa-vez', 'nao aguento mais velho pqp', '2020', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 0, '202', 2, 2, 2, 2, '22', 'casa', 'cidade do mito', 1, 2, 3),
(48, 'Quero do boldo, entre rajadas e pipocos', 'quero-do-boldo-entre-rajadas-e-pipocos', 'Viva o bob marleyyyyyyy lima', '180000', '2017-06-17 00:00:00', 'casa, mc, felipe, boladao', 1, '2017-06-17 00:00:00', 1, '202', 2, 2, 2, 24, 'Rua do Bob marley', 'Casa', 'São Paulo', 1, 2, 2),
(49, 'Residencia dos Loucos', 'residencia-dos-loucos', 'é claro q eu n podia dormir sem cadastrar um imovel com essa musica monstra', '499999', '2017-06-17 00:00:00', 'casa, monstra', 1, '2017-06-17 00:00:00', 1, '39420', 3, 3, 3, 22, 'Rua do Ar Baby', 'casa', 'são paulo', 1, 2, 2),
(50, 'Ar Baby de Israel', 'ar-baby-de-israel', 'moro na zona noroeste', '33020', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '2320', 2, 2, 2, 2, 'montando um elenco cruel', 'cas', 'rio de janeiro', 1, 2, 4),
(51, 'Meu maior veneno é cumprir', 'meu-maior-veneno-e-cumprir', '.............', '200220', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 0, '230202', 2, 1, 2, 3, '1', 'cas', 'rio de jan', 1, 2, 2),
(52, 'Meu maior veneno é ser a favor da copa', 'meu-maior-veneno-e-ser-a-favor-da-copa', 'e quem deve vai morrer', '198888', '2017-06-17 00:00:00', 'casa', 1, '2017-06-17 00:00:00', 1, '2322', 2, 2, 2, 16, 'casa', 'casa', 'sao pa', 1, 2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
