<?php
require "./session_start_prim.php";
session_start_prim();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body{

        }
            
        .option{
            margin-top:2%;
            list-style: none;
            display: flex;
            justify-content: space-between;

        }
        .option li a{
            font-size:15px;
            text-decoration: none;
            color : purple;
            white-space : nowrap;
            margin-left:-35%;
            border: 1px solid black;
            background: rgb(174, 0, 201);
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
            backdrop-filter: blur( 11.5px );
            -webkit-backdrop-filter: blur( 11.5px );
            border: 1px solid rgba( 255, 255, 255, 0.18 );
            padding:15%;
            font-family:Arial;
            transition: all 0.5s;
            border: 1px solid #000;
            color:white
        }
        .option li a:hover{
            background: #FFDD33;
            transform: scale(1.5);
            color:black
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
        .images {
            margin-top : 2vh;
            width : 60vw;
            height: 56vh;
            margin-left: 18.50vw;
            border-radius: 2vw;
        }
    </style>
</head>
<body>

    <header>
    <img class="imag" src="./images/logo.png" width="250px"> </img>
    </header>
    <?php 
    if (isset($_SESSION["individu_connecte"])) {
        ?>
    <p style="font-family:Arial;margin-left:2VW; text-decoration:overline; color:#AE00C9;"> <strong><?= strtoupper ($_SESSION["individu_connecte"]["identifiant"])?></strong> connecté.e </p>
    <?php }?>
    <div style="width:20VW;height:10VH,background:green;">
        <img src="./images/image.jpg" alt="image" class="images">
    </div>
    <ul class="option">
        <?php
            if (!isset($_SESSION["individu_connecte"])) {
                ?>
        <li><p><a href="register.php"> S'inscrire </a></p></li>
        <li><p><a href="login.php"> Se Connecter </a></p></li>
        <li><p><a href="./billets/consommation.php">Consommer un billet </a></p></li>
        <?php }
        ?>
        <li><p><a href="./billets/display_tickets.php"> Afficher les billets </a></p></li>
        <li><p><a href="./billets/validate_ticket.php">Valider un billet</a></p></li>
        <?php
            if (isset($_SESSION["individu_connecte"])) {
                ?>
        <li><p><a href="./Evenements/index.php"> Evénements </a></p></li>
        <li><p><a href="./visiteurs/index.php"> Visiteurs </a></p></li>
        <li><p><a href="logout.php"> Déconnecter </a></p></li>
    </ul>

    <?php }?>
</body>
</html>