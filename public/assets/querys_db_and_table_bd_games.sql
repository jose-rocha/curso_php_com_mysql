-- 01: Criando o banco bd_games.
create database bd_games
with encoding = 'UTF8';


-- 02: Criando tabela usuarios.

create table usuarios (
	id serial primary key,
	usuario varchar(10) not null,
	nome varchar(30) not null,
	senha varchar(60) not null,
	tipo varchar(10) not null default 'editor' -- a outra opção é administrador
);

select * from usuarios;

-- 03: Criando a tabela generos.

create table generos(
	cod int not null, -- em Postgres não pode usar a clausula int(11), use ou int ou integer
	genero varchar(20) not null,
	 primary key(cod)
);

select * from generos;

-- 04: Criando a tabela produtoras.

create table produtoras(
	cod int not null primary key,
	produtora varchar(20) not null,
	pais varchar(15) not null
);

select * from produtoras;

-- 05: Criando tabela jogos.

create table jogos(
	cod int not null,
	nome varchar(40) not null,
	genero int not null,
	produtora int not null,
	descricao text not null,
	nota decimal(4, 2) not null,
	capa varchar(40) not null,

	primary key(cod),
	foreign key(genero) references generos(cod),
	foreign key(produtora) references produtoras(cod)
);

select * from jogos;


Inserindo dados nas tabelas

-- 01: Inserindo dados em generos.

insert into generos(cod, genero)
values(1, 'Ação'),
(2, 'Aventura'),
(3, 'Terror'),
(4, 'Plataforma'),
(5, 'Estratégia'),
(6, 'RPG'),
(7, 'Esporte'),
(8, 'Corrida'),
(9, 'Tabuleiro'),
(10, 'Puzzle'),
(11, 'Luta'),
(12, 'Musical');

select * from generos;

-- 02: Inserindo dados em produtoras.

insert into produtoras(cod, produtora, pais)
values(1, 'Microsoft', 'EUA'),
(2, 'Tecent', 'China'),
(3, 'Nintendo', 'Japão'),
(4, 'Sony', 'Japão'),
(5, 'Activision', 'EUA'),
(6, 'EA', 'EUA'),
(7, 'Sega', 'Japão'),
(8, 'Namco Bandai', 'Japão'),
(9, 'Konami', 'Japão'),
(10, 'Ubisoft', 'EUA'),
(11, 'Valve', 'EUA'),
(12, 'Square Enix', 'Japão'),
(13, 'Take Two', 'EUA'),
(14, 'Capcom', 'Japão');

select * from produtoras;

-- 03: Inserindo dados em jogos.

