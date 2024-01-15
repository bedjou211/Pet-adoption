<?php
require_once("./config/Lib.php");
$action = key_exists('action', $_GET)? trim($_GET['action']): null;
$sauvegarde = key_exists('sauvegarde', $_GET)? trim($_GET['sauvegarde']): null;
switch ($action) {

    case "sauvegarde": 
        include("sauvegarde.php");
        break;
    case "update": //un id particulier
        $cible='update';
        include('update.php');
        break;

    case "delete": 
        include('delete.php');
        break;
    case "select": //un id particulier
        include("selectP.php");
        break;
    case "liste": //liste complète
        include("select.php");
        break;

    case "insert": //Saisie  via le formulaire    et insertion dans la base de données
        $cible='insert';
        
        include("insert.php");
        break;
    
 default:
   $zonePrincipale="" ;
   break;
   
}
include("squelettes/squelette.php");

?>
