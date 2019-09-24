create table `area tematica`
(
  `idArea Tematica` int         not null
    primary key,
  nome              varchar(45) null,
  descricao         varchar(45) null
)
  engine = InnoDB;

create table modalidade
(
  idModalidade int         not null
    primary key,
  nome         varchar(45) null,
  descricao    varchar(45) null
)
  engine = InnoDB;

create table usuario
(
  idUsuario int         not null
    primary key,
  nome      varchar(45) null,
  email     varchar(45) null,
  senha     varchar(45) null,
  cpf       varchar(14) null,
  telefone  varchar(45) null,
  admin     int         null
)
  engine = InnoDB;

create table trabalho
(
  idTrabalho      int auto_increment
    primary key,
  titulo          varchar(100) null,
  autores         varchar(200) null,
  statusImpressao varchar(45)  null,
  caminhoTrabalho varchar(100) null,
  codigoTrabalho  varchar(45)  null,
  statusPagamento varchar(45)  null,
  dataHora        datetime     null,
  idAreaTematica  int          null,
  idModalidade    int          null,
  idUsuario       int          not null,
  constraint trabalho_ibfk_2
  foreign key (idAreaTematica) references `area tematica` (`idArea Tematica`),
  constraint trabalho_ibfk_1
  foreign key (idModalidade) references modalidade (idModalidade),
  constraint trabalho_ibfk_3
  foreign key (idUsuario) references usuario (idUsuario)
)
  engine = InnoDB;

create index `Area Tematica_idArea Tematica`
  on trabalho (idAreaTematica);

create index Modalidade_idModalidade
  on trabalho (idModalidade);

create index usuario_idUsuario
  on trabalho (idUsuario);