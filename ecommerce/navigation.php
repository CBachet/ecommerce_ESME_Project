<nav>
            <?php
               

                
                         if(isset($_SESSION['type']) && $_SESSION['type']=="manager"){
                           
                            echo " <table align='center'>
                            <td>
                            <form method='post' action='home.php'>
                                <input type='submit' value='Accueil' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='gererProduit.php'>
                                <input type='submit' value='Gestion des produits' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='voirClient.php'>
                                <input type='submit' value='Gestion des clients' id='envoyer'/>
                            </form> 
                            </td>
                            <td>
                            <form method='post' action='traitement.php'>
                                <input type='submit' name='traitement' value='Deconnexion' id='envoyer'/>
                            </form>
                            </td>
                        </table>
                        ";
                        }elseif(isset($_SESSION['type']) && $_SESSION['type']=="client"){
                            echo " <table align='center'>
                            <td>
                            <form method='post' action='Home.php'>
                                <input type='submit' value='Accueil'id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='gererProduit.php'>
                                <input type='submit' value='Voir les produits' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='panier.php'>
                                <input type='submit' value='Voir mon panier' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='client.php'>
                                <input type='submit' value='Voir mon profil' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='traitement.php'>
                                <input type='submit' name='traitement' value='Deconnexion' id='envoyer'/>
                            </form>
                            </td>
                        </table>
                        ";
                        }else{
                            echo " <table align='center'>
                            <td>
                            <form method='post' action='Home.php'>
                                <input type='submit' value='Accueil' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='gererProduit.php'>
                                <input type='submit' value='Voir les produits' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='authentification.php'>
                                <input type='submit' value='Connexion' id='envoyer'/>
                            </form>
                            </td>
                            <td>
                            <form method='post' action='formulaire.php'>
                                <input type='submit' value='Inscription' id='envoyer'/>
                            </form>
                            </td>
                        </table>
                        ";
                        }
                      
            ?>
            
        </nav>

