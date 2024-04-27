<?php
include "menu.php";
session_start();
if(isset($_POST["bouton"])){
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $hashed_mdp = md5($mdp);
    $id = mysqli_connect("localhost", "root", "", "qcm"); 
    $requete = "select * from userq
            where mail='$mail'
            and mdp='$hashed_mdp'";
    $res = mysqli_query($id, $requete);
    if(mysqli_num_rows($res) > 0){   //mysqli_num_rows($res) compte le nombre de lignes de $res
        $_SESSION["mail"] = $mail;
        $ligne = mysqli_fetch_assoc($res);
        $_SESSION["nom"] = $ligne["nom"];
        $_SESSION["prenom"] = $ligne["prenom"];
        $_SESSION["Idu"]= $ligne["Idu"]; 
        $ok = "Connexion OK, vous allez être redirigé...";
        header("refresh:3; url=niveau.php");//redirection au bout de 3 secondes
    }else{
        ?>
        <div class="error">
        <?php
         $erreur = "Erreur de mail ou mot de passe !!";
       ?>
       </div>
       <?php
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
    <form action="" method="post" class="form_connect">
         <h2>Connexion  </h2>
        <?php
           if(isset($erreur)){
              ?>
                <div class="error">
              <?php
                  echo $erreur;
              ?>
              </div>
              <?php
           }
           if(isset($ok)){
                    echo $ok;
            }
        ?>
        <input type="email" name="mail" placeholder="Entrez votre mail* " required>
        <input type="password" name="mdp" placeholder="Mot de passe* " required minlength = "10">
        <input type="submit" value="Connexion" name="bouton">
        <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a></p>
    </form>
</body>
</html>