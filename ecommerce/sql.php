<?php

///creation Base de donnée
#connection à mysql
$base = mysqli_connect("localhost", "root", "", "mysql");
    if($base) echo "connexion reussite à mysql.</br> ";
    else echo "echec de connexion à mysql.</br> ".mysqli_connect_error();

# creation de la BDD
$req="DROP DATABASE if exists ecommerce" ; //requete
$resultat = mysqli_query($base, $req);     //envoie de la requete à mysql
        if($resultat == true) echo " DB supprimée.</br> ";//ca a marché
        else echo "erreur pour supprimer DB.</br> ";                //ou non
$req="create database if not exists ecommerce"; 
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " DB créé.</br> ";
        else echo "erreur creation DB.</br> ";
  
# connection à la database ecommerce
include("database.php");
    
///creation des tables   
    
# creation de la table personne
$req="CREATE TABLE if not exists personne (
    num_id int primary key auto_increment,
    type varchar(7) not null,
    nom varchar(20) not null, 
    prenom varchar(20) not null, 
    email varchar(50) not null, 
    password varchar(20) not null ,
    telephone varchar(10) not null ,
	rue varchar (50) not null,
    ville varchar (20) not null,
    cp varchar (5) not null,
    naissance date,
    sexe varchar(1),
    situation_familiale varchar(20)
    )";
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " table personne créé.</br> ";
        else echo "erreur creation personne.</br> ";
  
# creation de la table produit
$req="CREATE TABLE if not exists produit (
    num_produit int primary key auto_increment,
    nom_produit varchar(20) not null,
    categorie varchar(20) not null,
    marque varchar(20) not null, 
    stock int not null, 
    prix int not null, 
    TVA int not null ,
    description varchar(1000) not null
    )";
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " table produit créé.</br> ";
        else echo "erreur creation produit.</br> ";
 
# creation de la table commande
$req="CREATE TABLE if not exists commande (
    num_commande int primary key auto_increment,
    client int not null,
    nombre_article int not null,
    produits varchar(100) not null, 
    prix_tot int not null,
    date date not null,
    Foreign key(client) references personne(num_id)
    )"; //produit= chaine composé de produit_qtt,produit_qtt etc
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " table commande créé.</br> ";
        else echo "erreur creation commande.</br> ";
 
 
# creation de la table commentaire
$req="CREATE TABLE if not exists commentaire (
    num_commentaire int primary key auto_increment,
    support int not null,
    commentateur int not null,
    message varchar(100) not null, 
    Foreign key(commentateur) references personne(num_id),
	Foreign key(support) references produit(num_produit)
	
    )"; //Foreign key(commentateur) references personne(num_id),Foreign key(support) references produit(num_produit),Foreign key(support) references commentaire(num_commentaire)
    
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " table commentaire créé.</br> ";
        else echo "erreur creation commentaire.</br> ";         

        
///remplissage des tables
# remplissage table personne 
$req="insert into 
    personne(type, nom, prenom, email, password, telephone, rue, ville, cp, naissance, sexe, situation_familiale)
    values 
    ('manager', 'Mana', 'G', 'mana@ger.fr', '0000', '0600000000', 'rue de Pekin', 'Pekin', 'Pekin', '2000-01-01','N', 'marié au travail'),
    ('client', 'Boutet', 'Matthieu', 'mattBout69@esme.fr', 'gemmemarine', '0600000003', 'rue Grisou', 'Montcuq', '46800', '1998-04-25','H', 'concubinage'),
    ('Emperor', 'Montoyus', 'MaximuxAugustus', 'Lalevrette@esme.fr', 'ohhhnon', '0600000003', 'rue de la terre', '69740', 'Terre', '1998-04-25','H', 'toutseulmageule'),
    ('client', 'Lepompier', 'Sam', 'samsam69@esme.fr', 'houih', '0600000743', 'rue de la caserne', '12012', 'Couzoumel', '1995-02-25','F', 'en couple'),
	('client', 'Belon', 'Raphael', 'Belon.Raphael@gmail.com', 'Oustiti4d', '0622222222', 'Avenue Jean Jaures', 'Ivry', '94200', '1998-04-29','F', 'Marié(e)'),
	('client', 'Morgan', 'Dexter', 'Dexter.Morgan@gmail.com', 'batman', '0606060606', 'Harboor Street', 'Floride', '01155', '1936-02-24','H', 'en couple')
    ";
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " table personne remplie.</br> ";
        else echo "erreur remplissage personne.</br> ";  
 
# remplissage table produit
$req="INSERT INTO 
    `produit`( `nom_produit`, `categorie`, `marque`, `stock`, `prix`, `TVA`, `description`) 
     VALUES ('Chromebook','PC','Asus',10,246,20,'Chromebook Asus Flip C302 12.5 Intel Core M3 8 Go RAM 32'),
     ('Chromebook CB514-1HT-P605','PC','Acer',15,520,20,'PRODUIT NEUF généralement expédié SOUS 1 jours ouvrables en ENVOI SUIVI. Envoi professionnel bien protégé.'),
     ('Ultra-Portable Swift 1 SF114-32-C55V','PC','Acer',0,349,20,'Trop bien'),
     ('Portable G3 15 3590','PC','Dell',3,1970,10,'Intel Core i7 16 Go RAM 512 Go SSD'),
     ('Pixma TS8250 Multifonction','imprimante','Canon',4,100,20,'Impimante Canon noir'),
	 ('Pixma TS6251','imprimante','Canon',10,110,20,'Imprimante Jet d\'encre'),
	 ('WorkForce WF-2865DWF Multifonctions','imprimante','Epson',12,110,10,'WorkForce WF-2865DWFMultifonction compact 4 en 1 pour la maison et les petits bureaux, avec impression recto verso, Wi-Fi, Ethernet et impression mobile2.'),
	 ('ScanSnap SV600','scanner','Fujitsu',23,599,20,'Technologie de numerisation en surplomb accessible par simple pression d\'un bouton'),
	 ('Scanjet Pro 2500 f1','scanner','HP',0,259,20,'Augmentez votre productivité lors de travaux de numérisation de routine avec un HP ScanJet Pro compact. Automatisez le flux de travail avec une numérisation recto verso rapide, un chargeur automatique de documents de 50 pages, un cycle de travail quotidien de 1 500 pages et des raccourcis via un seul bouton.')	 
";
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " table produit remplie.</br> ";
        else echo "erreur remplissage produit.</br> ";  
 
# remplissage table commentaire
$req="
    INSERT INTO 
    `commentaire`(`support`, `commentateur`, `message`) 
    VALUES 
    (1,2,'Il est trop bien.'),
    (1,1,'Heureux que notre produit vous conviennes.'),
	(5,5,'Cette imprimante est très facile d\'utilisation.'),
	(4,3,'Un peu chère, mais sinon il est bien'),
	(4,4,'Déçu par ce produit, il a prit feu tout seul...'),
	(8,2,'Vraiment impressionné par la qualité de ce scanner, je le recommande!'),
	(8,1,'Merci de votre confiance en nos produit!')
";
$resultat = mysqli_query($base, $req);
        if($resultat == true) echo " table commentaire remplie.</br> ";
        else echo "erreur remplissage commentaire.</br> ";  

        
?>
<a href="./home.php">commencer?</a>