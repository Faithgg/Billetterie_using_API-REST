<?php 
  use GuzzleHttp\Client;
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
require "../session_start_prim.php";
require "../connexion_BDD.php";
session_start_prim();
if (isset($_SESSION["individu_connecte"])){

if ($methode === "GET") {
    $event_name = filter_input(INPUT_GET, "nom");
    $event_place = filter_input(INPUT_GET, "lieu");
    $event_datetime = filter_input(INPUT_GET, "date");
    $id =  filter_input(INPUT_GET, "id");
    if (!$event_name || !$event_place || !$event_datetime) {
        header("location:index.php");
    } else {
            $pdo = connexion_BDD();
            $requete = $pdo->prepare("DELETE FROM events WHERE nom = :nom AND Place = :lieu AND `date` = :moment AND id= :id");
            $requete->execute( [
                ":nom" => $event_name,
                ":lieu" => $event_place,
                ":moment" => $event_datetime,
                ":id" => $id
            ]);       
            header("location:index.php");  
    }
}
} 
    else {
        header("location:index.php");
    }?>