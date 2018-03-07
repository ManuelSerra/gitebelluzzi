CREATE TABLE Docente(
	codiceDocente varchar(8),
	nome varchar(30) NOT NULL,
	cognome varchar(30) NOT NULL,
	docenteDisabile tinyint(1) DEFAULT 0,
	csDisponibile tinyint(1) DEFAULT 0,
	PRIMARY KEY(codiceDocente)
);

CREATE TABLE Classe(
	codiceClasse varchar(5),
	cordinatore varchar(8) NOT NULL,
	alunniGita tinyint(1) DEFAULT 0,
	PRIMARY KEY(codiceClasse)
);

CREATE TABLE ClassiDocente(
	classe varchar(5) NOT NULL,
	docente varchar(8) NOT NULL,
	FOREIGN KEY(classe) REFERENCES Classe(codiceClasse) ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY(docente) REFERENCES Docente(codiceDocente) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE Studente(
	codiceStudente varchar(8),
	nome varchar(30) NOT NULL,
	cognome varchar(30) NOT NULL,
	disabile tinyint(1) DEFAULT 0,
	extracomunitario tinyint(1) DEFAULT 0,
	classe varchar(5) NOT NULL,
	PRIMARY KEY(codiceStudente),
	FOREIGN KEY(classe) REFERENCES Classe(codiceClasse) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE gitaScolastica(
	codiceGita varchar(10),
	classe varchar(5) NOT NULL,
  partecipanti int(2) NOT NULL,
  alunniStranieri tinyint(1) NOT NULL,
  alunniDisabili tinyint(1) NOT NULL,
	accompagnatore varchar(8) NOT NULL,
	accompagnatoreSostituto varchar(8) NOT NULL,
	accompagnatoreDisabili varchar(50),
  accompagnatoreDisabiliSostituto varchar(50),
	meta varchar(50) NOT NULL,
	metaAlternativa varchar(50) NOT NULL,
	periodo varchar(100) NOT NULL,
  durata tinyint(1) NOT NULL,
	classeAggiuntiva varchar(5),
  tettoMassimo varchar(5) NOT NULL,
	trasporto varchar(20) NOT NULL,
  trasportoAlternativo varchar(20)NOT NULL,
  esigenzeDisabile varchar(200) 
	isConfermata tinyint(1) DEFAULT 0,
	PRIMARY KEY(codiceGita),
	FOREIGN KEY(classe) REFERENCES Classe(codiceClasse) ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY(accompagnatoreSostituto) REFERENCES Docente(codiceDocente) ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY(accompagnatore) REFERENCES Docente(codiceDocente) ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY(classeAggiuntiva) REFERENCES Classe(codiceClasse) ON UPDATE CASCADE ON DELETE SET NULL
);
