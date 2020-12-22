<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>ecommerce OSI</title>
        <link rel="stylesheet"  href="homecss.css"/>
	<link rel="icon" type="image/png" href="logo.png"/>
    </head>
    
    
    <body>
        <header><img id="logo" src="logo.png" alt=""/>
                   
            <p id="titre" align="center">OSI</p>
            </br>

        </header>
        
       
        <nav>Navigation: //<a href="home.php">HOME</a>// //VOIR PROD?// //<a href="authentification.php">AUthentification</a>// <a href="sql.php">re</a></br> 
            mana://<a href="index.php">HOME</a>// //<a href="gererProduit.php">GERER PRODUIT</a>// //CONSULTER CLIENTS?// 
            <?php 
                if(isset($_SESSION['type']))///enlever/puis mettre dans la barre de nav
                            {
                            echo "<form method='post' action='traitement.php'>
                <input type='submit' name='traitement' value='Deconnexion'/>
            </form> </BR> </BR>";
            }

                ?></BR>
            client: //HOME// //VOIR PRODUIT// //<a href="panier.php"> Mon panier </a>// //MON COMPTE// //DECONNEXION//
        </nav>
        
        
        <?php
                header("location: ./sql.php");//va nous rediriger directement vers la formation de la base de donnee
            ?>
        
        <footer> Adresse : Palo Alto , Californie</br>
                    Numéro : 09-38-75-84-10
          </footer>
        
    </body>
</html>
