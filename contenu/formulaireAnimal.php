<?php
if($genre == "male"){$male = "selected";}else{$male = "";}
if($genre == "femelle"){$female="selected";}else{$female="";}
if($espece == "chien"){$chien = "selected";}else{$chien = "";}
if($espece == "chat"){$chat="selected";}else{$chat="";}
$corps ="
  <form method=\"post\"  action=\"index.php?action={$cible}&idP={$idP}\" name=\"form_user\" enctype=\"multipart/form-data\">
  <label>Nom :  </label>
  <input type=\"text\" name=\"nom\"  value=\"$nom\">
  <span >".$erreur["nom"]."</span><br>
    
  <label for=\"espece\">Espece :</label>
  <select id=\"espece\" name=\"espece\">
    <option value=\"chien\" $chien>Chien</option>
    <option value=\"chat\" $chat>Chat</option>
  </select><br>

  <label>Race :</label>
  <input type=\"text\" name=\"race\"  value=\"$race\">
  <span >".$erreur["race"]."</span><br>

  <label for=\"genre\">Genre :</label>
  <select id=\"genre\" name=\"genre\">
    
    <option value=\"male\"$male>Mâle</option>
    <option value=\"femelle\" $female>Femelle</option>
  </select><br>

  <label>Age :</label>
  <input type=\"text\" name=\"age\"  value=\"$age\">
  <span>".$erreur["age"]."</span><br>


  <label>DateN :  </label>

  <input type=\"date\" name=\"dateN\"  value=\"$dateN\">
  <span >".$erreur["dateN"]."</span><br>
    
  <label>Telephone :</label>
  <input type=\"text\" name=\"numeroT\"  value=\"$numeroT\">
  <span >".$erreur["numeroT"]."</span><br>

  <label>Adresse :  </label>
  <textarea name=\"adresse\"  rows=\"5\" cols=\"33\">$adresse </textarea>
  <span >".$erreur["adresse"]."</span><br>
    
  <label for=\"image\">Image :</label>
  <input type=\"file\" name=\"image\" id=\"image\">
  <span >".$erreur["image"]."</span><br>
  <input type=\"submit\" name=\"user_valider\" value=\"Valider\"  >
      
</form>

";
$zonePrincipale=$corps ;
?>