<?php 
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
require "../session_start_prim.php";
require "../connexion_BDD.php";
session_start_prim();
if (isset($_SESSION["individu_connecte"])) {
    
$tentative = $_SESSION["donnees_justes"];

if ($methode === "GET") {
    if (!filter_input(INPUT_GET,"id")) {
        header("location:index.php");
    } else {
$_SESSION["add_visitor_event_id"] = filter_input(INPUT_GET,"id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Visiteur</title>
    <style>
        @font-face {
            font-family: "plein2";
            src:url('Plein Medium.otf');
    }

    .imgg{
        animation: spinword 10s linear infinite;
        
    }
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
            width: 280px;
            height: 40px;
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
        @keyframes spinword {

        from {
            transform: rotateY(180deg);

            }

        to {
            transform: rotateY(-180deg);

            }
}
    .input{
        margin-top: 15%;margin-left: 5%;
    }
    .input_b{
        margin-top: 15%;margin-left: 30%;
    }
    .imag{
            display: block;margin-left: auto;margin-right: auto;
            animation: spinword 10s linear infinite;
        }
    </style>        
</head>

<body>
    <header>
        <img class="imag" src="../images/logo.png" width="250px"> </img>
        <p><a style="position: fixed;right:2%;margin-top: 1VH;" href="./dashboard.php"><button style=" background:#FFDD33">Retour à l'accueil</button></a></p>
    </header>
    <?php 
    if ($tentative ===false) {
        ?>
        <div style="position: fixed;margin-left:30%;margin-top: 1VH;  bottom:1VH">
            <div style="float: left">
                <svg fill="#AE00C9" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60px" height="60px" viewBox="0 0 106.06 106.06" xml:space="preserve" stroke="#AE00C9"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="4.03028"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M53.029,0.001c-13.587,0-27.173,5.17-37.515,15.512C-5.173,36.2-5.171,69.858,15.516,90.546 c10.341,10.343,23.927,15.513,37.513,15.513s27.172-5.172,37.517-15.519c20.686-20.684,20.684-54.339,0.002-75.022 C80.202,5.173,66.615,0.001,53.029,0.001z M84.758,84.757C76.01,93.505,64.52,97.878,53.029,97.88 c-11.49,0-22.98-4.373-31.728-13.119c-2.188-2.188-4.101-4.547-5.741-7.033C4.078,60.317,5.993,36.609,21.301,21.3 c8.748-8.747,20.238-13.12,31.728-13.12s22.98,4.373,31.729,13.121C102.254,38.796,102.252,67.264,84.758,84.757z M24.688,52.313 c-1.212-1.133-1.274-3.033-0.142-4.246c1.132-1.213,3.018-1.291,4.247-0.143c3.251,3.053,6.589,0.242,6.959-0.088 c1.105-0.99,2.741-1.012,3.867-0.119c0.133,0.104,0.259,0.223,0.376,0.354c1.106,1.236,1.001,3.135-0.235,4.242 C37.096,54.698,30.552,57.798,24.688,52.313z M81.502,48.036c1.105,1.236,1.001,3.135-0.235,4.242 c-2.664,2.385-9.208,5.484-15.072,0c-1.212-1.133-1.273-3.033-0.142-4.246s3.018-1.291,4.247-0.143 c3.251,3.053,6.589,0.242,6.959-0.088c1.104-0.99,2.741-1.012,3.867-0.119C81.259,47.786,81.384,47.905,81.502,48.036z M77.017,79.333c0.658,1.521-0.041,3.287-1.563,3.945c-1.52,0.66-3.284-0.041-3.942-1.563c-2.895-6.688-9.731-11.013-17.422-11.013 c-7.867,0-14.746,4.32-17.523,11.007c-0.479,1.151-1.596,1.85-2.771,1.85c-0.383,0-0.773-0.073-1.149-0.229 c-1.53-0.637-2.255-2.393-1.62-3.922c3.711-8.933,12.764-14.703,23.064-14.703C64.175,64.704,73.175,70.446,77.017,79.333z"></path> </g> </g></svg>
            </div>
            <div>
                <p style="margin-top: 10%;margin-left: 40%;white-space : nowrap;color:#AE00C9"><?= $_SESSION["Error_message"] ?></p>
            </div>
        </div>
        <?php
    }
    ?>
    <form action="add.php" method="post">
    
    <fieldset class="center">
        <div class="band">
            <figcaption style="margin-left: 12%;font-size: 20px;font-family:plein2;">Formulaire d'ajout de visiteur</figcaption>
        </div>
        <div class="input">
            <label for="name">Nom et Prénoms du visiteur:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input_b"> 
            <button class="button" type="submit">Valider</button>
        </div>
    </fieldset>
    </form>
</body>
</html>
<?php
$_SESSION["donnees_justes"] = true;
}
} elseif ($methode === "POST") {

    $name = filter_input(INPUT_POST, "name");
    $id =$_SESSION["add_visitor_event_id"];
    if (strlen ($name) === 0 ){
        $_SESSION["donnees_justes"] = false;
        $_SESSION["Error_message"] = "Veuillez remplir ce champs";
        header("location:./add.php?id=$id");
    } else {
        $pdo = connexion_BDD();
        $requete  = $pdo->prepare("SELECT * FROM `visitors` WHERE nom_prenom = :nom AND event_id = :event_id");
        $requete ->execute( [
            ":nom" => $name,
            ":event_id" => $id
        ]);
        $result = $requete ->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0)  {
            $_SESSION["donnees_justes"] = false;
            $_SESSION["Error_message"] = "Ce visiteur existe déjà.";
            header("location:./add.php?id=$id");            
        } else {
            #Coté visiteur
            $requete1 = $pdo->prepare("INSERT INTO visitors (nom_prenom,event_id) VALUES (:nom,:event_id)");
            $requete1->execute( [
                ":nom" => $name,
                ":event_id" => $id
            ]);
             // Récupérer l'id du visiteur nouvellement inscrit pour pourvoir créer le billet en son nom.
            $requete2 = $pdo->prepare("SELECT * FROM `visitors` WHERE nom_prenom = :nom AND event_id = :event_id");
            $requete2->execute( [
                ":nom" => $name,
                ":event_id" => $id
            ]);
            $resultat = $requete2 ->fetchAll(PDO::FETCH_ASSOC);
            $visitor_id = $resultat[0]["id"];
            $public = random_bytes(15);
            $p1=substr($name,0,6);
            $p2=random_bytes(2);
            $p2 = strtoupper(bin2hex($p2));
            $consume = random_bytes(16);
            $private = $p1.$p2;
            $public_key = strtoupper(bin2hex($public));
            $private_key = strtoupper($private);
            $consume_code = strtoupper(bin2hex($consume));
            #coté billet
            $requete3 = $pdo->prepare("INSERT INTO billets (event_id,visitor_id,public_code,private_id,consume_code,consume) VALUES (:event_id,:visitor_id,:public_code,:private_id,:consume_code,:consume)");
            $requete3->execute( [
                ":event_id" => $id,
                ":visitor_id" => $visitor_id,
                ":public_code" => $public_key,
                ":private_id" => $private_key,
                ":consume_code" => $consume_code,
                ":consume" => 0 # Pour false.
            ]);
            $_SESSION["donnees_justes"] = true;        
            unset($_SESSION["add_visitor_event_id"]);
            header("location:../Evenements/index.php");
        }      
    }
}
} else {
    header("location:../Evenements/index.php");
}?>
