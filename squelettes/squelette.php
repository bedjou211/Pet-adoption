<!DOCTYPE html>
<html>
<head>
	<title>Adoptez un ami fidèle - Accueil</title>
	<link rel="stylesheet" href="./style/style.css">
</head>
<body>
	<header>
		<h1>Adoptez un ami fidèle</h1>
		<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				
				<li><a href="./contenu/apropos.html">À propos</a></li>
				<li><a href="./contenu/contact.html">Contact</a></li>
			</ul>
		</nav>
	</header>
	
	<main>
		<section id="hero">
            
			<a href="index.php?action=liste" class="cta">Voir les animaux disponibles</a>
		</section>
		 <h2 style=" text-align: center;" ><a href="index.php?action=insert" id="ajouter" >Ajouter un nouveau annimal</a></h2>
        <h2 style="text-align: center;">Animaux en vedette</h2>
		<section  id="php">
		<?php  echo $zonePrincipale; ?> 
</section>
		<section id="about">
			<h2>À propos de nous</h2>
			<p>Nous sommes une organisation à but non lucratif qui se consacre à la sauvegarde et à l'adoption d'animaux de compagnie. Depuis notre fondation, nous avons aidé des centaines d'animaux à trouver une nouvelle maison aimante.</p>
		</section>
	</main>
	
	<footer>
		<h2 id="tit">Donnez une nouvelle vie à un ami fidèle</h2>
		<p>© 2023 Adoptez un ami fidèle -BEDJOU CELINA  </p>
	</footer>
</body>
</html>
