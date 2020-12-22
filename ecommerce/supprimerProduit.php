<?php
    session_start(); //pour recuperer les variables de session
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Suppression du produit <?php echo $_POST['num'] ?></title>
        <link rel="stylesheet"  href="homecss.css"/>
	<link rel="icon" type="image/png" href="logo.png"/>
    </head>
    
    
    <body>
        <header><img id="logo" src="logo.png" alt=""/>
                   
            <p id="titre" align="center">OSI</p>
            </br>

        </header>
         </br>
        
        
         <?php
         //pour ajouter la barre de navigation
                    include("navigation.php");
                ?>
        

        <?php 

                include("database.php");//connexion a la DB
                if(isset($_POST["submit"])){
                        if($_POST["submit"]=="Supprimer"){
                            /////
                            $num=$_POST["num"];
                            $req = "select num_produit,nom_produit,stock from produit WHERE num_produit='$num'";
                            $result = mysqli_query($base,$req);
                            $produit= mysqli_fetch_assoc($result);//recuperation d'information du produit choisi
                            $stock=$produit["stock"];
                            $retour=$_POST["retour"];
                            if($retour != "gererProduit.php"){
                                $retour.="&";
                            }else{
                                $retour.="?";
                            }

                             if($stock==0){//test si le stock du produit est bien nul
                                 //message de confirmation pour la suppression du produit.
                                echo"<h3> êtes vous sûr de vouloir supprimer le produit ".$produit["nom_produit"]."?<h3>"
                                        . "<form method='post' action='traitement.php'>
                            <input type='hidden' name=num value=".$_POST["num"]."/>
                            
                            <input type='submit' name='traitement' value='Supprimer produit' id='envoyer'/>
                           </form>
                           <form method='post' action='gererProduit.php'>
                               <input type='submit'  value='Retour' id='envoyer'/>
                           </form>";

                            }else{
                                //message d'erreur car stock pas nul
                                $message="vous ne pouvez pas supprimer le produit ".$produit["nom_produit"]." car il en reste ".$produit["stock"]." en stock.";
                                 header("location: ./$retour"."message=".$message);//message renvoyé sur la page de gestion des produit

                            }
                        }
                }
             ?>
         
        <footer> Adresse : Palo Alto , Californie</br>
                  Numéro : 09-38-75-84-10
        </footer>        
    </body>
</html>



