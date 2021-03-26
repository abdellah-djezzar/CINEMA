<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Cinema - Fiche Client</title>
		<link rel="stylesheet" href="my_cinema.css">
	</head>
	<body> 
		<h1>Bienvenue sur le site MY_CINEMA !</h1>
		<nav>
			<ul>
				<li id="un"><a href="recherche.php">Rechercher un film</a></li>
				<li id="deux"><a href="abonnements.php">Abonnements</a></li>
				<li id="trois"><a href="reduc.php">Réductions</a></li>
				<li id="quatre"><a href="clients.php">Les Clients</a></li>
			</ul>
		</nav>
		<div class="conteneur">
			<h2>Fiche client</h2>
			<?php
				require_once ('connexion.php');
				$connect_bdd = connect_db();
				$id_page = intval($_GET['id']);
				$clients = $connect_bdd->query("SELECT `nom`, `prenom`, `date_naissance`, `email`, `cpostal`, `ville` FROM fiche_personne WHERE `id_perso` = '$id_page'");
			?>
			<table class="tbclient">
			<?php
			while($donnees = $clients->fetch()){
			?>
				<tr>
					<th>Nom</th>
					<td><?php
					 echo $donnees['nom'];?></td>
				</tr>
				<tr>
					<th>Prénom</th>
					 <td><?php
					 echo $donnees['prenom'];?></td>
				</tr>
				<tr>
					<th>Date de Naissance</th>
					 <td><?php
					 echo $donnees['date_naissance'];?></td>
				</tr>
					<th>Email</th>
					<td><?php
					 echo $donnees['email'];?></td>
				</tr>
			<?php
			}
			?>
			</table>
		</div>
	</body>
</html>