<?php 
    session_start(); //pour recuperer les variables de session 
    include("database.php"); //se connecter a la database

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Clovis B Marine L"/>
        <title>Panier de commande</title>
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
             $panier=explode('@',$_SESSION['panier']);//va separer la variable panier de la session dan s$panier
             $indexPanier=1;//1 car le premier caractere de panier est @
             $indexProduit=0;

            
             while(isset($panier[$indexPanier])){//resepare les valeur de panier pour avoir: numproduit qtt
                $panier[$indexPanier]=explode('/',$panier[$indexPanier]);
                 
                 $indexPanier++;
             }
            
            
            
           $req = "select num_produit,nom_produit,prix,stock,TVA from produit ";
            $result = mysqli_query($base,$req);
            while($row= mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $prod[$indexProduit]=$row;
                $indexProduit++;
            }//on a un tableau avec tte les valeur de la DB
            
            
            
//           
            //tableau recapitulatif de la commande
            $count=0;
            $prixTotal=0;
            echo "
                    <table align='center'>
                        <tr>
                            <th colspan ='5'><h3> Votre panier</h3></th>
                            
                        </tr>
                        <tr>
                            <td>Reference</td>
                            <td>Libellé</td>
                            <td>Prix unitaire</td>
                            <td>Quantitée voulue</td>
                            <td>Prix TTC</td>
                        </tr>
                        ";
            //affiche tout les produit commandés
            for($i=1;$i<($indexPanier);$i++){
                
                $count+=$panier[$i][1];
                for($k=0;$k<$indexProduit;$k++){
                    if($prod[$k]["num_produit"]==$panier[$i][0]){
                        $numProd=$k;
                    }
                    
                }
                $prixTotal+=($prod[$numProd]["prix"]*(1+($prod[$numProd]["TVA"])/100)*$panier[$i][1]);
                
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
                //affiche un total
                echo"<tr><th >Total:</th><td colspan='2'></td><td>$count</td><td>$prixTotal €</td></tr>
                     </table> </br>";
            //amene a la page facture
             echo"<form method='post' action='facturation.php' style='position : relative; left:40%; ' >
                    <input type='hidden' name='prix' value=$prixTotal />
                    <input type='hidden' name='count' value=$count />
                    <input type='submit' name='submit' value='commande' id='envoyer'/>
                 </form>";
             //retour en arriere
             echo"<form method='post' action='gererProduit.php'  style='position : relative; left:52%; top:-60px;' >
                    <input type='submit'  value='Retour' id='envoyer'/>
                </form>";
        ?>
        
        <footer> Adresse : Palo Alto , Californie</br>
                  Numéro : 09-38-75-84-10
        </footer>
        
    </body>
</html>