insert into jogos(cod, nome, genero, produtora, descricao, nota, capa)
values(1, 'Mario Odissey', 2, 3, 'Em Super Mario Odyssey, o jogador joga como Mario em suas aventuras por terras além do Reino dos Cogumelos com o auxílio de um novo personagem introduzido no jogo, o Cappy. Esse \"chapéu vivo\" garante um novo acréscimo à dificuldade e a dinâmica já vista nos jogos anteriores, pois além de ser uma forma de ataque além do seu tradicional pulo, ele dá também a habilidade de \"capturar\" os carismáticos inimigos da série e alguns objetos. A nova mecânica funciona da seguinte maneira: ao chacoalhar os Joy-Cons ou apertar um simples botão, Cappy é arremessado e volta para a cabeça de Mario automaticamente, apenas se não encostar em algo que ele possa interagir. Há também vários outros simples movimentos com os Joy-Cons que fazem o chapéu rodear o cenário de maneiras diferentes, sendo útil de várias maneiras, como por exemplo a possibilidade de coletar moedas eliminar inimigos ao seu redor com mais rapidez. As mecânicas já vistas anteriormente como o \"Ground Pound\" e o \"Wall Jump\" também estão presentes no game.', '9.50', 'mario.png'),
(2, 'Call of Dutty: Black Ops', 1, 5, 'Call of Duty: Black Ops é um jogo eletrônico de tiro em primeira pessoa desenvolvido pela Treyarch, publicado pela Activision e lançado mundialmente em 9 de novembro de 2010 para as plataformas Microsoft Windows, Xbox 360, PlayStation 3, Wii e Nintendo DS. Anunciado em 30 de abril de 2010, o jogo é o sétimo capítulo da série Call of Duty, e o primeiro situado durante a Guerra Fria. É o terceiro da série a ser desenvolvido pela Treyarch, sendo uma sequência direta de Call of Duty: World at War.\r\n\r\nNas primeiras 24 horas de lançamento, o jogo vendeu mais de 5,6 milhões de unidades, sendo 4,2 milhões nos Estados Unidos e 1,4 milhão no Reino Unido, batendo o recorde alcançado por seu antecessor, Modern Warfare 2, em aproximadamente 2,3 milhões de cópias. A 1 de maio de 2012 foi revelado a sequência Call of Duty: Black Ops II com lançamento para novembro de 2012.', '3.50', 'cod.png'),
(3, 'League of Legends', 1, 2, 'League of Legends abreviado como LoL é um jogo eletrônico do gênero multiplayer online battle arena, desenvolvido e publicado pela Riot Games para Microsoft Windows e Mac OS X. É um jogo gratuito para jogar e inspirado no modo Defense of the Ancients de Warcraft III: The Frozen Throne.\r\n\r\nEm League of Legends, os jogadores assumem o papel de \"invocadores\", controlando campeões com habilidades únicas e que lutam com seu time contra outros invocadores ou campeões controlados pelo computador. No modo mais popular do jogo, o objetivo de cada time é destruir o nexus da equipe adversária, uma construção localizada na base e protegida por outras estruturas. Cada jogo de League of Legends é distinto, pois os campeões sempre começam fracos e progridem através da acumulação de ouro e da experiência ao longo da partida.', '8.50', 'lol.png'),
(4, 'Donkey Kong Tropical Freeze', 2, 3, 'Donkey Kong Country: Tropical Freeze é um jogo eletrônico de plataforma side-scrolling desenvolvido pela Retro Studios que foi publicado pela Nintendo para o Wii U em 21 de fevereiro de 2014 nos Estados Unidos. O décimo-sétimo jogo da série, e o primeiro em alta definição, segue o jogo de 2010 Donkey Kong Country Returns, também pela Retro Studios. Foi anunciado durante a pre-conferência E3 2013 da Nintendo em 11 de junho de 2013.A historia do jogo foca num grupo de criaturas viking, como morsas, corujas e pinguins, que invadem a Donkey Kong Island, forçando o protagonista Donkey Kong lutar contra eles com a ajuda de seus amigos Diddy Kong e Dixie Kong, a última fazendo sua primeira aparição na série desde Donkey Kong Country 3: Dixie Kongs Double Trouble, lançado em 1996. Até mesmo o velho Cranky Kong entrou para a aventura.', '8.00', 'donkey.png'),
(5, 'Sonic the Hedgehog', 2, 7, 'Sonic the Hedgehog é uma franquia de videogames criada e produzida pela Sega. A franquia é centrada em uma série de jogos de plataforma focados em velocidade. O protagonizada da série é um ouriço azul chamado Sonic, cuja vida pacífica é sempre interrompida pelo antagonista principal da série, Dr. Eggman. Tipicamente Sonic -normalmente junto de um de seus amigos, como Tails, Amy e Knuckles- se aventuram para parar Eggman e seus planos para dominação mundial. O primeiro jogo da série, lançado em 1991, foi concebido pela divisão da Sega, Sonic Team após um pedido para um novo mascote. O título foi um sucesso, e foi renovado para várias sequelas, que levaram a Sega a liderança no rumo dos consoles de vídeogame da era 16-bit do começo até a metade dos anos 90.', '8.50', 'sonic.png'),
(6, 'God of War', 1, 4, 'God of War é uma série de jogos eletrônicos de ação-aventura vagamente baseada na mitologia grega criada por David Jaffe. Iniciada em 2005, a série tornou-se carro-chefe para a marca PlayStation, que consiste em sete jogos em várias plataformas. Um oitavo título está em desenvolvimento; será uma reinicialização suave para a série e será baseada na mitologia nórdica. A história centra-se em torno de sua personagem jogável, Kratos, um guerreiro espartano enganado para matar sua esposa e filha por seu antigo mestre, o deus da guerra Ares. Kratos mata Ares a mando da deusa Atena e toma seu lugar como o novo deus da guerra, mas ainda é assombrado por pesadelos de seu passado. Revelado ser um semideus e filho de Zeus, o rei dos deuses do Olimpo, que trai Kratos. O espartano em seguida busca vingança contra os deuses para suas maquinações. O que se segue é uma série de tentativas de libertar-se da influência dos deuses e dos titãs e vingança. Cada jogo faz parte de uma saga com vingança como motivo central.', '9.50', 'gow.png'),
(7, 'Counter-Strike', 1, 11, 'Counter-Strike (também abreviado por CS) é um popular jogo eletrônico de tiro em primeira pessoa. Inicialmente criado como um \"mod\" de Half-Life para jogos online, foi desenvolvido por Minh Le e Jess Cliffe e depois adquirido pela Valve Corporation. Foi lançado em 1999, porém em 2000 ele começou a ser comercializado oficialmente, e posteriormente foram feitas versões para Xbox, Mac OS X e Linux. Atualmente o game é jogado na versão Counter-Strike: Global Offensive.O jogo é baseado em rodadas nas quais equipes de contra-terroristas e terroristas combatem-se até a eliminação completa de um dos times, e tem como objetivo principal plantar e desarmar bombas, ou sequestrar e salvar reféns.\r\n\r\nO Counter-Strike foi um dos responsáveis pela massificação dos jogos por rede no início do século, sendo considerado o grande responsável pela popularização das LAN houses no mundo. O jogo é considerado o originador do \"esporte eletrônico\", onde muitos jogadores levam-no a sério e recebem salários fixos, existindo até clãs profissionais, e que são patrocinados por grandes empresas como a Intel e a NVIDIA. Pelo mundo existem ligas profissionais onde o Counter-Strike está presente, como o caso da CPL (que encerrou suas atividades em 2008), ESWC, ESL, WCG e WEG. No caso da ESWC funciona da seguinte forma: cada país tem as suas qualificações no qual qualquer clã pode ir a uma qualificação em uma lan house em qualquer parte do mesmo país, passando depois às melhores equipes, as melhores equipes de cada país encontram-se depois no complexo da ESWC, localizado em Paris, para disputar o lugar da melhor equipe do mundo de Counter-Strike.', '9.00', 'cs.png'),
(8, 'Resident Evil 6', 3, 14, 'Resident Evil 6, conhecido como Biohazard 6 no Japão, é um jogo de vídeo do gênero ação jogado em terceira pessoa desenvolvido e publicado pela Capcom. Apesar do nome é o nono jogo da série principal Resident Evil e foi lançado em 2 de outubro de 2012 para PlayStation 3 e Xbox 360. A versão para Microsoft Windows foi lançada no dia 22 de março de 2013. O game também ganhou uma versão para PlayStation 4 e Xbox One em 29 de março de 2016.\r\n\r\nA história é contada a partir das perspectivas de Chris Redfield, membro e fundador da BSAA traumatizado por ter falhado em uma missão; Leon S. Kennedy, um sobrevivente de Raccoon City e agente especial do governo; Jake Muller, filho ilegítimo de Albert Wesker e associado de Sherry Birkin; e Ada Wong, uma agente solitária com ligações aos ataques bio-terroristas pela Neo-Umbrella.\r\n\r\nO conceito do jogo começou em 2009, mas começou a ser produzido no ano seguinte sobre a supervisão de Hiroyuki Kobayashi, que já tinha produzido Resident Evil 4. A equipe de produção acabou por crescer e tornou-se na maior de sempre a trabalhar num jogo da série Resident Evil. Resident Evil 6 foi apresentado durante uma campanha de divulgação viral na página NoHopeLeft.com.', '7.50', 'resident.png'),
(9, 'Grand Theft Auto V', 2, 13, 'Grand Theft Auto V é um jogo eletrônico de ação-aventura desenvolvido pela Rockstar North e publicado pela Rockstar Games. É o sétimo título principal da série Grand Theft Auto e foi lançado originalmente em 17 de setembro de 2013 para PlayStation 3 e Xbox 360, com remasterizações lançadas em 18 de novembro de 2014 para PlayStation 4 e Xbox One, e em 14 de abril de 2015 para Microsoft Windows. O jogo se passa no estado ficcional de San Andreas, com a história da campanha um jogador seguindo três criminosos e seus esforços para realizarem assaltos sob a pressão de uma agência governamental. O mundo aberto permite que os jogadores naveguem livremente pelas áreas rurais e urbanas de San Andreas.\r\n\r\nA jogabilidade é mostrada em uma perspectiva de terceira pessoa e o mundo pode ser atravessado a pé ou com veículos. Os jogadores controlam três protagonistas e podem alternar entre eles durante e fora das missões. A história é centrada em sequências de assaltos, com muitas missões envolvendo a jogabilidade de tiro e direção. Um sistema de \"procurado\" define a resposta e agressividade das forças da lei contra os crimes cometidos pelo jogador. O modo multijogador, Grand Theft Auto Online, permite que até trinta jogadores explorem o mundo e entrem em partidas competitivas ou cooperativas.', '9.50', 'gta.png'),
(10, 'Metal Gear Solid V', 6, 9, 'Metal Gear Solid V: The Phantom Pain é um jogo eletrônico de ação-aventura furtiva com elementos de RPG, produzido pela Kojima Productions e realizado, desenhado, co-produzido e co-escrito por Hideo Kojima. Foi publicado pela Konami para Microsoft Windows, PlayStation 3, PlayStation 4, Xbox 360 e Xbox One a 1 de Setembro de 2015. The Phantom Pain é o oitavo título canónico na série Metal Gear e o sexto dentro da sua cronologia fictícia. O jogo serve como continuação para Metal Gear Solid V: Ground Zeroes, mas a sua história é anterior aos eventos ocorridos no jogo original Metal Gear original. Contém o mesmo subtítulo, Tactical Espionage Operations, usado pela primeira vez em Metal Gear Solid: Peace Walker. A ação acontece em 1984, nove anos depois de Ground Zeroes, e segue o mercenário Punished \"Venom\" Snake, à medida que este se aventura em África (no decorrer da Guerra Civil Angolana, na fronteira Angola-Zaire) e no Afeganistão durante a Guerra Soviética-Afegã, para procurar vingança sobre as pessoas que destruíram as suas forças e que quase o mataram durante os eventos ocorridos em Ground Zeroes.', '8.50', 'metal.png'),
(11, 'Assassins Creed III', 1, 10, 'Assassins Creed III é um jogo de ação-aventura produzido pela Ubisoft e publicado pela Ubisoft durante os meses de Outubro e Novembro de 2012 para Wii U, Xbox 360, PlayStation 3 e Microsoft Windows . É o quinto jogo principal da série Assassins Creed e o seu terceiro título numerado. Assassins Creed III é a continuação direta de Assassins Creed: Revelations de 2011.\r\n\r\nO enredo decorre de uma história fictícia dentro de eventos reais e segue a batalha ancestral entre os Assassinos, que lutam pela liberdade, e os Templários, que desejam controlar a humanidade. A trama se desenrola no século XXI onde Desmond Miles, o protagonista da série, com a ajuda de uma máquina conhecida como Animus, revive as memórias dos seus ancestrais para o ajudar a descobrir uma maneira de prevenir o Apocalipse de 2012. A história principal se desenrola antes, durante e depois da Revolução Americana entre 1765 e 1783 e segue o ancestral de Desmond, de ascendência mohawk e inglesa, Ratonhnhaké:ton,também conhecido como Connor, enquanto ele luta contra as tentativas dos Templários de controlar a nova nação.', '7.50', 'assassin.png'),
(12, 'The Legend of Zelda', 6, 3, 'The Legend of Zelda é uma icônica série de jogos de aventura e ação criada pela Nintendo, com o primeiro título lançado em 1986. Desenvolvido por Shigeru Miyamoto e Takashi Tezuka, o jogo original introduziu os jogadores ao herói Link, que deve explorar um vasto mundo, resolver enigmas, enfrentar inimigos e resgatar a princesa Zelda das mãos do vilão Ganon. Misturando elementos de exploração, combate em tempo real e resolução de quebra-cabeças, Zelda se destacou por sua liberdade de exploração e design inovador. Ao longo dos anos, a franquia evoluiu com títulos aclamados como Ocarina of Time, Breath of the Wild e Tears of the Kingdom, mantendo-se como uma das séries mais influentes e reverenciadas da história dos videogames. A saga é conhecida por sua trilha sonora marcante, narrativa épica e mundos ricos, que combinam fantasia medieval com tecnologia mística.', 9.0, 'zelda.png'),
(13, 'Metroid', 1, 3, 'Metroid acompanha a caçadora de recompensas Samus Aran, em missões solitárias por planetas alienígenas hostis, enfrentando criaturas perigosas e coletando upgrades para sua armadura e armas. O jogo é famoso por sua exploração não linear, atmosfera sombria e a sensação de isolamento, inovando ao dar destaque a uma protagonista feminina forte.', 8.0, 'metroid.png'),
(14, 'Pikmin', 1, 3, 'Em Pikmin, você controla o Capitão Olimar, um pequeno astronauta que aterrissa em um planeta estranho e recruta criaturas chamadas Pikmin para ajudá-lo a recuperar as peças de sua nave. O jogador precisa gerenciar diferentes tipos de Pikmin, cada um com habilidades únicas, para resolver quebra-cabeças, derrotar inimigos e explorar o mundo. A série é elogiada por seu design criativo, mecânicas de estratégia em tempo real e visual encantador.', 8.5, 'pikmin.png');

