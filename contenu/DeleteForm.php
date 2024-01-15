<?php

$tab ="
<form action=\"index.php?action=sauvegarde\" method=\"post\">
    <input type=\"hidden\" name=\"type\" value=\"confirmdelete\"/>
    <input type=\"hidden\" name=\"idP\" value=\"$idP\"/>
    <input type=\"hidden\" name=\"sql\" value=\"$sql\"/>
    Etes vous sûr de vouloir supprimer cet animal ?
    <p>
        <input type=\"submit\" value=\"Enregistrer\" class=\"btn btn-danger\">
        <a href=\"index.php\" class=\"btn btn-secondary\">Annuler</a>
    </p>
</form>";

$corps=$tab ;
?>
