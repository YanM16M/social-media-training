#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: USER
#------------------------------------------------------------

CREATE TABLE USER(
        id       Int  Auto_increment  NOT NULL ,
        login    Varchar (50) NOT NULL ,
        mdp      Varchar (50) NOT NULL ,
        avatar   Varchar (1024) NOT NULL ,
        remember Bool NOT NULL
	,CONSTRAINT USER_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: POST
#------------------------------------------------------------

CREATE TABLE POST(
        id        Int  Auto_increment  NOT NULL ,
        titre     Varchar (50) NOT NULL ,
        contenu   Varchar (512) NOT NULL ,
        dateEcrit Date NOT NULL ,
        image     Varchar (1024),
        idAuteur  Int NOT NULL,
        idAmi     Int
	,CONSTRAINT POST_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: LIEN
#------------------------------------------------------------

CREATE TABLE LIEN(
        id             Int  Auto_increment  NOT NULL ,
        idUtilisateur1 Int NOT NULL ,
        idUtilisateur2 Int NOT NULL ,
        etat           Varchar (512) NOT NULL
	,CONSTRAINT LIEN_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: COMMENTAIRE
#------------------------------------------------------------

CREATE TABLE COMMENTAIRE(
        id       Int  Auto_increment  NOT NULL ,
        idPost   Int NOT NULL ,
        idAuteur Int NOT NULL ,
        Contenu  Varchar (124) NOT NULL ,
        Image    Varchar (1024) NOT NULL
	,CONSTRAINT COMMENTAIRE_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: VOTE
#------------------------------------------------------------

CREATE TABLE VOTE(
        id       Int  Auto_increment  NOT NULL ,
        idPost   Int NOT NULL ,
        idAuteur Int NOT NULL ,
        type     Int NOT NULL
	,CONSTRAINT VOTE_PK PRIMARY KEY (id)
)ENGINE=InnoDB;
