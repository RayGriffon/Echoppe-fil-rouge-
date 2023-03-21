CREATE TABLE Profil(
   id_profil INT AUTO_INCREMENT,
   nom_profil VARCHAR(50) ,
   mdp_profil VARCHAR(50) ,
   statut_profil VARCHAR(50) ,
   mail_profil VARCHAR(50) ,
   PRIMARY KEY(id_profil)
);

CREATE TABLE Catégorie(
   id_categorie INT AUTO_INCREMENT,
   nom_categorie VARCHAR(50) ,
   id_categorie_1 INT,
   PRIMARY KEY(id_categorie),
   FOREIGN KEY(id_categorie_1) REFERENCES Catégorie(id_categorie)
);

CREATE TABLE Fournisseur(
   id_fournisseur INT AUTO_INCREMENT,
   nom_fournisseur VARCHAR(250) ,
   PRIMARY KEY(id_fournisseur)
);

CREATE TABLE Client(
   id_client INT AUTO_INCREMENT,
   nom_client VARCHAR(50) ,
   prenom_client VARCHAR(50) ,
   contact_client VARCHAR(100) ,
   categorie_client BOOLEAN,
   coef_client DECIMAL(4,2)  ,
   commercial_attribue_client VARCHAR(50) ,
   id_profil INT NOT NULL,
   PRIMARY KEY(id_client),
   FOREIGN KEY(id_profil) REFERENCES Profil(id_profil)
);

CREATE TABLE Produit(
   id_produit INT AUTO_INCREMENT,
   nom_produit VARCHAR(50) ,
   description_produit VARCHAR(250) ,
   prix_produit DECIMAL(10,2)  ,
   tva_produit DECIMAL(5,2)  ,
   ref_produit VARCHAR(50) ,
   publication_produit BOOLEAN,
   id_fournisseur INT NOT NULL,
   PRIMARY KEY(id_produit),
   FOREIGN KEY(id_fournisseur) REFERENCES Fournisseur(id_fournisseur)
);

CREATE TABLE Adresse(
   id_adresse INT AUTO_INCREMENT,
   num_rue_adresse VARCHAR(8) ,
   nom_rue_adresse VARCHAR(250) ,
   nom_ville_adresse VARCHAR(250) ,
   cp_adresse VARCHAR(10) ,
   pays_adresse VARCHAR(50) ,
   id_client INT NOT NULL,
   PRIMARY KEY(id_adresse),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE Commande(
   id_commande INT AUTO_INCREMENT,
   date_commande DATE,
   reglement_commande BOOLEAN,
   reduction_commande DECIMAL(5,2)  ,
   coef_client_commande DECIMAL(4,2)  ,
   nom_client_commande VARCHAR(50) ,
   prenom_client_commande VARCHAR(50) ,
   date_facture DATE,
   num_rue_adresse_facture VARCHAR(8) ,
   nom_rue_adresse_facture VARCHAR(250) ,
   nom_ville_adresse_facture VARCHAR(250) ,
   cp_adresse_facture VARCHAR(10) ,
   pays_adresse_facture VARCHAR(50) ,
   num_rue_adresse_livraison VARCHAR(8) ,
   nom_rue_adresse_livraison VARCHAR(250) ,
   nom_ville_adresse_livraison VARCHAR(250) ,
   cp_adresse_livraison VARCHAR(10) ,
   pays_adresse_livraison VARCHAR(50) ,
   id_client INT NOT NULL,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_client) REFERENCES Client(id_client)
);

CREATE TABLE Photo(
   id_photo INT AUTO_INCREMENT,
   nom_photo VARCHAR(50) ,
   lien_photo VARCHAR(250) ,
   id_produit INT NOT NULL,
   PRIMARY KEY(id_photo),
   FOREIGN KEY(id_produit) REFERENCES Produit(id_produit)
);

CREATE TABLE Bon_de_livraison(
   id_bon_livraison INT AUTO_INCREMENT,
   date_livraison DATE,
   id_commande INT NOT NULL,
   PRIMARY KEY(id_bon_livraison),
   FOREIGN KEY(id_commande) REFERENCES Commande(id_commande)
);

CREATE TABLE Contient(
   id_produit INT,
   id_commande INT,
   nom_produit_commande VARCHAR(50) ,
   prix_produit_commande DECIMAL(10,2)  ,
   quantite_produit INT,
   tva_produit_commande DECIMAL(5,2)  ,
   ref_produit_commande VARCHAR(50) ,
   PRIMARY KEY(id_produit, id_commande),
   FOREIGN KEY(id_produit) REFERENCES Produit(id_produit),
   FOREIGN KEY(id_commande) REFERENCES Commande(id_commande)
);

CREATE TABLE Définit(
   id_produit INT,
   id_categorie INT,
   PRIMARY KEY(id_produit, id_categorie),
   FOREIGN KEY(id_produit) REFERENCES Produit(id_produit),
   FOREIGN KEY(id_categorie) REFERENCES Catégorie(id_categorie)
);

CREATE TABLE Gère(
   id_produit INT,
   id_profil INT,
   id_categorie INT,
   PRIMARY KEY(id_produit, id_profil, id_categorie),
   FOREIGN KEY(id_produit) REFERENCES Produit(id_produit),
   FOREIGN KEY(id_profil) REFERENCES Profil(id_profil),
   FOREIGN KEY(id_categorie) REFERENCES Catégorie(id_categorie)
);

CREATE TABLE Livre(
   id_produit INT,
   id_bon_livraison INT,
   quantite_livree VARCHAR(50) ,
   PRIMARY KEY(id_produit, id_bon_livraison),
   FOREIGN KEY(id_produit) REFERENCES Produit(id_produit),
   FOREIGN KEY(id_bon_livraison) REFERENCES Bon_de_livraison(id_bon_livraison)
);
