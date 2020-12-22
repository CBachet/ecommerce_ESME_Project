<?php
   //si on filtre/recherche des produits avec les criteres:
    //recherche avec la reference du produit
    if(isset($_POST['reference']) && $_POST['reference']!=''){
        $C1=$_POST['reference'];
        $req="?Reference=".$C1;//concatene la recherche dans la variable $req 
    }
    
    //recherche avec le libelle du produit
    if(isset($_POST['libelle']) && $_POST['libelle']!=''){
        $C2=$_POST['libelle'];
        if(isset($req)){
            $req.="&Libelle=".$C2;//concatene la recherche dans la variable $req
        }else{
            $req="?Libelle=".$C2;
        }       
    }
    
    //recherche avec la categorie du produit
    if(isset($_POST['categorie']) && $_POST['categorie']!=''){
        $C3=$_POST['categorie'];
        if(isset($req)){
            $req.="&Categorie=".$C3;//concatene la recherche dans la variable $req
        }else{
            $req="?Categorie=".$C3;
        }       
    }
    
    //recherche avec la marque du produit
    if(isset($_POST['marque']) && $_POST['marque']!=''){
        $C4=$_POST['marque'];
        if(isset($req)){
            $req.="&Marque=".$C4;//concatene la recherche dans la variable $req
        }else{
            $req="?Marque=".$C4;
        }    
    }
    
    //tri en fonction du prix du produit
    if(isset($_POST['prix']) && $_POST['prix']!=''){
        $C5=$_POST['prix'];
        if(isset($req)){
            $req.="&Prix=".$C5;//concatene la recherche dans la variable $req
        }else{
            $req="?Prix=".$C5;
        }    
    }
    
    if(!isset($req)){
            $req='';
        }
    
    header("location: ./gererProduit.php".$req);//retourne sur la page des produits avec la liste des criteres de tri
    
?>

