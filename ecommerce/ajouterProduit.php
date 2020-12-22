<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Ajouter produit</title>
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
    if(isset($_POST["submit"])){
                
                if($_POST["submit"]=="Ajouter produit"){
                    //Affiche un formulaire permettant au manager d'ajouter un produit. 
                    ////
                    echo"<h2 align='center'>Rentrer les informations du nouveau produit  </h2> </br>";
                    echo"<form method='post' action='traitement.php'>
                    <fieldset>
                        <legend><h3>Nouveau produit: </h3></legend>

                        <label for='nom'> Libellé du produit: </label>
                        <input type='text' name='nom' placeholder='3 caracteres mini' pattern='[A-Za-z]{3,}' required/><a class='obligatoire'>*</a> </br> </br>

                        <label for='categorie'> Catégorie: </label>
                        <select name='categorie' required>

                            <option value='PC'>PC</option>
                            <option value='imprimante'>imprimante</option>
                            <option value='scanner'>scanner</option>

                        </select><a class='obligatoire'>*</a></br> </br>

                        <label for='marque'> Marque: </label>
                        <select name='marque' required>
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
                                <option value='HP'>HP</option>
                                <option value='Fujitsu'>Fujitsu</option>
                            </optgroup>
                        </select><a class='obligatoire'>*</a></br></br> </br>

                        <label for='stock'> Quantité en stock: </label>
                        <input type='text' name='stock' pattern='^[0-9]+' required/><a class='obligatoire'>*</a> </br> </br>

                        <label for='prix'> Prix unitaire(€): </label>
                        <input type='text' name='prix' pattern='^[0-9]+' required/><a class='obligatoire'>*</a> </br> </br>

                        <label for='TVA'> TVA: </label>
                        <input type='text' name='TVA' pattern='^[0-9]+' required/><a class='obligatoire'>*</a> </br> </br>

                        <label for='description'> Description: </label><a class='obligatoire'>*</a></br>
                        <textarea name='description'  rows='3' cols='30' required></textarea> </br> </br>

                     </fieldset>
                     <br>
                    <input type='submit' name='traitement' value='Ajouter produit' id='envoyer' style='position : relative; left:39%; '/>

                </form>";//envoie du formulaire dans traitement.sql pour gerer l'ajout
                }
                
                //affiche un bouton pour revenir sur la page precedente: celle de gestion des produits
                echo"<form method='post' action='gererProduit.php'>
                        <input type='submit' value='retour' id='envoyer' style='position : relative; left:53%; top:-60px;'/>
                    </form>";  
    }
?>
        <footer> Adresse : Palo Alto , Californie</br>
                          Numéro : 09-38-75-84-10
        </footer>
        
    </body>
</html>

