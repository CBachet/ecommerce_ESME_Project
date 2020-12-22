<?php

	 include("database.php");
	 $a=true;
	echo'
	<html>
	<head>
        <link rel="icon" type="image/png" href="logo.png"/>
        <link rel="stylesheet"  href="homecss.css"/>
		
	</head>
	<body>				
	<header><img id="logo" src="logo.png" alt=""/>
    </br>
    </br>
    <p id="titre" align="center">OSI</p>
    </br>
    </header>';
	$lieu="./formulaire.php";

	 if(!preg_match("#[A-Za-z]{2,15}#", $_POST['Nom']))
	 {
	 	$a=false;
	 	$message= "Le nom doit comporter au moins deux lettres ";
	 	//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";

	 }
	 elseif (!preg_match("#[A-Za-z]{2,}#", $_POST['Prenom']))
	 {
	 	$a=false;
	 	$message= "Le prénom doit comporter au moins deux lettres ";
	 	//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";
	 }
	  elseif (!preg_match("#^0[0-9]{9}#", $_POST['Tel']))
	 {
	 	$a=false;
	 	$message= "Le numéro de téléphone doit comporter  10 chiffres en commençant par 0 ";
	 	//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";
	 }
 	 elseif (!preg_match("#[0-9]{5}#", $_POST['CP']))
	 {
	 	$a=false;
	 	$message= "Le code postal doit comporter 5 chiffres ";
	 	//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a> ";
	 }
	 elseif (!preg_match("#^[A-Za-z]{2,}.[A-Za-z]{2,}@gmail.com#", $_POST['email']))
	 {
	 	$a=false;
	 	$message= "L'email doit être de la forme NOM.PRENOM@gmail.com ";
	 	//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";
	 }
	 elseif (!preg_match("#^[A-Z]([A-Za-z0-9]{6,})[a-z]$#", $_POST['mdp']))
	 {
	 	$a=false;
	 	$message="Le mot de passe doit sous la forme Exemple4s ";
	 	//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";
	 }

	if ($a){

		if($_POST['mdp'] == $_POST['cmdp']){
			$sql='SELECT email, nom, prenom FROM personne';
		
			$resultat=mysqli_query($base,$sql);
		
			while ($row=mysqli_fetch_row($resultat)) {
				if( $_POST['Nom']==$row[1] && $_POST['Prenom']==$row[2]) {
					if ($row[0]==$_POST['email']) {
						$a=false;
						$message="Ce mail est déjà utilisé !!" ;
						//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";
						//echo"<a style='color: rgb(255,107,7)' href='connection.html' > Aller à la page de connection </a>";
					}else {
						$a=false;
						$message= "Vous avez déjà un compte chez OSI !! avec le mail : ".$row[0];
						//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";
						//echo"<a style='color: rgb(255,107,7)' href='connection.html' > Aller à la page de connection </a>";
					}
				}
			}
		}else{
			$a = false;
			$message=  "Les mots de passe ne correspondent pas";
			//echo"<a style='color: rgb(255,107,7)' href='inscription.html' > Retour à la page d'inscription </a>";
		}
	}

	if ($a) {
		$sql1= 'SELECT top 1 num_id FROM personne ORDER BY num_id desc';
		$resultat=mysqli_query($base,$sql);
		
		$client='client';
		$nom=$_POST['Nom'];
		$prenom=$_POST["Prenom"];
		$email=$_POST['email'];
		$mdp=$_POST["mdp"];
		$tel=$_POST["Tel"];
		$rue=$_POST["Rue"];
		$cp=$_POST["CP"];
		$ville=$_POST["Ville"];
		$c1="`type`, `nom`, `prenom`, `email`, `password`, `telephone`, `rue`, `cp`, `ville`";
		$c2="'$client','$nom','$prenom','$email','$mdp','$tel','$rue','$cp','$ville'";

		if(isset($_POST["birthday"])){
		if($_POST["birthday"] !=""){
			$anniv=$_POST["birthday"];
			$c1.=",`naissance`";
			$c2.=",'$anniv'";
			}
		}

		if(isset($_POST["Sexe"])){
			if($_POST["Sexe"] != ""){
				$sexe=$_POST["Sexe"];
				$c1.=",  `sexe`";
				$c2.=",'$sexe'";
			}
		}

		if(isset($_POST["Situation"])){
			$situation=$_POST["Situation"];
			$c1.=", `situation_familiale`";
			$c2.=",'$situation'";
		}

		$sql="INSERT INTO personne( ".$c1.") VALUES(".$c2.")";

		if(mysqli_query($base,$sql)){
			$message= "Vous avez maintenant un compte chez OSI !!";
			$lieu="./gererProduit.php";
		}
		
		include("traitementConnexion.php");
		connexion($email,$mdp,"client");
	}
header("location: ".$lieu."?message=".$message);
echo"</body></html>";

?>