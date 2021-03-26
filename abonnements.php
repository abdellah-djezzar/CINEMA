<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Cinema - Les abonnements</title>
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
			<h2>Liste des abonnements</h2>
			<?php
				require_once ('connexion.php');
				$connect_bdd = connect_db();
				$abo_info = $connect_bdd->query("SELECT `nom`, `resum`, `prix`, `duree_abo` FROM abonnement ORDER BY `prix` ASC");
			?>
			<table>
				<tr class="titre">
					<td>Nom des abonnements</td>
					<td>Description</td>
					<td>Prix</td>
					<td>Durée des abonnements</td>
				</tr>
			<?php
			while($donnees = $abo_info->fetch()){
			?>
				<tr class="donnees">
					<td><?php
					 echo $donnees['nom'];?></td>
					 <td><?php
					 echo $donnees['resum'];?></td>
					 <td><?php
					 echo $donnees['prix'];?></td>
					 <td><?php
					 echo $donnees['duree_abo'];?></td>
				</tr>

			<?php
			}
			?>
			</table>
		</div>
	</body>
</html>


