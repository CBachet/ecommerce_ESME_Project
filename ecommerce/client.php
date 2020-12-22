<?php 
session_start();
    include("database.php");
	if(isset($_POST["id"])){ //recupere l'id de la session ou l'id du client choisi par le manager
		$id=$_POST["id"];
	}else{
		$id=$_SESSION["id"];
	}
    
    $req = "select * from personne where num_id='$id'"; //recupere les infos du client
    $result = mysqli_query($base,$req);
    $personne= mysqli_fetch_assoc($result);
	$id=$personne['num_id'];
                
?>
<html>
    <head><?php 
    		echo"
        	<meta charset='UTF-8'>
        	<meta name='author' content='Clovis B Marine L'/>
        	<title> ".$personne['prenom'] ."</title>"; ?>
			<link rel="icon" type="image/png" href="logo.png"/>
        	<link rel="stylesheet"  href="homecss.css"/>
    </head>
    <body>
	</br>
        
		<header><img id="logo" src="logo.png" alt=""/>
                   
            <p id="titre" align="center">OSI</p>
            </br>
                   
        </header>
        </br>
            
		
  <?php
  include('navigation.php');
	
	//affichage des informations utilisateur
        echo "<div align='center'>
            <h2>Nom: ".$personne['nom']."</h2>".
        	 "<h2>Prénom: ".$personne['prenom']."</h2>".
             "<h2>Email: ".$personne['email']."</h2>".
             
             "<h2>Numéro de téléphone: ".$personne['telephone']."</h2> ".
            
             "<h2>Adresse: ".$personne['rue']."  ".
             $personne['cp']."   ".
             $personne['ville']."</h2> ";
			if(isset($personne['naissance'])){
				echo "<h2>Date de naissance: ".$personne['naissance']."</h2> ";
            }
			
			//affiche les infos non obligatoires si elles existent
			if(isset($personne['sexe']) && $personne['sexe']=='H'){
				echo "<h2>Genre: Homme</h2> ";
				}elseif(isset($personne['sexe']) && $personne['sexe']=='F'){
				echo "<h2>Genre: Femme</h2> ";
				}
			if(isset($personne['situation_familiale'])){
                if($personne['situation_familiale']=='null'){
                    $sit='Non renseignée';
                }
                else{
                    $sit=$personne['situation_familiale'];
                }

				echo "<h2>Situation familiale: ".$sit."</h2> </div>";
            }

            

            $prenom=$personne['prenom'];
        	$nom=$personne['nom'];

	//bouton pour la modification du client
        echo"
        
        <form align='center' action='modifClient.php' method='POST'>
        	<input type='hidden' name='id' value='$id'/>
        	<input type='hidden' name='prenom' value='$prenom' />
        	<input type='hidden' name='nom' value='$nom' />
        	<input type='submit' name='modif' value='Modifier' id='envoyer' />
    	</form>";
    	?>
    </body>


</html>
