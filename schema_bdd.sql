DROP TABLE IF EXISTS Achat;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Vaisseau;
DROP TABLE IF EXISTS Administrateur;

CREATE TABLE Vaisseau
(
	idVaisseau INT NOT NULL AUTO_INCREMENT,
    nomVaisseau VARCHAR(30) NOT NULL,
    prixVaisseau VARCHAR(10) NOT NULL, /* on a INT,INT */
	categorie VARCHAR(20) NOT NULL,
    nbrEnStock INT NOT NULL, /* on a INT,INT */
	descripVaisseau VARCHAR(1000) NOT NULL,
	PRIMARY KEY (idVaisseau)
)ENGINE=INNODB;

CREATE TABLE Utilisateur
(
	idUtilisateur INT NOT NULL AUTO_INCREMENT,
   	pseudo VARCHAR(20) NOT NULL,
	prenom VARCHAR(20) NOT NULL,
	nom VARCHAR(20) NOT NULL,
    	age INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
	adr VARCHAR(255) NOT NULL,
	pwd VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	numtel INT,
	nbrVaisseauAcheter INT NOT NULL,
	admin BOOLEAN NOT NULL,
	active VARCHAR(255) NOT NULL,
	PRIMARY KEY (idUtilisateur)
)ENGINE=INNODB;

CREATE TABLE Achat
(
	idAchat INT NOT NULL AUTO_INCREMENT,
	idAcheteur INT NOT NULL,
	idVaisseau INT NOT NULL,
	PRIMARY KEY (idAchat)
)ENGINE=INNODB;



INSERT INTO Vaisseau (idVaisseau,nomVaisseau, prixVaisseau, categorie, nbrEnStock, descripVaisseau) VALUES (NULL,"A-Wing", "250000", "chasseur", "100", "Le A-wing est le chasseur le plus rapide de 
l'Alliance Rebelle. Le vaisseau, très léger, est aussi très maniable et donc particulièrement utile lors de raids éclairs pour surprendre les forces impériales. 
La contrepartie à cette vitesse et à cette maniabilité est un bouclier déflecteur peu puissant . Il possède cependant une bonne puissance de feu et un système de brouillage pour gêner les communications ennemies.");

INSERT INTO Vaisseau (idVaisseau,nomVaisseau, prixVaisseau, categorie,nbrEnStock, descripVaisseau) VALUES (NULL,"Shangai", "1000000", "frégate", "56", "L’action la plus importante du SSV Shangai durant la guerre contre les Moissonneurs fut l’évacuation de la colonie d’Uqbar. Les renseignements de l’Alliance avaient signalé que des Moissonneurs se dirigeaient vers Uqbar, mais le croiseur Shangai était incapable de se poser sur ce monde à la gravité modérée. 
Le commandant du Shangai envoya rapidement toutes es navettes pour participer au rapatriement de centaines de colons sur son vaisseau. Réalisant plus de 41 trajets en une heure, le Shangai parvint à évacuer tout ce qui restait de la population. Quand les Moissonneurs arrivèrent, la capitale d’Uqbar était vide, comme si elle n’avait jamais été occupée.");

INSERT INTO Vaisseau (idVaisseau,nomVaisseau, prixVaisseau, categorie, nbrEnStock, descripVaisseau) VALUES (NULL,"Galactica", "10000000", "vaisseau-mère","20", "Battlestar de classe Columbia, il porte le numéro de registre BS-75, c'est le plus ancien de ce type encore existant, il date de la première Guerre contre les Cylons. Il est l'un des seuls Battlestar ayant échappé à la destruction des Douze Colonies de Kobol. Commandé par l'Amiral William Adama.");

INSERT INTO Vaisseau (idVaisseau,nomVaisseau, prixVaisseau, categorie, nbrEnStock, descripVaisseau) VALUES (NULL,"Cargo 125s2", "500000", "cargo", "107", "Vaisseau cargo Turien.");

INSERT INTO Vaisseau (idVaisseau,nomVaisseau, prixVaisseau, categorie, nbrEnStock, descripVaisseau) VALUES (NULL,"Enterprise NCC-1701", "10000000", "cuirassé", "20", "L'Enterprise est construit essentiellement pour l'exploration spatiale bien qu'il soit bien armé, la classe Constitution dont il fait partie étant la plus puissante de Starfleet lors de sa mise en service. Il compte 23 ponts et 14 laboratoires scientifiques. Il possède aussi un hangar logeant deux navettes et qui est situé à l'arrière de 
la section de propulsion. L'Enterprise possède aussi un téléporteur capable de dématérialiser et de rematérialiser des objets et des personnes d'un vaisseau à un autre ou d'un vaisseau à une planète");

