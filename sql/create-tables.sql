DROP TABLE IF EXISTS kilpailu, kilpailija, valiaikapiste, kayttajat;

CREATE TABLE kilpailu(
	kilpailutunnus SERIAL PRIMARY KEY,
	nimi varchar(20) NOT NULL,
	paikkakunta varchar(20) NOT NULL,
	paivamaara date NOT NULL	
);

CREATE TABLE kilpailija (
	kilpailutunnus int NOT NULL references kilpailu(kilpailutunnus),
	kilpailijatunnus SERIAL PRIMARY KEY,
	kilpailijanumero int NOT NULL,
	nimi varchar(30) NOT NULL,
	seura varchar(20) NOT NULL,
	lahtoaika time,
	loppuaika time
);

CREATE TABLE valiaikapiste(
	valiaikapistetunnus SERIAL PRIMARY KEY,
	kilpailijatunnus int NOT NULL references kilpailu(kilpailutunnus),
	matka float NOT NULL,
	kilpailijanumero int NOT NULL,
	valiaika time
);

CREATE TABLE kayttajat(
	id SERIAL PRIMARY KEY,
	tunnus varchar(20) NOT NULL,
	salasana varchar(20) NOT NULL
);
