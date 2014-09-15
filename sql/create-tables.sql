DROP TABLE IF EXISTS Kilpailu, Kilpailija, Valiaikapiste, Kayttaja;

CREATE TABLE Kilpailu(
	Kilpailutunnus SERIAL PRIMARY KEY,
	Nimi varchar(20) NOT NULL,
	Paikkakunta varchar(20) NOT NULL,
	Paivamaara date NOT NULL	
);

CREATE TABLE Kilpailija (
	Kilpailutunnus int NOT NULL references Kilpailu(Kilpailutunnus),
	Kilpailijatunnus SERIAL PRIMARY KEY,
	Kilpailijanumero int NOT NULL,
	Nimi varchar(30) NOT NULL,
	Seura varchar(20) NOT NULL,
	Lahtoaika time,
	Loppuaika time
);

CREATE TABLE Valiaikapiste(
	Valiaikapistetunnus SERIAL PRIMARY KEY,
	Kilpailijatunnus int NOT NULL references Kilpailu(Kilpailutunnus),
	Matka float NOT NULL,
	Kilpailijanumero int NOT NULL,
	Valiaika time
);

CREATE TABLE Kayttaja(
	Kayttajatunnus SERIAL PRIMARY KEY,
	Tunnus varchar(20) NOT NULL,
	Salasana varchar(20) NOT NULL
);
