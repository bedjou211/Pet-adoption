<?php
require_once("./config/Lib.php");

//Si le formulaire n'est pas rempli, le formulaire est affiché pour permettre à l'utilisateur de saisir les informations.
if (!isset($_POST["nom"])	&& !isset($_POST["espece"]) && !isset($_POST["race"]) && !isset($_POST["genre"]) && !isset($_POST["age"]) && !isset($_POST["dateN"])   && !isset($_POST["numeroT"]) && !isset($_POST["adresse"]) ) {
        include("./contenu/formulaireAnimal.php");
}
else{

    //Le code vérifie les champs obligatoires et les formats des données saisies. Si une erreur est détectée, le formulaire est réaffiché avec les erreurs correspondantes. Si aucune erreur n'est détectée, les données sont insérées dans la base de données et un message de confirmation est affiché.
    $nom = key_exists('nom', $_POST)? trim($_POST['nom']): null;
    $espece = key_exists('espece', $_POST)? trim($_POST['espece']): null;
    $race = key_exists('race', $_POST)? trim($_POST['race']): null;
    $genre = key_exists('genre', $_POST)? trim($_POST['genre']): null;
    $age = key_exists('age', $_POST)? trim($_POST['age']): null;
    
    if ($nom=="") 	$erreur["nom"] ="il manque un nom"; 
    else if(valider_nom_prenom($nom)==false) $erreur["nom"] ="nom non valide";
    if ($espece=="") $erreur["espece"] ="il manque un espece"; 	
    else if(valider_nom_prenom($espece)==false) $erreur["espece"] ="espece non valide ";
    if ($race=="") $erreur["race"] ="il manque un race"; 	
    else if(valider_nom_prenom($race)==false) $erreur["race"] ="race non valide ";
    if ($genre=="") $erreur["genre"] ="il manque un genre"; 	
    else if(valider_nom_prenom($genre)==false) $erreur["genre"] ="genre non valide ";
    if ($age=="") $erreur["age"] ="il manque un age"; 	
    else if(verifAgeValide($age)==false) $erreur["age"] ="age non valide ";

    $dateN = key_exists('dateN', $_POST)? date('Y-m-d',strtotime($_POST['dateN'])): null;
    $numeroT = key_exists('numeroT', $_POST)? trim($_POST['numeroT']): null;
    $adresse = key_exists('adresse', $_POST)? trim($_POST['adresse']): null;


    if ($dateN=="") $erreur["dateN"] ="il manque le champ de la date de naissance"; 	
	else if (controlerDate($dateN)==false) $erreur["dateN"] ="date non valide"; 
    if ($numeroT=="") $erreur["numeroT"] ="il manque le numero de numeroT"; 	
	else if(controlerTel($numeroT)==false) $erreur["numeroT"] ="numero de telephone non valide"; 
    if ($adresse=="") $erreur["adresse"] ="il manque le champ de l'adresse";
	else if(controlerAlphanum($adresse)==false) $erreur["adresse"] =" adresse non valide " ;	 

    $ret = is_uploaded_file($_FILES['image']['tmp_name']);;
    if (!$ret){
        $erreur["image"] = "Erreur de chargement de fichier";
    }
    else {
      // Récupérer les informations de l'image
      $imageType = $_FILES['image']["type"];
      $typeaccepte = array("image/jpeg","image/jpg");
      if(!in_array($imageType,$typeaccepte)){
        $erreur["image"] = "Type de fichier non accepté ";
      }
      $imageTmpName = $_FILES['image']["name"];
  
      // Lire le contenu de l'image
      $imageContent = file_get_contents($_FILES['image']['tmp_name']);
  
    }

    $compteur_erreur=count($erreur);
    foreach ($erreur as $cle=>$valeur){
        if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
    }

    if ($compteur_erreur == 0) {
        $connection =connecter();
        $corps = "Ajout avec succes <br>";
        // Insérer l'objet dans la base de données avec l'image
      
        try{
            /*** préparation ***/
            $rq = "INSERT INTO `AnimalE` ( `nom`, `espece`, `race`,`genre`,`age`,`dateN`,`numeroT`,`adresse`,`imageContent`,`imageType`) VALUES 
            (:nom, :espece, :race, :genre, :age, :dateN, :numeroT, :adresse,:imageContent,:imageType)";
            /***On insère les données reçues***/
            $sth = $connection->prepare($rq);
            /*** remplissage des paramètres ***/
            $data = array(":nom" => $nom, ":espece" => $espece,":race" => $race,":genre" => $genre,":age" => $age,":dateN" => $dateN, ":numeroT" => $numeroT,":adresse" => $adresse,":imageContent" => $imageContent,":imageType" => $imageType);
            /*** exécution du statement ***/
            
            $sth->execute($data);
            $idP = $connection->lastInsertId();
            
            

        }
        catch(PDOException $e){
            echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
            
        }
        
        $patient = new AnimalE($idP,$nom,$espece,$race,$genre,$age,$dateN,$numeroT,$adresse);
        $corps .= "Insertion de : ". $patient;
        $zonePrincipale=$corps ;
        $connection = null;
       
    }
    else {
        include("./contenu/formulaireAnimal.php");
    }
}






?>
