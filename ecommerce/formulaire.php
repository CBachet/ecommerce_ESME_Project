<!DOCTYPE html>
<html > 

	<head>
        <meta charset="utf-8" />
        <meta name="author" content="Marine LOLLIOZ"/>
        <title >Inscription à OSI : </title>
        <link rel="icon" type="image/png" href="logo.png"/> <!--pour ajouter le logo-->
        <link rel="stylesheet"  href="homecss.css"/>

	</head>

	<body>
		<header><img id="logo" src="logo.png" alt=""/>

            </br>
            </br>
            <p id="titre" align="center">OSI</p>
            </br>
        </header>
            
                 <?php
                 //pour ajouter la barre de navigation
                                include("navigation.php");
                            ?>
            
            
                <br>
                <form align="center" action="inscription.php" method="POST">
                    <fieldset>
                        <legend>Coordonées : </legend>
                	    <label>Nom : </label>
                	    <input type="text" name="Nom" required/><a class="obligatoire">*</a>
                        <br>
                        <label>Prénom : </label>
                        <input type="text" name="Prenom" required/><a class="obligatoire">*</a>
                        <br>
                        <label>Numéro de téléphone : </label>
                        <input type="text" name="Tel"  required/><a class="obligatoire">*</a>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Adresse : </legend>
                        <label>Rue : </label>
                        <input type="text" name="Rue" required/><a class="obligatoire">*</a>
                        <br>
                        <label>Code Postal : </label>
                        <input type="text" name="CP" required/><a class="obligatoire">*</a>
                        <br>
                        <label>Ville : </label>
                        <input type="text" name="Ville" required/><a class="obligatoire">*</a>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Information : </legend>
                        <label>Sexe : </label>

                        <input type="radio" name="Sexe" value="F"/> Une femme 
                        
                        <input type="radio" name="Sexe" value="H"/> Un homme
                        <br>
                        <label>Situation familiale : </label>
                        <select name="Situation">
                            <option value= null>  </option>
                            <option value="celibataire"> Célibataire</option>
                            <option value="couple"> En couple</option>
                            <option value="marie"> Marié(e) </option>                           
                            <option value="divorse"> Divorsé </option>
                        </select>
                        <br>
                        <label>Date de naissance : </label>
                        <input type="Date" name="birthday" placeholder="JJ/MM/AAAA"/>
                    </fieldset>
                        <br>
                    <fieldset>
                        <legend>Connection : </legend>
                        <label>Mail : </label>
                        <input type="text" name="email" placeholder="Nom.Prenom@gmail.com" id="mail" required/><a class="obligatoire" >*</a>
                        <br>
                        <label>Mot de passe : </label>
                        <input type="password" name="mdp" placeholder="Exemple4s" required/><a class="obligatoire">*</a>
                        <br>
                        <label>Confirmation du mot de passe : </label>
                        <input type="password" name="cmdp" placeholder="Exemple4s" required/><a class="obligatoire">*</a>
                        <br>
                    </fieldset>
                    <br>
                    <input type="submit" name="submit" value="S'inscrire" id="envoyer" />
                </form>

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