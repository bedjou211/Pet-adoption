<?php

$tab ="
<form action=\"index.php?action=sauvegarde\" method=\"post\" enctype=\"multipart/form-data\">
    <input type=\"hidden\" name=\"type\" value=\"confirmupdate\"/>
    <input type=\"hidden\" name=\"idP\" value=\"$idP\"/>
    <input type=\"hidden\" name=\"sql\" value=\"$sql\"/>
    <input type=\"hidden\" name=\"nom\" value=\"$nom\"/>
    <input type=\"hidden\" name=\"espece\" value=\"$espece\"/>
    <input type=\"hidden\" name=\"race\" value=\"$race\"/>
    <input type=\"hidden\" name=\"genre\" value=\"$genre\"/>
    <input type=\"hidden\" name=\"age\" value=\"$age\"/>
    <input type=\"hidden\" name=\"dateN\" value=\"$dateN\"/>
    <input type=\"hidden\" name=\"numeroT\" value=\"$numeroT\"/>
    <input type=\"hidden\" name=\"adresse\" value=\"$adresse\"/>
    
    Etes vous sûr de vouloir modifier cet animal ?
    <p>
        <input type=\"submit\" value=\"Enregistrer\" class=\"btn btn-danger\">
        <a href=\"index.php\" class=\"btn btn-secondary\">Annuler</a>
    </p>
</form>
";

$corps=$tab ;
?>