-- A partir do cod 12 eu inserir na mão então não vai ter as capas

select * from jogos;

-- 04: Inserindo dados em usuários.

insert into usuarios (usuario, nome, senha, tipo)
values('admin', 'José Rocha', '$2y$10$UpMQCcir.v649HrdLvUXiOC/ftU7xWhSxm8QhX.VzSe9LZHhvW/Ty', 'admin'),
('teste', 'João da Silva', '$2y$10$w7on7cjLKNtmJUGkiHIXoOQAwTJzkgxXqLmjtfDUkCXmQK0784.IS', 'editor');


select * from usuarios;


-- JOIN para query no PHP

select j.cod, j.nome, g.genero, p.produtora, j.descricao, j.nota, j.capa
from jogos j
join generos g on j.genero = g.cod
join produtoras p on j.produtora = p.cod; 


-- Média por produtora

select
  count(p.cod) qtd_cod,
  p.cod as cod_produtora,
  p.produtora as nome_produtora,
  avg(j.produtora) as media_produtora
from jogos j
join produtoras p on j.produtora = p.cod
group by cod_produtora, p.produtora
order by cod_produtora desc;


-- Adicionar olunas
ALTER TABLE usuarios
ADD COLUMN status INTEGER DEFAULT 1,
ADD COLUMN criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN atualizado_em TIMESTAMP;

-- Criar função para trigger
CREATE OR REPLACE FUNCTION update_timestamp()
RETURNS TRIGGER AS $$
BEGIN
    NEW.atualizado_em = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Criar trigger
CREATE TRIGGER usuarios_update_timestamp
    BEFORE UPDATE ON usuarios
    FOR EACH ROW
    EXECUTE FUNCTION update_timestamp();