<?php 
require_once "vendor/autoload.php";
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
require "./session_start_prim.php";
session_start_prim();
if (isset($_SESSION["individu_connecte"])) {

        $jeton = $_SESSION["individu_connecte"]["jeton"];
        $client = new Client([
//                     Franchement ici, je ne sais plus quoi marchera chez tous 🤯, si ça retourne une erreur de connexion chez vous, essayez 
'base_uri' => 'http://localhost', #'http://localhost:numéro_de_port' mais chez certains membres de groupe; ça passe pas non plus 🤷.
]);                                     #Peut-etre lancer le système d'api par le terminal dans le dossier "systeme-auth" et dans ce cas,
 # juste "/logout" pour l'URL. C'est les trois façons qu'on a pu connaitre après vos aides de debug,ceci par défaut marche bien ici
        $donnes = [  #mais les essais sur chaque poste nous montrent différentes façons de faire, meme sur certains postes
            'jeton' => $jeton # aucune façon de faire n'a marché 🤣, j'ignore toujours les raisons de ce problème.
        ];  # Espérant que ça marche d'un coup chez vous 🙂.
    
        try {
            $response = $client->request('GET','/back-end/systeme-auth/logout', [
                "json" => $donnes
            ]);
            $bodye = $response->getBody();
            $bodye = json_decode($bodye,true); 
            setcookie("jeton");           
            session_destroy();
            header("location:dashboard.php");
        }   catch(ConnectException $e)
        {?>
        <p>Erreur de connexion à l'api</p>
        <?php
         } catch (ClientException $e){ #Ce n'est pas probable qu'on vienne ici mais bon 🤷.
            if ($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() == '400') {
                    header("location:dashboard.php");
                } elseif ($e->getResponse()->getStatusCode() == '401') {
                    header("location:dashboard.php");
                }
            }    
        }
    } else {
        header("location:verify_token.php?endpoint_courant=logout.php");
    }
?>