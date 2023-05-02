<?php 
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
require "../session_start_prim.php";
require "../connexion_BDD.php";
session_start_prim();
if (isset($_SESSION["individu_connecte"])){

    if ($methode === "GET") {
        $id = filter_input(INPUT_GET, "id");
            if (!$id) {
                header("location:index.php");
            } else {
            $pdo = connexion_BDD();
            $requete1 = $pdo->prepare("DELETE FROM billets WHERE visitor_id= :id");
            $requete2 = $pdo->prepare("DELETE FROM visitors WHERE id= :id");
            $requete1->execute( [
                ":id" => $id
            ]); 
            $requete2->execute( [
                ":id" => $id
            ]);       
            header("location: ../Evenements/index.php");  
            }
    }
} else {
    header("location:../Evenements/index.php");
}?>