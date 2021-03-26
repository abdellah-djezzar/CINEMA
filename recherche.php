<?php
require ('connexion.php');

function pagi_to_array($nombreDePages, $pageActuelle)
{
  $page_url = "http://localhost/my_cinema/recherche.php";
  $request = isset($_POST['requete'])?$_POST['requete']:'';
   $pagiArray = array();
   for($i=intval($pageActuelle-4); $i <= intval($pageActuelle+4) ; $i++)
   {
       if($i >= 1 && $i <= $nombreDePages)
       {
           if($i == $pageActuelle)
           {
               $pagiArray[] = '<a href="'.$page_url.'?page='.$i.'&request='.$request.'" class="pagi_link pagi_actual">'.$i.'</a>';
           }
           else
           {
               $pagiArray[] = '<a href="'.$page_url.'?page='.$i.'&request='.$request.'" class="pagi_link pagi_other">'.$i.'</a>';

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
		<title>My Cinema - Rechercher</title>
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
			<h2>Recherchez votre film !</h2>
		</div>
		<form action="recherche.php" method="Post">
			<input type="text" name="requete" placeholder="Rechercher par nom, genre, distrib...">
			<input type="submit" value="Lancer la recherche">
		</form>
		<div id="recherche">
			<?php 
				if( (!empty($_POST['requete'])) || isset($_GET['request']) )
				{
					$_POST['requete'] = (!empty($_POST['requete']))?$_POST['requete']:$_GET['request'];
					$connect_bdd = connect_db();
					$requete = htmlspecialchars($_POST['requete']);
					$offset = isset($_GET['page'])?(15*($_GET['page'] - 1)):'0';
					$query = "SELECT * FROM `film` LEFT JOIN genre ON film.id_genre = genre.id_genre LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib WHERE `titre` LIKE '%$requete%' OR genre.nom LIKE '%$requete%' OR distrib.nom LIKE '%$requete%' ORDER BY `titre` ASC LIMIT 15 OFFSET ".$offset;
					$queryCount = "SELECT * FROM `film` LEFT JOIN genre ON film.id_genre = genre.id_genre LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib WHERE `titre` LIKE '%$requete%' OR genre.nom LIKE '%$requete%' OR distrib.nom LIKE '%$requete%' ORDER BY `titre` ASC";
					$total_count = $connect_bdd->query($queryCount)->rowCount();

					if ($total_count != 0)
						{
			?>
							<h3>Résultats de votre recherche</h3>
							<p>Nous avons trouvé <?php echo $total_count." film(s) correspondant à votre recherche."; ?></p>

							<?php foreach($connect_bdd->query($query) as $row): ?>
								<a class="film" href="film.php?id=<?php echo $row['id_film']; ?>"><?php echo $row['titre']; ?></a><br/>
							<?php endforeach; ?>


							<?php 
							$nbPages = ((INT)$total_count / (INT)15);
							foreach(pagi_to_array($nbPages, isset($_GET['page'])?$_GET['page']:1) as $pagi){
									echo $pagi;
							} ?>

								<p><a id="new" href="recherche.php">Faire une nouvelle recherche</a></p>
								<?php
						}
						else
						{
						?>
						<h3>Aucun résultats</h3>
						<p>Nous n'avons trouvé aucun résultats pour votre requête "<?php echo $_POST['requete']; ?>". <a href="recherche.php">Réessayez</a> avec autre chose.</p>
						<?php
						}
				}?>
		</div>
	</body>
</html>