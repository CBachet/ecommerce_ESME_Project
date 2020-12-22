<?php

    function connexion($login,$mdp,$type){ //fonction pour se connecter et creer ttes les variables de session
        
        include("database.php");

        $req="select num_id, type, email, password, nom, prenom from personne where email='$login'";
        $result = mysqli_query($base,$req);
        if($result == true){
            $personne= mysqli_fetch_assoc($result);

            if($login==$personne['email'] && $type==$personne['type']){//si le login et le type concorde
                if($mdp==$personne['password']){//et si le mdp est bon
                    session_start();//creation de la session
                    //et des variables de session
                   $_SESSION['id']=$personne['num_id'];
                   $_SESSION['type']=$personne['type'];
                   $_SESSION['panier']='';
				   $_SESSION['nom']=$personne['nom'];
				   $_SESSION['prenom']=$personne['prenom'];
				   
				  if(isset($_SESSION['panier'])){
                       $message="connexion réussite";
                   }else{//sinon message d'erreur
                       $message="connexion erreur";
                   } 
                }else{
                   $message="Mot de passe incorrect.";
                }
            }else{
                $message="Aucun compte associé à cette adresse mail.";
            }

        }else{
           $message='Probleme de connection à la base de donnée';
        }         
    
    return $message;
   
    }
    
    function deconnexion(){//supprime ts le elements de la session et la ferme
        session_destroy();
        unset($_SESSION);
    }
    
?>

