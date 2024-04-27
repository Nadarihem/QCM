<?php
session_start();
include "menu.php";
if(!isset($_SESSION["mail"])){
    header("location:connexion.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="styleqcm.css">
</head>
<body>
    <form action="AfficheQcm.php" class="form_niv" method="post">
       <h3> Bonjour <?=$_SESSION["nom"]?>, Choisissez un niveau : </h3><br>
      <div class="Choix">
       <div class="choix">
           <label for="Facile">Facile</label> 
           <input type="radio"  name="niveau" id = "Facile" value = "Facile" required>
        </div>
        <div class="choix1"></div>
            <label for="Difficile">Difficile</label> 
           <input type="radio" name="niveau" id = "Difficile" value = "Difficile" required>
        </div>
      </div> 
       <p><input type="submit" value="valider" name = "bouton"></p>
    </form>
</body>
</html>