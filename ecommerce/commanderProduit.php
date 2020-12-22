<?php 
    session_start();//pour utiliser les variables de session
    include("database.php");//pour se connecter a la base de donnée
    
    $req = "select stock from produit WHERE num_produit='".$_POST['num']."'";
    $result = mysqli_query($base,$req);
    $produit= mysqli_fetch_assoc($result);
    $retour=$_POST["retour"];
    if($retour != "gererProduit.php"){
        $retour.="&";
    }else{
        $retour.="?";
    }
                    
    if($_POST['qtt']<=$produit['stock'] && $_POST['qtt']!=0){//verifie que la qtt de produit voulue est comprise dans le stock disponible
        $_SESSION['panier'].="@".$_POST['num']."".$_POST['qtt'];//met la commande dans la variable de session panier
    
        header("location: ./panier.php");//si tout est bon redirige le client vers son panier
    
    }else{//si probleme retourne a la page d'avant et renvoie un message d'erreur
        header("location: ./$retour"."message=Nombre d\'article command\é non valide.");
    }    
?>
    
        
