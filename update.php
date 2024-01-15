<?php
require_once("select.php");
//récupère l'identifiant d'un animal à partir d'un paramètre de requête GET

    $idP = $_GET["idP"];
    //Le script exécute une requête SQL pour récupérer toutes les informations relatives à cet animal à partir de la base de 
    //données, puis il boucle à travers les résultats et stocke chaque champ dans une variable correspondante.
    $connection =connecter();
    $requete="SELECT * FROM AnimalE where idP=$idP";

    if ($requete === false) {
        die("Erreur de requête: " . mysqli_error($connection));
    }
    $query  = $connection->query($requete);
    $query->setFetchMode(PDO::FETCH_OBJ);

    while( $enregistrement = $query->fetch() )
    {
       $idP=$enregistrement->idP;
       $nom =$enregistrement->nom;
       $espece =$enregistrement->espece;
       $race =$enregistrement->race;
       $genre =$enregistrement->genre;
       $age =$enregistrement->age;
       $dateN =$enregistrement->dateN;
       $numeroT =$enregistrement->numeroT;
       $adresse =$enregistrement->adresse;

    }

//on  vérifie si les champs du formulaire ont été soumis par l'utilisateur. Si ce n'est pas le cas, il inclut un formulaire HTML pour que l'utilisateur puisse entrer les informations de l'animal.
    if (!isset($_POST["nom"])	&& !isset($_POST["espece"]) && !isset($_POST["race"]) && !isset($_POST["genre"]) && !isset($_POST["age"]) && !isset($_POST["dateN"])   && !isset($_POST["numeroT"]) && !isset($_POST["adresse"]) ) {
        include("./contenu/formulaireAnimal.php");
    }
    else{
        //on récupère les champs du formulaire soumis par l'utilisateur, les valide et affiche un message d'erreur approprié si nécessaire
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
        
        //Si tous les champs sont valides, le script exécute une requête SQL pour mettre à jour les informations de l'animal dans la base de données.
        $compteur_erreur=count($erreur);
        foreach ($erreur as $cle=>$valeur){
            if ($valeur==null) $compteur_erreur=$compteur_erreur-1;
        }

        if ($compteur_erreur == 0) {
            $connection =connecter();
            $sql = "UPDATE `AnimalE` SET  `nom` = :nom, `espece` = :espece,`race` = :race,`genre` = :genre,`age` = :age,`dateN` = :dateN,`numeroT` = :numeroT,`adresse` = :adresse WHERE idP=:idP ";
        
            include("./contenu/updateForm.php");
            $zonePrincipale=$corps ;
           
        }
        else {
            //on inclut un formulaire HTML pour afficher le résultat de la mise à jour des informations de l'animal. La variable $zonePrincipale est utilisée pour stocker le contenu HTML qui sera affiché dans la page. 
            include("./contenu/formulaireAnimal.php");
        } 
}
    
    

$connection = null;



?>
