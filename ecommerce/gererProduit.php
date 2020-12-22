<?php 
    session_start();//pour utiliser les variables de sessions
    include("database.php");//pour se connecter a la BD
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Produit</title>
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
           
                    //recherche, selon l'utilisateur
     
                    echo"<div align='center'>
                        <table >
                            <tr>
                                <th colspan ='5'><h3> Rechercher un produit?</h3></th>
                            </tr>
                            <tr>
                                <td id='produit'>Reference</td>
                                <td id='produit'>Libellé</td>
                                <td id='produit'>Catégorie</td>
                                <td id='produit'>Marque</td>";
            
                    if(isset($_SESSION['type']) && $_SESSION['type']=='client'){ //le client peut effectuer une recherche par prix
                        echo"   <td id='produit'>Prix</td>";
                    }
            
                    echo"
                                
                            </tr>
                            <tr>";
            
                    echo"<form method='post' action='filtreProduit.php'>";

                    //affiche les champs/valeurs selon s'il y a une recherche ou non
                    if(isset($_GET['Reference'])){ //si une reference est rentrée
                        $C1=$_GET['Reference'];
                        echo"<td id='produit'><input type='text' name='reference' value='$C1'/></td>";
                    }else{
                        echo"<td id='produit'><input type='text' name='reference'/></td>";
                    }

                    if(isset($_GET['Libelle'])){ //si un nom de produit est rentré
                        $C2=$_GET['Libelle'];
                        echo"<td id='produit'><input type='text' name='libelle' value='$C2'/></td>";
                    }else{
                        echo"<td id='produit'><input type='text' name='libelle'/></td>";
                    }

                    if(isset($_GET['Categorie'])){ //si une categorie de produit est rentrée
                        $C3=$_GET['Categorie'];
                        echo"<td id='produit'><select name='categorie' >
                                    <option value='$C3' selected>$C3</option>
                                    <option ></option>
                                    <option value='PC'>PC</option>
                                    <option value='imprimante'>imprimante</option>
                                    <option value='scanner'>scanner</option>
                                 </select></td>";
                    }else{
                        echo"<td id='produit'><select name='categorie' >
                                    <option selected></option>
                                    <option value='PC'>PC</option>
                                    <option value='imprimante'>imprimante</option>
                                    <option value='scanner'>scanner</option>

                                </select></td>";
                    }
                    

                    if(isset($_GET['Marque'])){ //si la marque d'un produit est rentrée
                        $C4=$_GET['Marque'];
                        echo"<td id='produit'><select name='marque'>
                                <option value='$C4' selected>$C4</option>
                                <option ></option>
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
                                </select></td>";
                    }else{
                        echo"<td id='produit'><select name='marque'>
                                <option  selected></option>
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
                                </select></td>";
                    }
                    
                    if(isset($_SESSION['type']) && $_SESSION['type']=='client'){ //si un client choisi l'affichage selon le prix
                       if(isset($_GET['Prix'])){
                            if($_GET['Prix']=='asc'){
                                $C5="Du moins chère au plus chère";
                            }elseif($_GET['Prix']=='desc'){
                                $C5="Du plus chère au moins chère";
                            }else{
                                $C5='';
                            }
                            
                            echo"<td id='produit'><select name='prix'>
                                        <option value='$C5' selected>$C5</option>
                                        <option ></option>
                                        <option value='asc'>Du moins chère au plus chère</option>
                                        <option value='desc'>Du plus chère au moins chère</option>
                                   </select></td>";
                        }else{
                            echo"<td id='produit'><select name='prix'>
                                        <option  selected></option>
                                        <option value='asc'>Du moins chère au plus chère</option>
                                        <option value='desc'>Du plus chère au moins chère</option>
                                    </select></td>";
                        } 
                    }
                    
                    //pour le bouton de la recherche
                    echo"<td id='produit'><input type='submit' name='submit' value='Rechercher' id='envoyer'/> </form></td>

                    </tr>
                </table>
                </div>";
         
            
                    //prepare la requete sql avec les criteres renseigné avec la methode get (criteres de recherche/de tri produits)
                    if(isset($_GET['Reference']) && $_GET['Reference']!=''){
                        $where=" WHERE num_produit=".$_GET['Reference'];
                    }  

                    if(isset($_GET['Libelle']) && $_GET['Libelle']!=''){
                        if(isset($where)){
                            $where.=" AND nom_produit LIKE '%".$_GET['Libelle']."%'"; //concatene tout dans where si un critere existe deja
                        }else{
                            $where=" WHERE nom_produit LIKE '%".$_GET['Libelle']."%'";
                        }       
                    }

                    if(isset($_GET['Categorie']) && $_GET['Categorie']!=''){
                        if(isset($where)){
                            $where.=" AND categorie LIKE '%".$_GET['Categorie']."%'"; //concatene tout dans where si un critere existe deja
                        }else{
                            $where=" WHERE categorie LIKE '%".$_GET['Categorie']."%'";
                        }       
                    }

                    if(isset($_GET['Marque']) && $_GET['Marque']!=''){
                        if(isset($where)){
                            $where.=" AND marque LIKE '%".$_GET['Marque']."%'"; //concatene tout dans where si un critere existe deja
                        }else{
                            $where=" WHERE marque LIKE '%".$_GET['Marque']."%'";
                        }       
                    }

                    
                    if((isset($_SESSION['type']) && $_SESSION['type']!='manager') || !isset($_SESSION['type']) ){ //si l'utilisateur n'est pas le manager, ne pas afficher les produits sans stock
                        if(isset($where)){
                            $where.=" AND  stock >0"; 
                        }else{
                            $where=" WHERE stock >0";
                        }       
                    }
                    
                    //si pas de critere initialise qd mm where pour tt prendre 
                    if(!isset($where)){
                        $where='where 1';
                    }
                
                    //pour trier les articles par prix
                    if(isset($_GET['Prix']) && $_GET['Prix']!=''){

                            $where.=" ORDER BY prix ".$_GET['Prix'];

                    }

                    $req = "select * from produit ".$where; //aller chercher toutes les informations des produits avec les criteres ci-dessus
                    $result = mysqli_query($base,$req);
               
                    //creation du tableau contenant tous les produits
                    echo"
                    <div align='center'>
                    <table align='center'>
                        <tr>
                            <th colspan ='9'>Produits</th>
                        </tr>
                        <tr>
                            <td id='produit'>Reference</td>
                            <td id='produit'>Libellé</td>
                            <td id='produit'>Catégorie</td>
                            <td id='produit'>Marque</td>
                            <td id='produit'>Quantité en stock</td>
                            <td id='produit'>Prix</td>
                            <td id='produit'>Description</td>";
                    
                    //colonnes specifiques pour client ou manager
                    if(isset($_SESSION['type']) && $_SESSION['type']=="manager"){
                        echo"
                            <td id='produit'>Modifier</td>
                            <td id='produit'>Supprimer</td>";
                    }elseif(isset($_SESSION['type']) && $_SESSION['type']=="client"){
                        echo"
                            <td id='produit'>Quantité commandée</td>
                            ";
                    }
                
                    echo"       </tr>";
                
                    //afficher les differentes infos du produits (contenue dans $ligne)
                    while($ligne= mysqli_fetch_assoc($result)){
                        $num=$ligne["num_produit"];
                        echo " <tr> <td> $num </td>
                            <td id='produit'> <a href='produit.php?produit=$num'>". $ligne["nom_produit"] ."</a></td>
                            <td id='produit'> ". $ligne["categorie"]."</td>
                            <td id='produit'> ". $ligne["marque"]. " </td>
                            <td id='produit'> ". $ligne["stock"]. " </td>
                            <td id='produit'> ". ($ligne["prix"]*(1+($ligne["TVA"])/100)). "€ </td>
                            <td id='produit'> ". $ligne["description"]. " </td>";
                        
                        //affiche les formulaires specifiques aux types mana et client
                        if(isset($_SESSION['type']) && $_SESSION['type']=="manager"){ //modifier et supprimer produit 

                            echo"
                            <td id='produit'> <form method='post' action='modifierProduit.php'> 
                                  <input type='hidden' name='num' value=$num/>
                                  <input type='hidden' name='retour' value='gererProduit.php'/>
                                  <input type='submit' name='submit' value='Modifier' id='envoyer'/>
                                 </form>
                            </td>
                            <td id='produit'> <form method='post' action='supprimerProduit.php'>
                                  <input type='hidden' name='retour' value='gererProduit.php'/>
                                  <input type='hidden' name='num' value=".$ligne["num_produit"]."/>
                                  <input type='submit' name='submit' value='Supprimer' id='envoyer'/>
                                 </form>
                            </td> ";  

                        }elseif(isset($_SESSION['type']) && $_SESSION['type']=="client"){ //commander un produit
                            echo"

                            <td id='produit'> <form method='post' action='commanderProduit.php'>
                                    <input type='text' name='qtt' /> 
                            </td>
                                    <input type='hidden' name='retour' value='gererProduit.php'/>
                                    <input type='hidden' name='num' value=$num/>
                            <td id='produit' >  
                                    <input type='submit' name='commande' value='Commander' id='envoyer'/>
                            </td> 
                                 </form>
                                  "; 
                        }
                    }
                    
                    echo"    </tr> 
                    </table></br>
                    </div>";
                
                    //pour le manager: affiche un bouton permettant d'ajouter un produit (pour le manager) 
                    if(isset($_SESSION['type']) && $_SESSION['type']=="manager"){
                        echo"
                    <form method='post' action='ajouterProduit.php' align='center'>
                        <input type='submit' name='submit' value='Ajouter produit' id='envoyer' />
                    </form>";
                    }
   
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
      

