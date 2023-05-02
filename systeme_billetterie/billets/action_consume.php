<?php 
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
require "../session_start_prim.php";
require "../connexion_BDD.php";
session_start_prim();
if (isset($_SESSION["individu_connecte"])){

if ($methode === "GET") {
    $name = filter_input(INPUT_GET, "nom");
    $consume_key = filter_input(INPUT_GET, "consume_key");
    $action = filter_input(INPUT_GET, "action");
    if (!$name || !$consume_key) {
        header("location:display_tickets.php");
    } else {
            $pdo = connexion_BDD();
            if ($action === "consommer")
            {
                $requette_cons = $pdo->prepare("UPDATE `billets` SET consume = 1 WHERE consume_code = :consume_key");
                $requette_cons->execute([
                    ":consume_key" => $consume_key
                ]);   
            } elseif ( $action === "n_consommer" ) {
                $requette_cons = $pdo->prepare("UPDATE `billets` SET consume = 0 WHERE consume_code = :consume_key");
                $requette_cons->execute([
                    ":consume_key" => $consume_key
                ]);   
            }
      
            header("location:display_tickets.php");  
    }
}
} 
    else {
        header("location:display_tickets.php");
    }?>