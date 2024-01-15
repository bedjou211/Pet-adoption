<?php

//se connecter a la base
$connection =connecter();
//on vérifie si les clés "idP", "sql" et "type" sont présentes dans la requête POST. Si oui, il les récupère et les assigne à des variables.
$idP = key_exists('idP',$_POST)? $_POST['idP']: null;
$sql = key_exists('sql',$_POST)? $_POST['sql']: null;
$type = key_exists('type',$_POST)? $_POST['type']: null;
// Si la valeur de "type" est "confirmupdate", le code récupère d'autres valeurs (nom, espèce, race, genre, âge, date de naissance, numéro de téléphone et adresse) depuis la requête POST et les stocke dans un tableau associatif "data".
if ($type =='confirmupdate'){
    $corps="<h1>Mise à jour de l'animal ".$idP."</h1>" ;
    $nom = key_exists('nom',$_POST)? $_POST['nom']: null;
    $espece = key_exists('espece',$_POST)? $_POST['espece']: null;
    $race = key_exists('race',$_POST)? $_POST['race']: null;
    $genre = key_exists('genre',$_POST)? $_POST['genre']: null;
    $age = key_exists('age',$_POST)? $_POST['age']: null;
    $dateN = key_exists('dateN', $_POST)? trim($_POST['dateN']): null;
    $numeroT = key_exists('numeroT', $_POST)? trim($_POST['numeroT']): null;
    $adresse = key_exists('adresse', $_POST)? trim($_POST['adresse']): null;
    $image = key_exists('imageContent', $_POST)? trim($_POST['imageContent']): null;
    $data= array(":nom"=>$nom,":espece"=>$espece,":race"=>$race,":genre"=>$genre,":age"=>$age,":dateN"=>$dateN,":numeroT"=>$numeroT,":adresse"=>$adresse,":idP"=>$idP);
}
//Si la valeur de "type" est différente de "confirmupdate", le code stocke simplement la valeur de "idP" dans le tableau "data" et construit une chaîne de caractères "corps" contenant un message de suppression de l'animal.
else{
    $corps="<h1>Suppression de l'animal ".$idP."</h1>" ;
    $data= array(":idP"=>$idP);
}
//Le code prépare ensuite une requête SQL en utilisant la variable "sql" récupérée précédemment et exécute la requête en utilisant le tableau "data" comme paramètres
$req=$connection->prepare($sql);

$req->execute($data);	
$connection = null;
$zonePrincipale=$corps ;		







?>
