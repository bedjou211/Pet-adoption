<?php
require_once("AnimalE.php");
/*La fonction connecter() permet de se connecter à une base de données MySQL en utilisant l'API PDO de PHP. Les informations de connexion sont stockées dans des variables $dsn, $user et $pass. */
function connecter()
{
    try {
        $dsn = "mysql:host=mysql.info.unicaen.fr;port=3306;dbname=bedjou211_1;charset=utf8";
        $user = "bedjou211" ;
        $pass = "Nohthoh1xaiguo6e";

        // Options de connection
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        );
        $connection = new PDO( $dsn, $user, $pass, $options );
        return($connection);
    
    
    } catch ( Exception $e ) {
        echo "Connection à MySQL impossible : ", $e->getMessage();
        die();
    }
}

/*La fonction controlerEmail($valeur) vérifie si la valeur passée en argument est une adresse email valide. Elle utilise la fonction filter_var() de PHP avec le filtre FILTER_VALIDATE_EMAIL. */
function controlerEmail($valeur) {
	if(filter_var($valeur, FILTER_VALIDATE_EMAIL))return true;
    else return false;
}

/*La fonction valider_nom_prenom($nom_prenom) vérifie si la valeur passée en argument est un nom ou un prénom valide, c'est-à-dire qu'elle ne contient que des lettres alphabétiques, des espaces, des tirets et des apostrophes, et qu'elle ne dépasse pas une certaine longueur. */
function valider_nom_prenom($nom_prenom) {
    // Supprimer les espaces en début et fin de la chaîne
    $nom_prenom = trim($nom_prenom);
    
    // Vérifier que la chaîne ne contient que des lettres alphabétiques, des espaces, des tirets et des apostrophes
    if (!preg_match("/^[a-zA-Z '-]+$/", $nom_prenom)) {
      return false;
    }
    
    // Vérifier que la chaîne ne dépasse pas une certaine longueur
    if (strlen($nom_prenom) > 50) {
      return false;
    }
    
    return true;
  }
  
  /*La fonction controlerDate($valeur) vérifie si la valeur passée en argument est une date valide. Elle utilise une expression régulière pour vérifier le format de la date et la fonction checkdate() de PHP pour vérifier si la date est valide. */
function controlerDate($valeur) {
    if (preg_match("/^(\d{4})[\-](\d{2})[\-](\d{2})$/", $valeur, $regs)) {
        $an = $regs[1];
        $mois = $regs[2];
        $jour = $regs[3];
        if (checkdate($mois, $jour, $an)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
/*
function controlerDate($valeur) {
    if (preg_match("/^(\d{1,2})[\/|\-|\.](\d{1,2})[\/|\-|\.](\d\d)(\d\d)?$/", $valeur, $regs)) {
        $jour = ($regs[1] < 10) ? "0".$regs[1] : $regs[1]; 
        $mois = ($regs[2] < 10) ? "0".$regs[2] : $regs[2]; 
        if ($regs[4]) $an = $regs[3] . $regs[4];
              if (checkdate($mois, $jour, $an)) return true;
        else return true;
    }
    else return true;
}*/

/*La fonction controlerHeure($valeur) vérifie si la valeur passée en argument est une heure valide, au format hh:mm. */
function controlerHeure($valeur) {
    return (preg_match("/^(?:2[0-4]|[01][1-9]|10):([0-5][0-9])$/", $valeur));
}
function controlerAlphanum($valeur) {
    if (preg_match("/^[\w|\d|\s|'|\"|\\|,|\.|\-|&|#|;]+$/", $valeur)) return true;
    else return false;
}   
function controlerNum($valeur, $strict=false) {
    if ($strict) {
        if (ereg("^[0-9]+$", $valeur)) return true;
        else return false;
    }
    else if (preg_match("/^[\d|\s|\-|\+|E|e|,|\.]+$/", $valeur)) return true;
    else return false;
}   
function controlerTel($valeur) {
	if (preg_match('#^(0|\+33)[1-9]( *[0-9]{2}){4}$#', $valeur)) 
	return true ;
	else return false;
}   
function controlerCP($valeur) {
	if ( preg_match ("~^[0-9]{5}$~",$valeur))
		return true;
	else
		return false;
}  
function verifAgeValide($age) {
    if (!is_numeric($age) || $age <= 0 || $age > 120) {
        return false;
    } else {
        return true;
    }
}

/*La fonction is_valid_image($filename) vérifie si le fichier passé en argument est une image valide, c'est-à-dire si son format est pris en charge (jpg, jpeg, png ou gif) et s'il contient des données d'image valides. */
function is_valid_image($filename) {
    $valid_formats = array("jpg", "jpeg", "png", "gif");
    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($file_extension, $valid_formats)) {
        // le format de l'image n'est pas valide
        return false;
    }
    
    // récupérer les informations sur l'image
    $image_info = @getimagesize($filename);
    if (!$image_info) {
        // l'image n'est pas valide
        return false;
    }
    
    // vérifier que l'image a une taille valide
    if ($image_info[0] == 0 || $image_info[1] == 0) {
        // la taille de l'image est invalide
        return false;
    }
    
    // l'image est valide
    return true;
}

function Calendrier($annee, $mois)
{
// classes calandrier,titre,mois,en_valeur,lien,normal
    $deb_mois = mktime (0,0,0, $mois, 1, $annee);   
    static $semaine = array('Dim','Lun','Mar','Mer','Jeu','Ven','Sam');
    $maxdays   = date('t', $deb_mois); #number of days in the month
    $date_info = getdate($deb_mois);   #get info about the first day of the month
    $mois     = $date_info['mon'];
    $annee      = $date_info['year'];

    $calendar  = "<table class=\"calendrier\" >\n";    
    $calendar .= "<tr bgcolor=\"#999999\" class=\"titre\"><th colspan=\"7\" class=\"mois\">$date_info[month], $annee</th></tr>\n";    


    $calendar .= '<tr>';
    for ($i=0;$i<7;$i++) $calendar .= "<th>".$semaine[$i]."</th>";

    $calendar .= '</tr>';
    $calendar .= '<tr>';

    $weekday = $date_info['wday']; #weekday (zero based) of the first day of the month
    $day = 1; #starting day of the month
    
    #take care of the first "empty" days of the month
    if($weekday > 0){$calendar .= "<td colspan=\"$weekday\">&nbsp;</td>";}

    #print the days of the month
    while ($day <= $maxdays)
    {
        if($weekday == 7)#start a ne week
        { 
            $calendar .= "</tr>\n<tr>";
            $weekday = 0;
        }
      

		$calendar .= "<td class=\"normal\"> $day</td>\n";
   
        $day++;
        $weekday++;
    }
    if($weekday != 7)
    {
        $calendar .= '<td colspan="' . (7 - $weekday) . '">&nbsp;</td>';
    }
    return $calendar . "</tr>\n</table>\n";
}





$idP=null;$nom = null;$espece = null;$race=null;$genre=null;$age=null;$dateN = null;$numeroT =  null;$adresse = null;		
$erreur=array("nom"=>null,"espece"=>null,"race"=>null,"genre"=>null,"age"=>null,"dateN"=>null,"numeroT"=>null,"adresse"=>null,"image"=>null);
$tab_Personne=array();
?>
