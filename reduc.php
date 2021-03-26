<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Cinema - Les réductions</title>
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
			<h2>Liste des réductions</h2>
			<?php
				require_once ('connexion.php');
				$connect_bdd = connect_db();
				$abo_info = $connect_bdd->query("SELECT `nom`, `pourcentage_reduc` FROM reduction ORDER BY `pourcentage_reduc` ASC");
			?>
			<table>
				<tr class="titre">
					<td>Nom des réductions</td>
					<td>Pourcentage de réduction</td>
				</tr>
			<?php
			while($donnees = $abo_info->fetch()){
			?>
				<tr class="donnees">
					<td><?php
					 echo $donnees['nom'];?></td>
					 <td><?php
					 echo $donnees['pourcentage_reduc'];?></td>
				</tr>

			<?php
			}
			?>
			</table>
		</div>
	</body>
</html>


