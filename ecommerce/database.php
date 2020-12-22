<?php //connection à la base de donnée, dupliqué dans ttes les pages où on en a besoin
    $base = mysqli_connect("localhost", "root", "", "ecommerce")
    or die(mysqli_error($base));   
?>