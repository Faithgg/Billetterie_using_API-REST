<?php
require "../session_start_prim.php";
require "../connexion_BDD.php";
session_start_prim();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visiteurs</title>
    <style>
        legend {
    background-color: #000;
    color: #fff;
    padding: 3px 6px;
}
            .imag{
            display: block;margin-left: auto;margin-right: auto;
            animation: spinword 10s linear infinite;
        }
        @keyframes spinword {

            from {
            transform: rotateY(180deg);

            }

        to {
            transform: rotateY(-180deg);

            }
        }
    
        .ticket {
      background-color: #ffffff;
      border: 1px solid #000;
      padding: 10px;
      position: relative;
      margin : 0 20vw;
    }

    </style>
</head>
<body>
<header>
    <img class="imag" src="../images/logo.png" width="250px"> </img>
</header>
<?php
    if (isset($_SESSION["individu_connecte"]))
    { ?>
                <p><a  style="position: fixed;" href="../Evenements/index.php"><button style ="background-color: #AE00C9; color: white;">Evénements</button></a>
       <a style="position: fixed;right:2%;margin-top: 1VH;" href="../dashboard.php"><button style=" background:#FFDD33">Retour à l'accueil</button></a></p>
 
        <?php
                $pdo = connexion_BDD();
                $requette = $pdo->prepare("SELECT v.nom_prenom AS nom,GROUP_CONCAT(DISTINCT e.nom) AS events_name,GROUP_CONCAT(DISTINCT e.date) AS dates,GROUP_CONCAT(DISTINCT e.Place)AS Places FROM `visitors` AS v INNER JOIN `events` AS e WHERE v.event_id = e.id GROUP BY v.nom_prenom");
                $requette->execute();
                $result = $requette->fetchAll(PDO::FETCH_ASSOC); ?>
                    <?php
                    for ( $i=0;$i < count($result); $i++) {
                    ?>
                        <fieldset class="ticket">
                            <legend><?= "Visiteur n°".count($result) - $i ;?></legend>
                            <p>Le visiteur : <strong><?= $result[count($result) - $i -1]["nom"]?></strong> réservant pour le.s évenement.s 
                            <strong><?= $result[count($result) - $i -1]["events_name"]?></strong> ayant respectivement lieux le <strong><?= $result[count($result) - $i -1]["dates"]?></strong>
                        à <strong><?= $result[count($result) - $i -1]["Places"]?></strong></p>
                        </fieldset>
                    <br>
                  <?php  }
         } else {
            header("location:../verify_token.php?endpoint_courant=./visiteurs/index.php");
        }?>
</body>
</html>