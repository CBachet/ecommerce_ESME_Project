<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Modifier produit</title>
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

    include("database.php");//connection BD
    if(isset($_POST["submit"])){
        if($_POST["submit"]=="Modifier"){
            //page de modification
            
            $num=$_POST["num"];
            $req = "select * from produit WHERE num_produit='$num'";
            $result = mysqli_query($base,$req);
            $produit= mysqli_fetch_assoc($result);
            $num=$produit["num_produit"];
            $nom=$produit["nom_produit"];
            $categorie=$produit["categorie"];
            $marque=$produit["marque"];
            $stock=$produit["stock"];
            $prix=$produit["prix"];
            $TVA=$produit["TVA"];
            $description=$produit["description"];
            $retour=$_POST["retour"];

            //affiche les champs avec les valeurs actuelles à l'interieur
            echo"<h2>Modifier les informations du produit $num : </h2> </br>";
            echo"<form method='post' action='traitement.php'>
                    <fieldset>
                        <legend>Modifier produit</legend>

                        <label for='nom'> Libellé du produit: </label>
                        <input type='text' name='nom' value='$nom' pattern='[A-Za-z]{3,}' required/><a class='obligatoire'>*</a></br> </br>

                        <label for='categorie'> Catégorie: </label>
                        <select name='categorie' required>
                            <option value='$categorie' selected>$categorie</option>
                            <option value='PC'>PC</option>
                            <option value='imprimante'>imprimante</option>
                            <option value='scanner'>scanner</option>
                        </select><a class='obligatoire'>*</a></br> </br>

                        <label for='marque'> Marque: </label>
                        <select name='marque' required>
                            <option value='$marque' selected>$marque</option>
                            <optgroup label='PC'>
                                <option value='Acer'>Acer</option>
                                <option value='Asus'>Asus</option>
                                <option value='Dell'>Dell</option>
                            </optgroup>
                            <optgroup label='imprimante'>
                                <option value='Canon'>Canon</option>
                                <option value='Epson'>Epson</option>
                                <option value='HP'>HP</option>
                            </optgroup>
                            <optgroup label='scanner'>
                                <option value='Canon'>Canon</option>
                                <option value='Epson'>Epson</option>
                                <option value='Fujitsu'>Fujitsu</option>
                            </optgroup>
                        </select><a class='obligatoire'>*</a></br> </br>

                        <label for='stock'> Quantité en stock: </label>
                        <input type='text' name='stock' value='$stock' pattern='^[0-9]+' required/><a class='obligatoire'>*</a> </br> </br>

                        <label for='prix'> Prix unitaire(€): </label>
                        <input type='text' name='prix' value='$prix' pattern='^[0-9]+' required/><a class='obligatoire'>*</a> </br> </br>

                        <label for='TVA'> TVA: </label>
                        <input type='text' name='TVA' value='$TVA' pattern='^[0-9]+'/> </br> </br>

                        <label for='description'> Description: </label></br>
                        <textarea name='description'  rows='3' cols='30'>$description</textarea> </br> </br>

                     </fieldset>
                     <input type='hidden' name=num value='$num'/>
                     <input type='hidden' name='retour' value='$retour'/>

                     <input type='submit' name='traitement' value='Modifier produit' id='envoyer'/>

                </form>";//envoie ce formulaire dans traitement.php
                   
                                  
                    echo"<form method='post' action='$retour'>
                    <input type='submit'  value='Retour' id='envoyer'/>
                 </form>";
        }
    }
?>
        <footer> Adresse : Palo Alto , Californie</br>
                Numéro : 09-38-75-84-10
        </footer>
        
    </body>
</html>

