<?php 
    session_start();//pour utiliser les variables de sessions
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Marine LOLLIOZ"/>
		<title >Acceuil OSI</title>
        <link rel="icon" type="image/png" href="logo.png"/> <!-- pour le logo -->
        <link rel="stylesheet"  href="homecss.css"/>
		
	</head>
	
	<body>
	</br>
        
		<header><img id="logo" src="logo.png" alt=""/><br><br>
                   
                    <p id="titre" align="center">OSI</p>
                    </br>
                   
                </header>
            </br>
            
            <?php
		include("navigation.php");
                    ?>
            
		<article>
            <H1 style='color:rgb(255,107,7); ' align=" center">ORDINATEUR SCANNER IMPRIMANTE COMPAGNY<hr></H1>
                    <p>Ordinateur Scanner Imprimante Company, officiellement abrégée en OSI, 
                        est une entreprise multinationale américaine initialement d’électronique
                        et d'instrumentation qui évolue au cours du temps vers 
                        l'informatique, les imprimantes,les scanners, les serveurs et réseaux,
                        le logiciel et le multimédia.
			</p>
			<p> Ses principaux produits sont les imprimantes et les scanners, 
                            les ordinateurs de toutes tailles (de poche, portables, de bureau). 
                            La société a son siège à Palo Alto dans la Silicon Valley, en Californie.
</p>
                </br>
                </br>

<h1>Ordinateurs : </h1>

<p>
- À partir de 1972, OSI développe :
</br>

    La gamme OSI300013, un « mini-ordinateur » destiné à l'informatique de gestion « temps réel »,
    « multi-tâches », « multi-utilisateurs » alors que la plupart des autres constructeurs 
    faisaient alors uniquement de l'informatique en « temps différé » 
    et en « traitement par lots » (batch processing). 
    Son système d'exploitation est un logiciel propriétaire le MPE (en)14 ;
    

    La série OSI-1000 : mini-ordinateur technique et scientifique15. 
    Son système d'exploitation est un logiciel propriétaire temps réel : le RTE (en).    </br>
    </br>


- Au cours des années 1970, la société commercialise des tables traçantes.

    En 1978, OSI sort un mini-ordinateur de gestion, le OSI-30016, 
    qui ne trouvera pas de marché et dont la fabrication sera arrêté assez rapidement.    </br>
    </br>

    
</p>	
<h1>Scanners et imprimantes : </h1>

<p>
    En 1978, pour faciliter la mise au point de ces matériels et permettre leur évolutivité, 
    le langage graphique OSI-GL est créé. 
    C'est le premier langage d'imprimante codé par un fichier formaté.

    En 2014, OSI intègre un scanner dans ses imprimantes afin de ciblé un maximum de personnes,
    et de facilité la vie des utilisateurs au bureau.
</p>
	
                </article>
		

                </br>
                
                <footer> Adresse : Palo Alto , Californie</br>
                          Numéro : 09-38-75-84-10
                </footer>
                <br>
                <a href="sql.php">.</a></br>
	</body>
</html>
<?php //affiche un message d'alerte s'il en existe un (positif ou d'erreur)
    if(isset($_GET["message"])){
            echo "<script id='message' >alert('".$_GET["message"]."')</script>";
    }
?>