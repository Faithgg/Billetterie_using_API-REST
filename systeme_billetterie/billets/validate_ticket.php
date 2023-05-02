<?php
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
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
    <title>Validation de Billet</title>
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
            width: 400px;
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
</header>
    <?php
$tentative = $_SESSION["donnees_justes"];

if ($methode === "GET") {
    $nom = filter_input(INPUT_GET, "nom");
    $public_key = filter_input(INPUT_GET, "code");
    if (!$nom || !$public_key) {
        ?>
        <?php
    if (isset($_SESSION["individu_connecte"]))
    { ?>
        <p><a  style="position: fixed;" href="../Evenements/index.php"><button style ="background-color: #AE00C9; color: white;">Evénements</button></a>
        <?php }?> <a style="position: fixed;right:2%;margin-top: 1VH;" href="../dashboard.php"><button style=" background:#FFDD33">Retour à l'accueil</button></a></p>

        <form action="validate_ticket.php" method="GET">
        <fieldset class="center">
        <div class="band">
                <figcaption style="margin-left: 10%;font-size: 20px;font-family:plein2;">Formulaire de validation de Billet</figcaption>
            </div>
            <div class="input">
                <label for="nom">Nom du visiteur: </label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="input">
                <label for="code">Code Public du Billet: </label>
                <input type="text" id="code" name="code" required>
            </div>
            <div class="input_b">
                <button class="button" type="submit">Valider</button>
            </div>
        </fieldset>
        </form>
    
   <?php
    } else {
        $pdo = connexion_BDD();
        $requette = $pdo->prepare("SELECT * FROM `billets` AS b INNER JOIN `visitors` AS v WHERE v.nom_prenom = :nom AND b.public_code = :public_key AND b.visitor_id = v.id ");
        $requette->execute([
            ":nom" => $nom,
            ":public_key" => $public_key
        ]);
        $result = $requette->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) === 0) {
            http_response_code(401);
?>
        <svg style="margin-left:24%;color: rgb(2, 240, 2);" xmlns="http://www.w3.org/2000/svg" width="50%" height="50%" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" fill="#FF0000"></path> </svg>
<?php
        } else {
            http_response_code(200);
            ?>
        <svg style="margin-left:24%;color: rgb(191, 63, 238);" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50%" height="50%" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="40" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="id1"><path d="M 2.328125 4.222656 L 27.734375 4.222656 L 27.734375 24.542969 L 2.328125 24.542969 Z M 2.328125 4.222656 " clip-rule="nonzero" fill="#00FF00"></path></clipPath></defs><g clip-path="url(#id1)"><path fill="#bf3fee" d="M 27.5 7.53125 L 24.464844 4.542969 C 24.15625 4.238281 23.65625 4.238281 23.347656 4.542969 L 11.035156 16.667969 L 6.824219 12.523438 C 6.527344 12.230469 6 12.230469 5.703125 12.523438 L 2.640625 15.539062 C 2.332031 15.84375 2.332031 16.335938 2.640625 16.640625 L 10.445312 24.324219 C 10.59375 24.472656 10.796875 24.554688 11.007812 24.554688 C 11.214844 24.554688 11.417969 24.472656 11.566406 24.324219 L 27.5 8.632812 C 27.648438 8.488281 27.734375 8.289062 27.734375 8.082031 C 27.734375 7.875 27.648438 7.679688 27.5 7.53125 Z M 27.5 7.53125 " fill-opacity="1" fill-rule="nonzero"></path></g></svg>
<?php
        }

}
} else {
    echo "La méthode devrait GET";
}
 ?>
</body>
</html>