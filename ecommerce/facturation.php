<?php 
    session_start(); //pour utiliser les variables de session
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Facturation</title>
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

         
             include("database.php");//se connecter à la DB
            
            if(isset($_POST["submit"])){
				
				$id=$_SESSION["id"];
				$req = "select * from personne where num_id='$id'"; //recuperation des infos de l'utilisateur
				$result = mysqli_query($base,$req);
				$personne= mysqli_fetch_assoc($result);
						
				echo"<h2 align='center'>Facture: </h2> 
                <hr>";
                echo" <div style='position : relative; left:8%;'><br> <br> <br> ORDINATEUR SCANNER IMPRIMENTE (OSI)
                 <br>Palo Alto 
                 <br>Californie
                 <br>09-38-75-84-10
                 <br> manager.osi@gmail.com<br> <br> <br> <br> 
                 </div>";
			echo"<div style='position : relative; left:75%;'>";			
				if(isset($personne['sexe']) && $personne['sexe']=='H'){
				echo "</br>Mr  ";
				}elseif(isset($personne['sexe']) && $personne['sexe']=='F'){
				echo "</br>Mme  ";
				}
               echo $personne['nom']." ".$personne['prenom'];
				echo"</br>Email: ".$personne['email']."</br>
             
             Numéro de téléphone: ".$personne['telephone'].
            
             "</br>Adresse: ".$personne['rue']."  ".
             $personne['cp']."   ".
             $personne['ville']." </br>";
			if(isset($personne['naissance'])){
				echo "Date de naissance: ".$personne['naissance']." ";
            }
			
				
            $panier=explode('@',$_SESSION['panier']);//va separer la variable panier de la session dan s$panier
            $indexPanier=1; //1 car le premier caractere de panier est @
            $indexProduit=0;

            
            while(isset($panier[$indexPanier])){ //resepare les valeur de panier pour avoir: numproduit qtt
            $panier[$indexPanier]=explode('/',$panier[$indexPanier]);
                
                $indexPanier++;
            }
 
           $req = "select num_produit,nom_produit,prix,stock,TVA from produit ";
            $result = mysqli_query($base,$req);
            while($row= mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $prod[$indexProduit]=$row;
                $indexProduit++;
            }//on a un tableau avec tte les valeur de la DB
             echo"</div><br> <br> <br> <br>";

            
          
            //tableau recapitulatif de la commande
            $count=0;
           
            echo "
                <table align='center'>
                    <tr>
                        <th colspan ='5'><h3> Produit achetés</h3></th>
                    </tr>
                    <tr>
                        <td>Reference</td>
                        <td>Produit</td>
                        <td>Prix unitaire</td>
                        <td>Quantitée voulue</td>
                        <td>Prix TTC</td>
                    </tr>";
            //affiche tous les produits commandés
            for($i=1;$i<($indexPanier);$i++){
                
                $count+=$panier[$i][1];
                for($k=0;$k<$indexProduit;$k++){
                    if($prod[$k]["num_produit"]==$panier[$i][0]){
                        $numProd=$k;
                    }
                    
                }
                
                echo"
                        <tr>
                            <td>".$prod[$numProd]["num_produit"]."</td>
                            <td>".$prod[$numProd]["nom_produit"]."</td>
                            <td>".($prod[$numProd]["prix"]*(1+($prod[$numProd]["TVA"])/100))."€</td>
                            <td>".$panier[$i][1]."</td>
                            <td>".($prod[$numProd]["prix"]*(1+($prod[$numProd]["TVA"])/100)*$panier[$i][1])."€</td>
                        </tr>
                     ";
            }   
                echo"</table> </br>";
				
				//affiche un total
                echo"<h3 style='position : relative; left:75%;'>Prix de la commande : ".$_POST['prix']."€</h3>";
                
                //bouton pour aller gerer le traitement de la commande dans la base donnée
                echo"<form method='post' action='traitement.php' ></br>
                        <input type='hidden' name='prix' value=".$_POST['prix']." />
                        <input type='hidden' name='count' value=".$_POST['count']." />
                        <input type='submit' name='traitement' value='Valider commande' id='envoyer' style='position : relative; left:35%;'/>
                </form>";
                
            }
             echo"<form method='post' action='gererProduit.php'>
                    <input type='submit'  value='Retour' id='envoyer' style='position : relative; left:52%; top:-60px;'/>
                </form>";

           
        ?>
        
        <footer> Adresse : Palo Alto , Californie</br>
                  Numéro : 09-38-75-84-10
        </footer>
        
    </body>
</html>
