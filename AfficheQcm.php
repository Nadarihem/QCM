<?php
    include "menu.php";
    session_start();
    if(!isset($_SESSION["mail"])){
        // redirection vers la page de connexion
        header("location: connexion.php");
    }
    else{
        if(isset($_POST["niveau"])){
            $_SESSION["niveau"] = $_POST["niveau"];
          include "connect.php"; // connexion à la BDD
           $_SESSION["niveau"] = $_POST["niveau"];
           $niveau = $_SESSION["niveau"];
            $req = "Select * From questions 
            where niveau = '$niveau' order by rand () limit 10" ; // requete
            $res= mysqli_query($id, $req); // exécution
           
        }
        else{
            header("location:niveau.php");
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleqcm.css">
</head>
<body>
    <form class="form_ques" action="résultats.php" method="post">
    <h3>Choisissez la bonne réponse pour chaque question</h3>
    <div id="overflow">
        <?php
            // Affichage des questions : 
             echo '<ol>';
                while($ligne = mysqli_fetch_assoc($res)){
                   $questions = $ligne["libelleQ"];
                   $idq = $ligne["idq"];
                   ?>
                   <div class="ques">
                     <?php
                     echo "<li>$questions</li> ";
                     ?>
                </div>
                     <?php
                     $requete = "Select * From reponses where idq ='$idq'";
                     $result= mysqli_query($id, $requete);
                      while($line = mysqli_fetch_assoc($result)){
                      $rep = $line["libeller"];
                      $idr = $line["idr"];
                      ?>
                      <div class="rep">
                      <?php
                      echo "<p><input type= radio name= $idq value = $idr required>$rep</p>";   
                      ?>
                      </div>
                      <?php 
                    }
                }    
    ?>
    <p><input type="submit" name = "bouton"  value = "Valider"></p>
    </div>
    </form>
</body>
</html>