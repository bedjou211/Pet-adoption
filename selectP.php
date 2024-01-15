<?php
//Ce code est  est utilisé pour récupérer des données d'une base de données MySQL et les afficher sur une page web.
//récupérer la valeur de la variable $_GET["idP"], qui est l'identifiant de l'animal 
$idP=$_GET["idP"];
    $corps="";
    //se connecter a la base 
    $connection =connecter();
    // exécuter une requête SQL pour récupérer les informations de l'animal correspondant à l'identifiant $idP.
    $requete="SELECT * FROM AnimalE where idP=".$idP;
    $query  = $connection->query($requete);
    $query->setFetchMode(PDO::FETCH_OBJ);

    // parcourir les résultats de la requête et stocker les informations de chaque animal dans une variable $corps.
    while( $enregistrement = $query->fetch() )
    {
        $corps .="<img src='data:".$enregistrement->imageType.";base64," . base64_encode($enregistrement->imageContent) . "' />";
        $corps .= '<h2>Description </h2>';
        $corps .= '<p>Hi, je m appelle '.$enregistrement->nom.' .J ai '.$enregistrement->age.' ans et je suis un(e) '.$enregistrement->genre.'. J attends avec impatience mon adoption.</p>';
        $corps .='<ul>';
        $corps .= '<li> <I>  IdP  </I>  <B>= '.$enregistrement->idP.'</B></li>';
        $corps .= '<li>  <I>  Nom  </I> <B>  = '.$enregistrement->nom.'</B></li>';
        $corps .= '<li>  <I> Espece  </I> <B> = '.$enregistrement->espece.'</B></li>';
        $corps .= '<li>  <I> Race  </I> <B> = '.$enregistrement->race.'</B></li>';
        $corps .= '<li>  <I> Genre  </I> <B> = '.$enregistrement->genre.'</B></li>';
        $corps .= '<li>  <I> Age  </I> <B> = '.$enregistrement->age.'</B></li>';
        $corps .= '<li>  <I>  Date de Naissance  </I>   <B>= '.$enregistrement->dateN.'</B></li>';
        $corps .='<li>  <I>  Telephone  </I>  <B> = '.$enregistrement->numeroT.'</B></li>';
        $corps .='<li>   <I> Adresse </I>  <B> ='.$enregistrement->adresse.'</B></li>';
        $corps .='</ul>';

    }
    // fermer la connexion à la base de données, stocke la variable $corps dans la variable $zonePrincipale, qui est utilisée pour afficher les informations sur la page web.
     $query = null;
    $connection = null;
    $zonePrincipale=$corps ;
   
?> 
