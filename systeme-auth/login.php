<?php    
require "./connexion_BDD.php";
#Chez d'autres membres du groupe, c'est $_SERVER["REQUEST_METHOD"] qui marche 🤷.
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if ($methode === "POST") {

    $pdo = connexion_BDD();
    $requete = $pdo->prepare("SELECT * FROM utilisateurs WHERE identifiant = :identifiants");

        $donneesjson = file_get_contents("php://input"); 

        if (strlen($donneesjson) > 0) {
        $donnees = json_decode($donneesjson,true);

        if (!(json_last_error() == JSON_ERROR_NONE) && (is_array($donnees))) {
            $response = [
                "status"=> "Erreur",
                "message" => "JSON incorrect"
            ];
            header('Content-Type: application/json; charset=UTF-8');
            http_response_code(400);
            echo json_encode($response, JSON_PRETTY_PRINT);
            
        } elseif (strlen($donnees["identifiant"]) > 0 && strlen($donnees["mdp"]) > 0) {
            $id = $donnees["identifiant"];
            $mdp = $donnees["mdp"];
            $requete->execute ([
                ":identifiants" => $id
                ]);
                
                $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

                if (count($resultat) == 0) {
                    $response = [
                        "status"=> "Erreur",
                        "message" => "Cet utilisateur n'existe pas."
                    ];
                   header('Content-Type: application/json; charset=UTF-8');
                    echo json_encode($response, JSON_PRETTY_PRINT);  
                    http_response_code(401);
                              
                } else {
                    foreach ($resultat as $key => $donnee) {
                        if (password_verify($mdp,$donnee["motdepasse"])) {
                            $enclenchementJeton = random_bytes(10);
                            $jeton =strtoupper(bin2hex($enclenchementJeton));
                            $requete = $pdo->prepare("INSERT INTO jetons (identifiant,jeton) VALUES (:identifiants,:jeton)");
                            $requete->execute ([
                                ":identifiants" => $id,
                                ":jeton" => $jeton
                                ]);                            
                            $response = [
                                "status"=> "Succes",
                                "jeton" => $jeton
                            ];
                            header('Content-Type: application/json; charset=UTF-8');
                            http_response_code(200);
                            echo json_encode($response, JSON_PRETTY_PRINT);                          
                            return;
                         }
                         if ($key === count($resultat)-1) {
                            $response = [
                                "status"=> "Erreur",
                                "message" => "Mot de passe incorrect"
                            ];
                           header('Content-Type: application/json; charset=UTF-8');
                            echo json_encode($response, JSON_PRETTY_PRINT);
                            http_response_code(401);
                         }
                         
                     }
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
        http_response_code(400);
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