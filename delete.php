<?php
/*Ce code PHP supprime une entrée de la table "AnimalE" dans une base de données en fonction de l'ID spécifié dans l'URL. Le code récupère l'ID à partir de la variable superglobale $_GET, puis exécute une requête SQL de suppression en utilisant cet ID pour identifier la ligne à supprimer. Ensuite, il inclut un formulaire de confirmation de suppression à afficher dans la zone principale de la page Web, puis ferme la connexion à la base de données. */
$cible='delete';

$idP=$_GET["idP"];
$connection =connecter();
$sql="DELETE FROM AnimalE where idP like '$idP'";
include("./contenu/DeleteForm.php");
$zonePrincipale=$corps ;
$connection = null;


?>
