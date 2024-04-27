<?php
include "menu.php";
    if(isset($_POST["bouton"])){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $mail = $_POST["mail"];
        $mdp = $_POST["mdp"];
        $hashed_mdp = md5($mdp); 
        $conf=$_POST["confirm_password"];
        $h_conf=md5($conf);
        if($hashed_mdp===$h_conf){
            //connexion au serveur mysql
          include "connect.php";
        $requete = "insert into userq (Idu, nom, prenom, mail, mdp)
                    values (null, '$nom', '$prenom', '$mail', '$hashed_mdp')";
        mysqli_query($id, $requete);//on execute la requete
       $ok= "Inscription réussie. Veuillez vous connecter";
        header("refresh:3; url=connexion.php");
        }
        else{
            $error= "Veuillez vérifier vos informations !! ";
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
    <form action="" method="post" class="form_ins" enctype="multipart/form-data">
        <h1>Creér un compte</h1>
        <?php
            if(isset($ok)){
                echo $ok;
            }
        ?>
        <div class="error">
            <?php
               if(isset($error)){
                   echo $error;
               }
            ?>
        </div>
        <p><input type="text" name="nom" placeholder="Entrez votre nom*" required></p>
        <p><input type="text" name="prenom" placeholder="Entrez votre prenom* " required></p>
        <p><input type="email" name="mail" placeholder="Entrez votre mail*" required></p>
        <p><input type="password" name="mdp" placeholder="Mot de passe*"  minlength="10" required></p>
		<p><input type="password" id="confirm_password" name="confirm_password"
        placeholder="confirmer mot de passe*" minlength="10" required></p>
        <p><input type="submit" value="S'inscrire" name="bouton"></p>
        <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a></p>
    </form>
  

   
</body>
</html>