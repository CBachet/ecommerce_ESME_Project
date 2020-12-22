<?php
function supprimerComm($id_com){
		include ('database.php');
$sql= "DELETE FROM commentaire WHERE num_commentaire = '$id_com'";
			if(mysqli_query($base, $sql) or die(mysqli_error($base))){ #vérifie s'il n'y a pas eu d'erreur
						$message = "Commentaire correctement supprimé !";
					}
					else{
						$message = "Erreur de suppression du commentaire";
					}
return $message;
	}
	//appelle la fct et envoie un message d'erreur
	$message=supprimerComm($_POST["id"]);
	header("location: ./produit.php?produit=".$_POST["id"]."&message=".$message );
?>