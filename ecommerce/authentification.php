<?php
    session_start();// a mettre ds la plupart des pages   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Authentification</title>
        <link rel="stylesheet"  href="homecss.css"/>
        <link rel="icon" type="image/png" href="logo.png"/>
    </head>
    
    
    <body>
        <header><img id="logo" src="logo.png" alt=""/>
                   
            <p id="titre" align="center">OSI</p>
            </br>
                   
        </header></br>
        
         <?php
         //pour ajouter la barre de navigation
                    include("navigation.php");
                ?>
        </br>
        <form method='post' action='traitement.php' align= "center">
            <!-- va verifier les informations necessaires pour l'authentification d'un manager ou d'un client-->
            <fieldset>
                <legend ><h3>Vous êtes ?</h3> </legend> 
                    <input type="radio" name="type" value="manager" required/> Manager 
                    
                    <input type="radio" name="type" value="client"/> Client
                    <br>
                    </br>
                    <hr>
            </br>

                <label for='login'> Adresse email: </label> <!-- renseigner l'adresse mail/le login-->
                <input type='text' name='login' required/> </br> </br>

                <label for='mdp'> Mot de passe: </label> <!-- renseigner le mot de passe-->
                <input type='password' name='mdp' required/> </br> </br>
            </fieldset>
            <br>
            <input type='submit' name='traitement' value='Connexion' id='envoyer' style='position : relative; left:-6%; '/> 
        </form>
            
        <!-- bouton pour revenir sur la page home-->
        <form method='post' action='home.html' style="position : relative; left:52%; top:-60px; ">
            <input type='submit' value='Retour' id='envoyer'/>
        </form> 
        
        <footer> Adresse : Palo Alto , Californie</br>
                    Numéro : 09-38-75-84-10
        </footer>
        
    </body>
</html>
<?php 
    //va afficher un message d'erreur s'il y a un probleme lors de la correction
    if(isset($_GET["message"])){
            echo "<script id='message' >alert('".$_GET["message"]."')</script>";
    }
?>
