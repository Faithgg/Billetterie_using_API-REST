<?php
  use GuzzleHttp\Client;
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
    <title>Evénements</title>
    <style>
    .center{
            
            margin-left: 33%;
            margin-top: 5%;
            margin-bottom: 10%;
            height: 500px;
            border: 1px solid black;
            backdrop-filter: blur( 9.5px );
            -webkit-backdrop-filter: blur( 9.5px );
            width: 500px;
            position: fixed;
            box-shadow: 10px 5px 5px rgb(0, 0, 0);
            border-radius: 10px;
        }
    .band{
            background-color: #FFDD33;
            width: 160px;
            height: 30px;
            margin-left:-10%;
            margin-top:10%;
            border: 0.10px solid black;
            display:flex;
            align-items: center;
            white-space : nowrap;

        }
    .button{
            background-color:#AE00C9;
            width: 200px;
            height: 60px;
            border-radius: 20px;
            transition: all 0.5s;
            font-size: 20px;
            color: white;
        }

    .button:hover{
            background-color:#FFDD33;
            transform: scale(1.1);
            color: black
        }
    .input{
        margin-top: 15%;margin-left: 5%;
    }
    .input_b{
        margin-top: 15%;margin-left: 30%;
    }
    
    .ticket {
      width: 70vw;
      background-color: #ffffff;
      border: 1px solid #000;
      padding: 10px;
      position: relative;
      margin : 0 14.75vw;
    }

    .qr-code {
      width: 23%;
      background-color: #fff;
      border: 1px solid #000;
      position: absolute;
      top: 10px;
      right: 10px;
    }

    /* image QR code  */
    .qr-code img {
      width: 100%;
      height: 100%;
    }

    .ticket-info {
      background-color: #FFDD33;
      width: 55%;
      height: 13%;
      margin-left:-3%;
      margin-top:1%;
      border: 1px solid black;
      display:flex;
      align-items: center;
      white-space : nowrap;

    }
    .ticket-details {
      font-size: 13px;
      font-weight: bold;
      white-space : nowrap;


    }

    .code-public {
      font-size: 15px;
      font-weight: bold;
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
        fieldset p button {
            background : #AE00C9;
            color :white;
        }
        li {
            margin : 10px 0;
        }
  </style>    
</head>
<body>
<header>
    <img class="imag" src="../images/logo.png" width="250px"> </img>
</header>
    <?php
        if (isset($_SESSION["individu_connecte"])) {
                ?>
    <p><a  style="position: fixed; " href="./create.php"><button style ="background-color: #AE00C9; color: white;">Créer un Evenement</button></a>
       <a style="position: fixed;right:2%;margin-top: 1VH;" href="../dashboard.php"><button style=" background:#FFDD33">Retour à l'accueil</button></a></p>

        <?php
                $pdo = connexion_BDD();
                $requette1 = $pdo->prepare("SELECT * FROM `events`");
                $requette1->execute();
                $result = $requette1->fetchAll(PDO::FETCH_ASSOC); ?>
                    <?php
                    for ( $i=0;$i < count($result); $i++) {
                    ?>
                        <fieldset class="ticket">
                            <div  class="ticket-info">
                                <p style="margin-left: 15%;font-family:plein2;"><?= "Evenement n°".count($result) - $i ; ?></p>
                            </div>
                                <p>Nom de l'événement: <strong><?= $result[count($result) - $i -1]["nom"]?></strong> </p>
                                <p>Lieu de l'événement: <strong><?= $result[count($result) - $i -1]["Place"]?></strong></p>
                                <p>Date de l'événement: <strong><?= $result[count($result) - $i -1]["date"]?></strong></p>
                            <p>
                                <a href="update.php?nom=<?= $result[count($result) - $i -1]["nom"]?>&lieu=<?= $result[count($result) - $i -1]["Place"]?>&date=<?= $result[count($result) - $i -1]["date"]?>&id=<?= $result[count($result) - $i -1]["id"]?>"><button>Modifier</button></a>            
                                <a href="delete.php?nom=<?= $result[count($result) - $i -1]["nom"]?>&lieu=<?= $result[count($result) - $i -1]["Place"]?>&date=<?= $result[count($result) - $i -1]["date"]?>&id=<?= $result[count($result) - $i -1]["id"]?>"><button>Supprimer</button></a>
                            </p>
                            <h3 style="text-align:center; color:#AE00C9;text-decoration:underline #AE00C9"> VISITEURS </h3>
                        <?php
                            $requette2 = $pdo->prepare("SELECT id,nom_prenom FROM `visitors` WHERE event_id = :id");
                            $requette2->execute([
                                ":id" => $result[count($result) - $i -1]["id"]
                            ]);
                            $reponse = $requette2->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <ul>
                            <?php 
                            foreach ($reponse as $key => $visiteur) {
                                ?>
                                <li><strong><?= $visiteur["nom_prenom"]?></strong>  <a href="../visiteurs/cancel.php?id=<?= $visiteur["id"]?>"><button>Annuler</button></a></li>
                                <?php
                            }                    
                        ?>
                        </ul>
                        <p><a href="../visiteurs/add.php?id=<?= $result[count($result) - $i -1]["id"]?>"><button>Ajouter un nouveau visiteur</button></a></p>
                        </fieldset>
                    <br>
                  <?php  }
         } else {
            $_SESSION["endpoint_courant"]= "./Evenements/index.php";
            header("location:../verify_token.php?endpoint_courant=./Evenements/index.php");
       }
    ?>
</body>
</html>