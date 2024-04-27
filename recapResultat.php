<?php
   session_start();
   include "menu.php";
   if(!isset($_SESSION["mail"])){
       header("location:connexion.php");
   }
   else{
   include "connect.php";
   $idu= $_SESSION["Idu"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste annonce </title>
    <link rel="stylesheet" href="styleqcm.css">
</head>
<body>
<div  class="recap">
    <h2>Récapitulatif des résultats de <?=$_SESSION["prenom"]." ".$_SESSION["nom"]?> : </h2>
    <div id="overflowt">
    <table>
        <tr>
            <th> idn </th><th>idu</th><th>nom</th><th>prenom</th>
            <th>note</th><th>niveau</th>
        </tr>
        <?php
        $req = "select * from noteq where Idu = '$idu'";
        $res = mysqli_query($id, $req);
        while($ligne = mysqli_fetch_assoc($res))
        {
            ?>
                <tr>
                    <td><?=$ligne["Idn"]?></td>
                    <td><?=$ligne["Idu"]?></td>
                    <td><?=$ligne["nom"]?></td>
                    <td><?=$ligne["prenom"]?></td>
                    <td><?=$ligne["note"]?></td>
                    <td><?=$ligne["niveau"]?></td>  
                </tr>
               
            <?php
        }
    
        ?>
       
    </table>
    </div>
   

</div>



</body>
</html>