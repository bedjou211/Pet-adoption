<?php

//ce fichier concerne le traitement des données du fomulaire contact ( envoie d'un e-mail);
// Récupération des données du formulaire

$nom = $_POST["nom"];
$email = $_POST["email"];
$sujet = $_POST["sujet"];
$message = $_POST["message"];


// Adresse e-mail du destinataire
$destinataire = "celinabedjou868@gmail.com";

// Construction du message
$contenu = "Nom : " . $nom . "\n";
$contenu .= "E-mail : " . $email . "\n";
$contenu .= "Sujet : " . $sujet . "\n";
$contenu .= "Message : " . $message . "\n";

// Envoi de l'e-mail
$sujet_mail = "Nouveau message depuis le formulaire de contact";
$headers = "From: " . $email . "\r\n" .
           "Reply-To: " . $email . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

if (mail($destinataire, $sujet_mail, $contenu, $headers)) {
  echo "envoyé";
  exit;
} else {
  echo "Erreur : le formulaire est plein d'erreur";
  exit;
}









?>