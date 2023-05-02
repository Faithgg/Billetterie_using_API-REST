<?php
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
require "./session_start_prim.php";
session_start_prim();
$endpoint_courant = $_SESSION["endpoint_courant"];
$jeton = filter_input(INPUT_COOKIE, "jeton");
if(!isset($_SESSION["individu_connecte"]))
{
    if (!$jeton) {
        header("location:dashboard.php");
    } else {
        
        require_once "./vendor/autoload.php";      
        $client = new Client([
//                     Franchement ici, je ne sais plus quoi marchera chez tous 🤯, si ça retourne une erreur de connexion chez vous, essayez 
'base_uri' => 'http://localhost', #'http://localhost:numéro_de_port' mais chez certains membres de groupe; ça passe pas non plus 🤷.
]);                                     #Peut-etre lancer le système d'api par le terminal dans le dossier "systeme-auth" et dans ce cas,
 # juste "/verify" pour l'URL. C'est les trois façons qu'on a pu connaitre après vos aides de debug,ceci par défaut marche bien ici
        $donnes = [  #mais les essais sur chaque poste nous montrent différentes façons de faire, meme sur certains postes
            'jeton' => $jeton # aucune façon de faire n'a marché 🤣, j'ignore toujours les raisons de ce problème.
        ];  # Espérant que ça marche d'un coup chez vous 🙂.
        
        try {
            $response = $client->request('POST','/back-end/systeme-auth/verify', [
                "json" => $donnes
               ]);
            $bodye = $response->getBody();
            $bodye = json_decode($bodye,true);
            $_SESSION["individu_connecte"] = [
                "identifiant" => $bodye["utilisateur"]["identifiant"],
                "jeton" => $jeton
            ]; 
                           
            header("location:$endpoint_courant");
        }   catch(ConnectException $e)
        {
            $_SESSION["donnees_justes"] = false;
            $_SESSION["Error_message"] = "Error de connexion au systheme d'API,";
            header("location:verify_token.php");
         } catch (ClientException $e){
                if ($e->hasResponse()){
                    if (($e->getResponse()->getStatusCode() == '400') || ($e->getResponse()->getStatusCode() == '401')) {
                        header("location:dashboard.php");
                    }
                }    
            }
    }
} else {
    header("location:$endpoint_courant");
}
