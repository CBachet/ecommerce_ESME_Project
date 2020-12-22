 <?php
    session_start();//recuperation de la variable de session
    include("traitementSQL.php");//recuperation des fonction sql
    include("traitementConnexion.php");//recuperation des fonction de connexion
    
    if(isset($_POST["traitement"])){//verification de s'il y a une demande
        //si la demande est de supprimer un produit
        if($_POST["traitement"]=="Supprimer produit"){
            $message=supprimerProduit($_POST["num"]);
            $lieu="./gererProduit.php";
            
        }elseif($_POST["traitement"]=="Modifier produit"){//si la demande est de modifier un produit
             
            $message=modifierProduit($_POST["num"],$_POST["nom"],$_POST["categorie"],$_POST["marque"],$_POST["stock"],$_POST["prix"],$_POST["TVA"],$_POST["description"]);
            $lieu="./".$_POST['retour'];
            
        }elseif($_POST["traitement"]=="Ajouter produit"){//si la demande est d'ajouter un produit
             
            $message=ajouterProduit($_POST["nom"],$_POST["categorie"],$_POST["marque"],$_POST["stock"],$_POST["prix"],$_POST["TVA"],$_POST["description"]);
            $lieu="./gererProduit.php";
            
        }elseif($_POST["traitement"]=="Connexion"){//si la demande est de s'identifier sur le site
         
            $message=connexion($_POST["login"],$_POST["mdp"],$_POST["type"]);
            $lieu="./home.php";
            
        }elseif(($_POST["traitement"]=="Deconnexion") && (isset($_SESSION["type"]))){//si la demande est de se deconnecter du site
            
            deconnexion();
            $message="Vous êtes bien déconnecté.";
            $lieu="./home.php";
            
        }elseif($_POST["traitement"]=="Valider commande"){//si la demande est de valiser sa commande
            $message=commander($_POST['prix'],$_POST['count']);
            $lieu="./home.php";
			
        }elseif ($_POST["traitement"]=="Modifier") { //si la demande est de modifier un client

            $message=modifierClient($_POST["id"],$_POST["Nom"],$_POST["Prenom"],$_POST["Tel"],$_POST["Rue"],$_POST["CP"],$_POST["Ville"],$_POST["Situation"],$_POST["sexe"],$_POST["email"],$_POST["mdp"],$_POST["cmdp"]);
            $lieu="./client.php";

        }
       
    }else{//si aucune demande
        $lieu="./home.php";
        $message="Erreur";
    }
    
    header("location: ".$lieu."?message=".$message); //retourne a l'endroit demandé apres le traitement et delivre un message associé
                            
?>

