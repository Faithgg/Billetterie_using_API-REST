<?php
require "./connexion_BDD.php";
#Chez d'autres membres du groupe, c'est $_SERVER["REQUEST_METHOD"] qui marche 🤷.
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if ($methode === "POST") {
$pdo = connexion_BDD();


    $requete = $pdo->prepare("INSERT INTO utilisateurs (identifiant,motdepasse) VALUES (:identifiants,:passwords)");

    $donneesjson = file_get_contents("php://input");
    
    if (strlen($donneesjson) > 0) {
    $donnees = json_decode($donneesjson,true);
    
    if (!(json_last_error() == JSON_ERROR_NONE) && (is_array($donnees))) {
        $response = [
            "status"=> "False",
            "message" => "JSON incorrect"
        ];
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code(200);
        echo json_encode($response, JSON_PRETTY_PRINT);
        
    } elseif (strlen($donnees["identifiant"]) > 0 && strlen($donnees["mdp"]) > 0) {
        $id = $donnees["identifiant"];
        $mdp = $donnees["mdp"];
        $requeteSecu = $pdo->prepare("SELECT * FROM utilisateurs WHERE identifiant = :identifiants");
        $requeteSecu->execute ([
            ":identifiants" => $id
            ]);
        $resultat = $requeteSecu->fetchAll(PDO::FETCH_ASSOC);
        
        if (count ($resultat) == 0)
 {
        $requete->execute ([
            ":identifiants" => $id,
            ":passwords" => password_hash($mdp,PASSWORD_DEFAULT),
            ]);
            $response = [
                    "status"=> "Succes",
                    "message" => "Inscription reussie"
                ];
               header('Content-Type: application/json; charset=UTF-8');
                http_response_code(200);
                echo json_encode($response, JSON_PRETTY_PRINT);  
            } else {
                $response = [
                    "status"=> "Erreur",
                    "message" => "Cet utilisateur existe deja"
                ];
                header('Content-Type: application/json; charset=UTF-8');
                http_response_code(401);
                echo json_encode($response, JSON_PRETTY_PRINT);
             }
            } else {
                $response = [
                    "status"=> "Erreur",
                    "message" => "Ça sert à rien de contourner, veuillez remplir ces champs"
                ];
                header('Content-Type: application/json; charset=UTF-8');
                http_response_code(401);
                echo json_encode($response, JSON_PRETTY_PRINT);
                
        }
        } else {
        $response = [
            "status"=> "Erreur",
            "message" => "Aucune donnee envoyee"
        ];
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code(401);
        echo json_encode($response, JSON_PRETTY_PRINT);
    
    }
} else {
    $response = [
        "status"=> "Erreur",
        "message" => "La methode doit etre POST"
    ];
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(400);
    echo json_encode($response, JSON_PRETTY_PRINT);
    
}

