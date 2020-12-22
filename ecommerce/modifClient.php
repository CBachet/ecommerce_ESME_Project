<html>

<?php
    session_start();
?>
    <head><?php echo"
        <meta charset='UTF-8'>
        <meta name='author' content='Clovis B Marine L'/>
        <title> ".$_POST['prenom']." ".$_POST['nom']."</title>";?>
        
        <link rel='icon' type='image/jpg' href='logo.jpg'/>
        <style>
        	
#logo
{
    float:left;
    height: 200px;
    width: auto;
}
#titre
{
  font-family: Georgia;
  font-weight: bold;
  font-size: 80px;
  color: rgb(255,107,7);
}

fieldset
{
    width: 50%;
    position: relative;
   
}

footer
{
    border: 2px solid black;
    text-align: center;
    position:relative;
    font-family: "Times New Roman";
    font-size: 25px;
    top: 100px;
    background-color: gainsboro;
    
}
#mail
{
    width: 150px;
}

#envoyer
{
    padding: 1em;
    border: 2px solid rgb(255,107,7);
    border-radius: 30px;
    font-size: 18px;
}
a
{
    color: rgb(255,107,7);
}



        </style>
    </head>
    <body>
    	<header>
                
       		<img id="logo" src="logo.png" alt=""/>
                   
            <p id="titre" align="center">OSI</p>
            </br>
                   
        
        </header>

    	<?php
		include('navigation.php');
    include("database.php");
    if(isset($_POST["modif"])){
        if($_POST["modif"]=="Modifier"){
                    //page de modification
                    //////
                    $num=$_POST["id"];
					
                    $req = "select * from personne WHERE num_id=$num";
                    $res = mysqli_query($base,$req);
                    $personne= mysqli_fetch_assoc($res);
                    $num=$personne["num_id"];
                    $nom=$personne["nom"];
                    $prenom=$personne['prenom'];
            		$email=$personne['email'];
            		$password=$personne['password'];
            		$telephone=$personne['telephone'];
            		$sexe=$personne['sexe'];
            		$situation=$personne['situation_familiale'];
            		$rue=$personne['rue'];
            		$cp=$personne['cp'];
            		$ville=$personne['ville'];
                    
                    echo"<h2>Modifier vos informations personnelles $prenom: </h2> </br>";
                    echo"<form method='post' action='traitement.php'>
                        <fieldset>
                        <legend>Modifier Client : </legend>
                        <fieldset>
                        <legend>Coordonées : </legend>
                	    <label>Nom : </label>
                	    <input type='text' name='Nom' value='$nom'/>
                        <br>
                        <label>Prénom : </label>
                        <input type='text' name='Prenom' value='$prenom'/>
                        <br>
                        <label>Numéro de téléphone : </label>
                        <input type='text' name='Tel' value='$telephone'/>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Adresse : </legend>
                        <label>Rue : </label>
                        <input type='text' name='Rue'  value='$rue'/>
                        <br>
                        <label>Code Postal : </label>
                        <input type='text' name='CP' value='$cp'/>
                        <br>
                        <label>Ville : </label>
                        <input type='text' name='Ville'  value='$ville'/>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Information : </legend>
                        <label>Situation familiale : </label>
                        <select name='Situation'>";
                        if($situation == null){
                            echo "<option value= null>  </option>";
                        }
                        else{
                            echo "<option value= '$situation'>  </option>";
                        }
                            echo "<option value='celibataire'> Célibataire</option>
                            <option value='couple'> En couple</option>
                            <option value='marie'> Marié(e) </option>                           
                            <option value='divorse'> Divorcé(e) </option>
                        </select>
                        <br>";
                    echo "</fieldset>
                        <br>
                    <fieldset>
                        <legend>Connection : </legend>
                        <label>Mail : </label>
                        <input type='text' name='email' id='mail' placeholder='$email' value='$email'/>
                        <br>
                        <label>Mot de passe : </label>
                        <input type='password' name='mdp' placeholder='Exemple4s' placeholder='$password' value='$password'/>
                        <br>
                        <label>Confirmation du mot de passe : </label>
                        <input type='password' name='cmdp' placeholder='Exemple4s' placeholder='$password' value='$password'/>
                        <br>
                    </fieldset>
                    <br>
                    <input type='submit' name='traitement' value='Modifier' id='envoyer' />
                    </fieldset>
                    <input type='hidden' name='id' value='$num'/>
                    <input type='hidden' name='sexe' value='$sexe'/>
                </form>
				
				<form method='post' action='client.php'>
						<input type='hidden' name='id' value=$num/>
                        <input type='submit' name='submit' value='Retour' id='envoyer' />
                    </form>";

        }
    }
    //c'est possible de mettre le css dans un fichier css?
?>

    </body>
</html>
