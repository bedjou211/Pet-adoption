<?php
//Ce code est écrit en PHP et il permet de filtrer et trier une liste d'animaux à partir d'une base de données MySQL
require_once("./config/Lib.php");

//récupèrer les valeurs des variables passées par le formulaire et les utilise pour construire la requête SELECT qui va récupérer les animaux correspondant aux critères de filtrage.
    $genreF =isset($genreF)?$genreF:(key_exists('genre', $_POST)? trim($_POST['genre']): null);
    $especeF =isset($especeF)?$especeF:( key_exists('espece', $_POST)? trim($_POST['espece']): null);
    $triNom =isset($triNom)?$triNom:( key_exists('tri_nom', $_POST)? trim($_POST['tri_nom']): null);
    $triDate =isset($triDate)?$triDate:(key_exists('tri_date_naissance', $_POST)? trim($_POST['tri_date_naissance']): null);

    if($genreF == "male"){
        $male = "selected";
        $femelle = "";
    }
    else if ($genreF == "femelle"){
        $male="";
        $femelle = "selected";
    }
    else{
        $male="";
        $femelle="";
    }
    if($especeF == "chien"){
        $chien = "selected";
        $chat = "";
    }
    else if($especeF == "chat"){
        $chat = "selected";
        $chien="";
    }
    else{
        $chat="";
        $chien="";
    }
    //on  utilise les variables de tri pour trier les résultats de la requête avant de les afficher dans une table
    $corps="<h1 >Liste des animeaux</h1>";
    $corps.="<form style=\"    background-color: #834c4c;border-radius: 60px;padding:60px;margin:20px;\" method=\"post\" action=\"index.php?action=liste\">
    <label for=\"genre\">Genre :</label>
    <select name=\"genre\" id=\"genre\">
        <option value=\"male\"".$male.">Male</option>
        <option value=\"femelle\"".$femelle.">Femelle</option>
    </select>

    <label for=\"espece\">Espèce :</label>
    <select name=\"espece\" id=\"espece\">
        <option value=\"chien\"".$chien.">Chien</option>
        <option value=\"chat\"".$chat.">Chat</option>
    </select>

    <input type=\"submit\" value=\"Filtrer\">
    </form>";

    $corps.="<form style=\"    background-color: #834c4c;border-radius: 60px;margin:30px;padding:60px;\" method=\"post\" action=\"index.php?action=liste\">
    <label for=\"tri_nom\">Trier par Nom :</label>
    <select id=\"tri_nom\" name=\"tri_nom\">
      <option value=\"asc\">Ordre croissant</option>
      <option value=\"desc\">Ordre décroissant</option>
      <option value=\"rien\" selected>non spécifié</option>
    </select><br>
  
    <label for=\"tri_date_naissance\">Trier par Date :</label>
    <select id=\"tri_date_naissance\" name=\"tri_date_naissance\">
      <option value=\"ASC\">Ordre croissant</option>
      <option value=\"DESC\">Ordre décroissant</option>
      <option value=\"rien\" selected>non spécifié</option>
    </select><br>
  
    <input type=\"submit\" value=\"Trier\">
  </form>";

    $connection =connecter();
    /*** Exécution de la requête SELECT ***/
    if($especeF == NULL && $genreF == NULL){
        $requete="SELECT * FROM AnimalE";
    }
    else{
        if($especeF != NULL &&  $genreF == NULL){
            $requete="SELECT * FROM AnimalE WHERE espece ='".$especeF."'";
        }
        else if($genreF != NULL && $especeF == NULL){
            $requete="SELECT * FROM AnimalE WHERE genre ='".$genreF."'";
        }
        else{
            $requete="SELECT * FROM AnimalE WHERE genre ='".$genreF."' AND espece ='".$especeF."'";
        }
    }

    if($triDate != NULL && $triDate != "rien"){
        $requete.=" ORDER BY dateN ".$triDate;
        if($triNom != NULL && $triNom != "rien"){
            $requete .=", nom ".$triNom;
        }
    }
    else{
        if($triNom != NULL && $triNom != "rien"){
            $requete .=" ORDER BY nom ".$triNom;
        }
    }
    //un système de pagination pour limiter le nombre d'animaux affichés à la fois et faciliter la navigation dans la liste.

    //recupération de nombre total des objets dans la table
    $totalRequete ="SELECT COUNT(idP) FROM AnimalE";
    $totalQuery = $connection->query($totalRequete);
    $totalObjet = $totalQuery->fetchColumn();
    
    // Nombre d'objets à afficher par page
	$objectsParPage = 3;

    //Calcul de nombre de pages necessaire
	$totalPages = ceil($totalObjet / $objectsParPage);

    // Récupérer le numéro de la page courante
    if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
        $pageCourrante = $_GET["page"];
    } else {
        $pageCourrante = 1;
    }

    // Calculer l'indice de départ et l'indice de fin pour la page courante
    $indexDebut = ($pageCourrante - 1) * $objectsParPage;
    $indexFin = $indexDebut + $objectsParPage - 1;

    //echo "OBJECT TOTAL :".$totalObjet;
    
    // Récupérer le numéro de la page courante
    if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
        $pageCourrante = $_GET["page"];
    } else {
        $pageCourrante = 1;
    }
    //ajouter les limites à la requete
    $requete.=" LIMIT $indexDebut, $objectsParPage";
    // Vérification du résultat de la requête
    if ($requete === false) {
        die("Erreur de requête: " . mysqli_error($connection));
    }
    // On envois la requète
    $query  = $connection->query($requete);

    // On indique que nous utiliserons les résultats en tant qu'objet
    $query->setFetchMode(PDO::FETCH_OBJ);
    // Nous traitons les résultats en boucle
    $corps.= "<section  id=\"featured-animals\">";

    while( $enregistrement = $query->fetch() )
    {
        
        $tab_Personne[$idP]=array($nom,$espece,$race,$genre,$age,$dateN,$numeroT,$adresse);
        
        $corps.="<div class=\"animal-card\">";
        $corps.="<img src='data:".$enregistrement->imageType.";base64," . base64_encode($enregistrement->imageContent) . "' />";
        $corps.="<h3>".$enregistrement->nom."</h3>";
        $corps.="<p>".$enregistrement->espece."</p>";
        $corps.="<a href=\"index.php?action=select&idP=". $enregistrement->idP."\">Read</a>";
        $corps.="<a href=\"index.php?action=update&idP=".$enregistrement->idP." \">Update</a>";
        $corps.="<a href=\"index.php?action=delete&idP=".$enregistrement->idP." \">Delete</a>";
 
        $corps.="</div>";
        
    }
    
    $corps.="</section>";
   // echo "TOTAL PAGES : ".$totalPages;
    if ($totalPages > 1) { 
		$corps.="<div style=\"margin:30px;\">";
			if ($pageCourrante > 1) {
				$corps.="<a style=\" text-decoration: none;\" href=\"index.php?action=liste&page=".($pageCourrante - 1)."\">Page précédente</a>";
			} 

			for ($i = 1; $i <= $totalPages; $i++) { 
				if ($i == $pageCourrante) {
					$corps.="<span style=\"text-decoration: none;border: 1px solid red;padding: 10px;margin-bottom: 10px;\"> $i</span>";
				} else { 
					$corps.="<a style=\"text-decoration: none;border: 1px solid red;padding: 10px;margin-bottom: 10px;\" href=\"index.php?action=liste&page=$i\"> $i</a>";
			    } 
            } 

			if ($pageCourrante < $totalPages) {
				$corps .="<a style=\" text-decoration: none;\" href=\"index.php?action=liste&page=".($pageCourrante + 1)."\">Page suivante</a>";
			 }
		$corps.="</div>";
	}
	
    $zonePrincipale=$corps ;
    $query = null;
    $connection = null;
    
    

?>
