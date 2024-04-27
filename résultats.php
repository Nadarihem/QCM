<?php
session_start();
include "menu.php";

if(!isset($_SESSION["mail"])){
    header("location:connexion.php");
}
else{
    if(isset($_POST["bouton"])){
       include "connect.php";// Connexion à la BD
        $note = 0; // Déclaration d'un compteur
        $questions = array(); // table to hold questions
        $reponses = array(); // table to hold user and correct answers
        foreach($_POST as $cle=>$val){
            if($cle != "name"){
                $req = "SELECT *FROM reponses WHERE idr = '$val' AND verite = 1";
                $res = mysqli_query($id,$req);
                if(mysqli_num_rows($res)>0){
                    $note = $note + 2;
                    $reponses[$cle] = "Bonne réponse"; // record good answer
                }
                else{
                    $req2 = "SELECT * FROM questions WHERE idq = '$cle'";
                    $res2= mysqli_query($id,$req2);
                    $req3= "SELECT * FROM reponses WHERE idq = '$cle' AND verite = 1";
                    $res3 = mysqli_query($id,$req3);
                    while($ligne = mysqli_fetch_assoc($res2)){
                        while($ligne2 = mysqli_fetch_assoc($res3)){
                            $question = $ligne["libelleQ"];
                            $rep = $ligne2["libeller"];
                            $reponses[$cle] = "Mauvaise réponse"; // record wrong answer
                            $questions[$cle] = $question;
                        }
                    }
                }
            }
        }
    }
}
echo "<div class = 'res'>";
echo "<h3>Score de ".$_SESSION["nom"]."</h3>";
echo "<h3>T'as obtenu une note de : $note/20</h3>";
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$idu = $_SESSION["Idu"];
$niveau = $_SESSION["niveau"];
$requete = "INSERT INTO noteq (Idn, Idu, nom, prenom, note, niveau) 
            VALUES (null, '$idu', '$nom', '$prenom', '$note', '$niveau') ";
mysqli_query($id,$requete);
?>
 <div id="overflowt">
<table>
    <tr>
        <th>Question</th>
        <th>Réponse</th>
        <th>T'aurais dû répondre</th>
    </tr>
    <?php
    foreach($questions as $cle=>$val){
        echo "<tr>";
        echo "<td>".$val."</td>";
        echo "<td>".$reponses[$cle]."</td>";
        if($reponses[$cle] == "Mauvaise réponse"){
            $req2 = "SELECT * FROM reponses WHERE idq = '$cle' AND verite = 1";
            $res2 = mysqli_query($id,$req2);
            while($ligne2 = mysqli_fetch_assoc($res2)){
                $rep = $ligne2["libeller"];
                echo "<td>".$rep."</td>";
            }
        }
        else{
            echo "<td></td>";
        }
        echo "</tr>";
    }
    ?>
</table>
</div>
