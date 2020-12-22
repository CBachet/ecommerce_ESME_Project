
<?php
    session_start();
    include("database.php");
    $id=$_GET["produit"];
    $req = "select * from produit where num_produit='$id'";
    $result = mysqli_query($base,$req);
    $produit= mysqli_fetch_assoc($result);
	if(isset($_SESSION['type'])) {
		$nom=$_SESSION['nom'];
		$prenom=$_SESSION['prenom'];
	}
	
                
?> 
<!DOCTYPE html>
<html>
    <head><?php echo"
        <meta charset='UTF-8'>
        <meta name='author' content='Clovis B Marine L'/>
        <title> ".$produit['nom_produit'] ."</title>
        <link rel='stylesheet'  href='homecss.css'/>
	<link rel='icon' type='image/png' href='logo.png'/>"?>
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
                echo "<h2>".$produit['nom_produit']."</h2></br>
                       ".$produit['categorie']." de la marque ".$produit['marque']."</br>
                        <h3>".$produit['prix']." €</h3>  </br>
                        <p>quantité en stock:".$produit['stock']."</p>
                       ";

                        if(isset($_SESSION['type']) && $_SESSION['type']=="manager"){

                            echo"
                             <form method='post' action='modifierProduit.php'>
                                  <input type='hidden' name='retour' value='produit.php?produit=$id'/>
                                  <input type='hidden' name='num' value=$id/>
                                  <input type='submit' name='submit' value='Modifier' id='envoyer'/>
                                 </form>
                            
                             <form method='post' action='supprimerProduit.php'>
                                  <input type='hidden' name='retour' value='produit.php?produit=$id'/>
                                  <input type='hidden' name='num' value=".$id."/>
                                  <input type='submit' name='submit' value='Supprimer' id='envoyer'/>
                                 </form>
                             ";  

                        }elseif(isset($_SESSION['type']) && $_SESSION['type']=="client"){
                            echo"

                        <form method='post' action='commanderProduit.php'>
                               <input type='hidden' name='retour' value='produit.php?produit=$id'/>
                               <label for='qtt'> Quantité: </label>
                               <input type='text' name='qtt' /> 
                               <input type='hidden' name='num' value=$id/>
                               <input type='submit' name='commande' value='Ajouter au panier' id='envoyer'/>
                            </form>"; 
                        }


                
                
                 
					

                    $req = "select message, commentateur from commentaire WHERE support=$id ";//aller chercher toutes les informations produits
                    $result = mysqli_query($base,$req);
					

					echo"<h2>///COMMENTAIRES:///</h2>";
				
                    while ($com=mysqli_fetch_assoc($result)){
						$req = "select * from personne where num_id =".$com['commentateur'];
						$guy=mysqli_fetch_assoc(mysqli_query($base,$req));
                      echo "<table> ¤ ".$com["message"]."  |par ".$guy['nom']."    ".$guy['prenom']."		";
						if(isset($_SESSION['type']) && $_SESSION['type']=="manager"){
							echo	"  <form action='supprimerCom.php' method='post'> <input type='hidden' name='id' value='$id' /> 
						<input type='submit'  value='supprimer' id='envoyer'/>   </form>  </table></br>";
					}}
					
					if(isset($_SESSION['nom'])){
						echo " <h2>Ecrire un commentaire: </h2>";
						echo"<form align='center' action='commentaire.php' method='POST'>
                    <fieldset>
                        <legend>Coordonées client: </legend>
                	    <label>Nom : </label>
                	    <input type='text' name='Nom' value=$nom readonly/><!-- readonly = juste lire on ne peut pas modifier les infos présentes-->
                        <br>
                        <label>Prénom : </label>
                        <input type='text' name='Prenom' value=$prenom readonly/>                        
                        <br>
                        <label>Adresse email : </label>
                        <input type='text' name='Email' placeholder='Nom.Prenom@gmail.com' id='mail' required/><a class='obligatoire' >*</a>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Commentaire: </legend>
                        <textarea name='commentaire' rows='20' cols='100'/></textarea>
                    </fieldset>
                    
                    <input type='hidden' name='ref' value='$id' />
                    <br>
                    <input type='submit' name='submit' value='Soumettre' id='envoyer' />
                    </form>";
						
					}
						
				   
				   echo"<form method='post' action='gererProduit.php'>
                    <input type='submit' value='Retour' id='envoyer'/>
                 </form>";
				 
						
            ?>
        
        <footer> Adresse : Palo Alto , Californie</br>
                    Numéro : 09-38-75-84-10
        </footer>
        
    </body>
</html>
<?php //affiche un message d'alerte s'il en existe un (positif ou d'erreur)
    if(isset($_GET["message"])){
            echo "<script id='message' >alert('".$_GET["message"]."')</script>";
    }
?>
