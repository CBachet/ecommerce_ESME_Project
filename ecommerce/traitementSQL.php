<?php

    function supprimerProduit($num){ //fct pour supp les produits
        include("database.php");

        $num=$_POST["num"];

        $req = "DELETE FROM produit WHERE num_produit='$num'";
        if (mysqli_query($base, $req)){
            $message = 'Produit supprimé.'; 
        }else{
            $message = "Erreur lors de la suppression du produit.";
        }
        return $message;
    }
    
    function modifierProduit($num,$nom,$categorie,$marque,$stock,$prix,$TVA,$desc){  //fct pour modifier les produits
        include("database.php");
        $req="update produit 
                SET 
                nom_produit='$nom' ,
                categorie='$categorie',
                marque='$marque',
                stock='$stock',
                prix='$prix',
                TVA='$TVA',
                description='$desc'
                WHERE num_produit='$num'
              ";
        if(mysqli_query($base, $req)){
            $message=" produit $num modifié ";
        }else{
            $message = "Erreur de modification du produit $num.";
        }
        return $message;             
    }
    
    function ajouterProduit($nom,$categorie,$marque,$stock,$prix,$TVA,$desc){  //fct pour ajouter un produit à la base de donnée
        include("database.php");
        $req="INSERT INTO 
                    `produit`( `nom_produit`, `categorie`, `marque`, `stock`, `prix`, `TVA`, `description`) 
             VALUES ('$nom','$categorie','$marque','$stock','$prix','$TVA','$desc')";
        if(mysqli_query($base, $req)){
            $message="Produit enregistré.";
        }else{
            $message = "Erreur lors de l\'enregistrement du produit.";
        }
        return $message;
    }
	
	

    function commander($prix,$nbProduits){  //fct pour commander notre liste de produit
        include("database.php");
        $client=$_SESSION['id'];
        $produit=$_SESSION['panier'];
        
        $panier=explode('@',$_SESSION['panier']);
        
        $indexPanier=1;
        while(isset($panier[$indexPanier])){
            $panier[$indexPanier]=explode('/',$panier[$indexPanier]);
            
            $req = "select stock from produit where num_produit=".$panier[$indexPanier][0];
            $result=mysqli_query($base, $req);
            $stock= mysqli_fetch_assoc($result)['stock'];
            
            
            if($panier[$indexPanier][1]>$stock){
                $err="certains produit ne sont pas passé dans la commande.";
                $nbProduits-=($panier[$indexPanier][1]-$stock);
                $panier[$indexPanier][1]=$stock;
                $stock=0;
                $err.= $panier[$indexPanier][1]."//".$stock   ;
            }else{
                $stock-=$panier[$indexPanier][1];
            }

        //Préparation de la requête
        $req ="Update produit SET stock= ? WHERE num_produit= ?";

		$res = mysqli_prepare($base,$req);
		//liaison des paramètres 
		$var = mysqli_stmt_bind_param($res, 'ii', $qtt,$prod);
		$qtt = $stock ;
		$prod = $panier[$indexPanier][0];
		$var = mysqli_stmt_execute($res); // exécution de la requête
		if($var == false) $message= "echec de l'ex\écution de la requ\ête.".mysqli_stmt_error() ;
		else $message="produit enregistrée ";
		mysqli_stmt_close($res);
           
             $indexPanier++;
        }

        $i=1;
        while($i<$indexPanier){
           
            if(isset($pcommande)){
                $pcommande.="@".$panier[$i][0]."/".$panier[$i][1];
            }else{
                $pcommande="@".$panier[$i][0]."/".$panier[$i][1];
            }
            
            $i++;
        }
               
        $t=time(); // pour recuperer le temps actuel
        $d=date('Y-m-d',$t);
        $_SESSION["panier"]='';
        $req="INSERT INTO `commande`( `client`, `nombre_article`, `produits`, `prix_tot`,date) 
              VALUES ($client,$nbProduits,'$pcommande',$prix,'$d')";//a mettre un current time
        
        if(mysqli_query($base, $req)){
            $message="Commande enregistré.";
        }else{
            $message = "Erreur lors de l\'enregistrement de la commande.";
        }    
            
        return $message;
    }
	
	function modifierClient($id,$nom,$prenom,$telephone,$rue,$cp,$ville,$situation_familiale,$sexe,$email,$password,$cpassword){ //modif le client dans la base de donnee
        include("database.php");

        if ($password == $cpassword){
            $req="UPDATE personne 
                    SET
                    nom='$nom',
                    prenom='$prenom',
                    email='$email',
                    password='$password',
                    telephone='$telephone',
                    rue='$rue',
                    ville='$ville',
                    cp='$cp',
                    
                    sexe='$sexe',
                    situation_familiale='$situation_familiale'
                    WHERE num_id='$id'
                    ";
            if(mysqli_query($base, $req)){
                $message="Client ".$prenom." ".$nom." modifié ";
            }else{
                $message = "Erreur de modification du client"." ".$id." ".$nom." ".$prenom." ".$telephone." ".$rue." ".$cp." ".$ville." ".$situation_familiale." ".$sexe." ".$email." ".$password." ".$cpassword;
            }
        }
        else{
            $message = "Les mots de passe ne sont pas identiques";
        }

        return $message;             
    }
?>
