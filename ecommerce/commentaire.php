<?php
	session_start();
	include ('database.php');


	//Récupérer l'id du client qui veut soumettre le commentaire
	$num=$_SESSION["id"];

    $nom=$_SESSION["nom"];
    $prenom=$_SESSION['prenom'];
    $com=$_POST['commentaire'];
    $ref=$_POST['ref'];
    echo $ref;
    $sql= "INSERT INTO `commentaire`(`support`, `commentateur`, `message`) VALUES ($ref, $num, '$com')";
	mysqli_query($base,$sql);
    

	header("location: ./produit.php?produit=".$ref);



?>