<?php 
    session_start();//pour utiliser les variables de sessions
    include("database.php");//pour se connecter a la BD
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Liste clients</title>
        <link rel="stylesheet"  href="homecss.css"/>
        <link rel="icon" type="image/png" href="logo.png"/>
    </head>
   
    
    
    <body>
        <header><img id="logo" src="logo.png" alt=""/>

            <p id="titre" align="center">OSI</p>
            </br>
			
		</header>
        
        
         <?php
         //pour ajouter la barre de navigation
                    include("navigation.php");
                ?>
        
        
        <?php 
			if(isset($_SESSION['type']) && $_SESSION['type']=="manager"){
				 $req = "SELECT * FROM `personne` WHERE type='client' "; //aller chercher toutes les informations clients
                    $result = mysqli_query($base,$req);
               
                    //creation du tableau contenant tous les produits
                    echo"
                    <table align='center'>
                        <tr>
                            <th colspan ='7'><br>Clients : <hr><br></th>
                        </tr>
						<tr>
							<td>ID</td>
                            <td>Nom</td>
                            <td>Prenom</td>
                            <td>Email</td>
                            <td>Telephone</td>
                            <td>Naissance</td>
                            <td>Sexe</td>
						</tr>";
						 while($ligne= mysqli_fetch_assoc($result)){
                        $ID=$ligne["num_id"];
                        echo " <tr> 
							<td> $ID </td>
                            <td>". $ligne["nom"]."</td>
                            <td> ". $ligne["prenom"]."</td>
                            <td> ". $ligne["email"]. " </td>
                            <td> ". $ligne["telephone"]. " </td>
                            <td> ". $ligne["naissance"] ." </td>
                            <td> ". $ligne["sexe"]. " </td>
							<td> <form method='post' action='client.php'>
							<input type='hidden' name='id' value=$ID/>
							<input type='submit' name='submit' value='voir profil' id='envoyer'/>
						</form> </td>
							";
						 }
						  echo"    </tr> 
                    </table></br>";
			}
		?>
		
		 <footer> Adresse : Palo Alto , Californie</br>
                    Numéro : 09-38-75-84-10
          </footer>
        
    </body>
</html>
		