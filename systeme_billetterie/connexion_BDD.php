<?php
function connexion_BDD () {
    $pdo =  new PDO("mysql:host=localhost:3306;dbname=projet_back_billetterie","root","");
    return $pdo;
}