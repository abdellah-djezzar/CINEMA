<?php
require ('connexion.php');

function pagi_to_array($nombreDePages, $pageActuelle)
{
  $page_url = "http://localhost/my_cinema/clients.php";
   $pagiArray = array();
   for($i=intval($pageActuelle-4); $i <= intval($pageActuelle+4) ; $i++)
   {
       if($i >= 1 && $i <= $nombreDePages)
       {
           if($i == $pageActuelle)
           {
               $pagiArray[] = '<a href="'.$page_url.'?page='.$i.'" class="pagi_link pagi_actual">'.$i.'</a>';
           }
           else
           {
               $pagiArray[] = '<a href="'.$page_url.'?page='.$i.'" class="pagi_link pagi_other">'.$i.'</a>';

           }

       }

   }
   return $pagiArray;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Cinema - Les Clients</title>
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
			<h2>Liste des clients</h2>
			<?php
				$offset = isset($_GET['page'])?(15*($_GET['page'] - 1)):'0';
				$connect_bdd = connect_db();
				$client_info = "SELECT `id_perso`, `nom`, `prenom`, `email` FROM fiche_personne ORDER BY nom ASC LIMIT 15 OFFSET ".$offset;
				$client_count = "SELECT * FROM fiche_personne";
				$client_count = $connect_bdd->query($client_count)->rowCount();
				$client_info = $connect_bdd->query($client_info);

			?>
			<table>
				<tr class="titre">
					<td>Nom & Prénom</td>
					<td>Email</td>
				</tr>
			<?php
			while($donnees = $client_info->fetch()){
			?>
				<tr class="donnees">
					<td><a href="client.php?id=<?php echo $donnees['id_perso']; ?>"><?php
					 echo strtoupper($donnees['nom']);?> <?php
					 echo ucfirst($donnees['prenom']);?></a></td>
					 <td><?php
					 echo $donnees['email'];?></td>
			<?php
			}?>
				</tr>
			</table>
			<?php

			$nbPages = ((INT)$client_count / (INT)15);
			foreach(pagi_to_array($nbPages, isset($_GET['page'])?$_GET['page']:1) as $pagi){
					echo $pagi;
			} ?>
		</div>
	</body>
</html>
