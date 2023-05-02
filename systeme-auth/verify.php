<?php
require "./connexion_BDD.php";
#Chez d'autres membres du groupe, c'est $_SERVER["REQUEST_METHOD"] qui marche 🤷.
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if ($methode === "POST") {
$pdo = connexion_BDD();


    $requete = $pdo->prepare("SELECT tokens.identifiant FROM jetons AS tokens INNER JOIN utilisateurs AS users WHERE users.identifiant = tokens.identifiant AND tokens.jeton = :token GROUP BY users.identifiant;");

    $donneesjson = file_get_contents("php://input");
    
    if (strlen($donneesjson) > 0) {
    $donnees = json_decode($donneesjson,true);
    
    if (!(json_last_error() == JSON_ERROR_NONE) && (is_array($donnees))) {
        $response = [
            "status"=> "False",
            "message" => "JSON incorrect"
        ];
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code(400);
        echo json_encode($response, JSON_PRETTY_PRINT);
        
    } elseif (strlen($donnees["jeton"]) > 0) {
        $jeton = $donnees["jeton"];
        $requeteSecu = $pdo->prepare("SELECT * FROM jetons WHERE jeton = :token ");
        $requeteSecu->execute ([
            ":token" => $jeton
            ]);
        $resultat = $requeteSecu->fetchAll(PDO::FETCH_ASSOC);
        

        if (count ($resultat) === 0){
            $response = [
                "status"=> "Erreur",
                "message" => "Jeton incorrect"
            ];
            header('Content-Type: application/json; charset=UTF-8');
            http_response_code(401);
            echo json_encode($response, JSON_PRETTY_PRINT);

            } else {
                $requete->execute ([
                    ":token" => $jeton
                    ]);
                    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);
                    $response = [
                            "status"=> "Succes",
                            "message" => "Token super",
                            "utilisateur" => [
                                "identifiant" => $resultats[0]['identifiant']
                            ]
                        ];
                    header('Content-Type: application/json; charset=UTF-8');
                    http_response_code(200);
                    echo json_encode($response, JSON_PRETTY_PRINT);  
            }
        } else {
            $response = [
                "status"=> "Erreur",
                "message" => "Ça sert à rien de contourner l'attribut required, veuillez remplir les champs de formulaires"
            ];
            header('Content-Type: application/json; charset=UTF-8');
            http_response_code(400);
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