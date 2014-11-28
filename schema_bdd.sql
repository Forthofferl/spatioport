DROP TABLE IF EXISTS Achat;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Vaisseau;

CREATE TABLE Vaisseau
(
	idVaisseaux INT NOT NULL AUTO_INCREMENT,
    nomVaiseaux VARCHAR(30) NOT NULL,
    prixVaisseaux VARCHAR(10) NOT NULL, /* on a INT,INT */
    nbrEnStock INT() NOT NULL, /* on a INT,INT */
	PRIMARY KEY (idVaisseaux)
);

CREATE TABLE Utilisateur
(
	idUtilisateur INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(20) NOT NULL,
    sexe CHAR(1) NOT NULL, /* H ou F */
    age INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
	pwd VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	PRIMARY KEY (idUtilisateur)
);

CREATE TABLE Achat
		
);

CREATE TABLE pfcls_Parties
(
	idPartie INT NOT NULL AUTO_INCREMENT,
    nbManche INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
    idJoueur1 INT NOT NULL, /* pas de signe donc toujours positif */
    idJoueur2 INT NOT NULL, /* pas de signe donc toujours positif */
	listeManches VARCHAR(255), /* de la forme idCoup1,idCoup2,idCoup3,etc. */
	idJoueurGagnant INT, /* pas de signe donc toujours positif */
	PRIMARY KEY (idPartie),
	FOREIGN KEY (idJoueur1) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idJoueur2) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idJoueurGagnant) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

CREATE TABLE pfcls_Manches
(
	idManche INT NOT NULL AUTO_INCREMENT,
	idPartie INT NOT NULL,
    listeCoups VARCHAR(255), /* de la forme idFigure1,idFigure2,idFigure3,etc. */
	idJoueurGagnant INT, /* pas de signe donc toujours positif */
	PRIMARY KEY (idManche),
	FOREIGN KEY (idJoueurGagnant) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idPartie) REFERENCES pfcls_Parties(idPartie)
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE pfcls_Coups
(
	idCoup INT NOT NULL AUTO_INCREMENT,
	idManche INT NOT NULL,
    idFigure1 INT,
    idFigure2 INT,
    idJoueur1 INT NOT NULL,
    idJoueur2 INT NOT NULL,
	idJoueurGagnant INT, /* pas de signe donc toujours positif */
	PRIMARY KEY (idCoup),
	FOREIGN KEY (idManche) REFERENCES pfcls_Manches(idManche)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idFigure1) REFERENCES pfcls_Figures(idFigure)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idFigure2) REFERENCES pfcls_Figures(idFigure)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idJoueur1) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idJoueur2) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idJoueurGagnant) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE pfcls_StatistiquesPersonnelles
(
	idStatsPerso INT NOT NULL AUTO_INCREMENT,
    idJoueur INT NOT NULL,
	listeCoups VARCHAR(255), /* de la forme idFigure1,idFigure2,idFigure3,etc. */
	PRIMARY KEY (idStatsPerso),
	FOREIGN KEY (idJoueur) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE pfcls_StatistiquesGlobales
(
	idStatsGlob INT NOT NULL AUTO_INCREMENT,
    idJoueur1 INT NOT NULL,
    idJoueur2 INT NOT NULL,
	listeCoups VARCHAR(255), /* de la forme (idFigure1,idFigure2)(idFigure3,idFigure4),etc. */
	PRIMARY KEY (idStatsGlob),
	FOREIGN KEY (idJoueur1) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (idJoueur2) REFERENCES pfcls_Joueurs(idJoueur)
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB;

INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Pierre", "3,4", "2,5");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Feuille", "1,5", "3,4");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Ciseaux", "2,4", "5,1");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Lézard", "2,5", "3,1");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Spock", "1,3", "2,4");
INSERT INTO pfcls_Joueurs (idJoueur, pseudo, sexe, age, nbV, nbD, pwd, email) VALUES (0, "I.A.", "N", 0, 0, 0, "", "ia@pfcls.me");
