<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Jeu de pierre, papier, ciseaux</title>
</head>
<body>
<a href="podium.php">voir podium</a>
	<h1>Jeu de pierre, papier, ciseaux</h1>
	
	<?php if(isset($_SESSION['prenom'])) { ?>
		<p>Bienvenue, <?php echo $_SESSION['prenom']; ?> !</p>
		<form method="post" action="jouer.php">
			<p>Choisissez votre coup :</p>
			<input type="radio" name="coup" value="pierre" id="pierre"><label for="pierre">Pierre</label><br>
			<input type="radio" name="coup" value="papier" id="papier"><label for="papier">Papier</label><br>
			<input type="radio" name="coup" value="ciseaux" id="ciseaux"><label for="ciseaux">Ciseaux</label><br>
			<input type="submit" value="Jouer">
		</form>
		<p><a href="deconnexion.php">Déconnexion</a></p>
	<?php } else { ?>
		<form method="post" action="inscription.php">
			<p>Inscrivez-vous pour jouer :</p>
			<label for="prenom">Prénom :</label>
			<input type="text" name="prenom" id="prenom" required><br>
			<label for="nom">Nom :</label>
			<input type="text" name="nom" id="nom" required><br>
			<input type="submit" value="S'inscrire">
		</form>
	<?php }  ?>

	
	
	
	
	
	<?php


// Connexion à la base de données
$connn = mysqli_connect('192.168.65.60', 'test', 'test', 'JEUX');

// Vérification de la connexion
if (!$connn) {
die("Connection failed: " . mysqli_connect_error());
}

// Récupération des parties jouées par le joueur
$sql = "SELECT * FROM matchs, joueurs where matchs.id_joueur = joueurs.id_joueur ORDER BY `matchs`.`date_match` DESC";
$result = mysqli_query($connn, $sql);

$sql1 = "SELECT * FROM `matchs` ORDER BY `date_match` DESC LIMIT 1";
$result1 = mysqli_query($connn, $sql1);


?>
<?php if(isset($_SESSION['prenom']) && basename($_SERVER['PHP_SELF']) === 'jouer.php') {while($tabjouerN = mysqli_fetch_assoc($result1)) {?>
<h1>cest une <?php echo $tabjouerN['resultat']; ?></h1>
<?php } }else{echo "";}?>







<?php
// partie count

$requete8 = "SELECT joueurs.nom, joueurs.prenom, 
COUNT(CASE WHEN matchs.resultat = 'victoire' THEN 1 END) AS victoire,
COUNT(CASE WHEN matchs.resultat = 'défaite' THEN 1 END) AS defait,
COUNT(CASE WHEN matchs.resultat = 'égalité' THEN 1 END) AS egaliter
FROM matchs 
INNER JOIN joueurs ON matchs.id_joueur = joueurs.id_joueur 
GROUP BY joueurs.id_joueur, joueurs.nom, joueurs.prenom ORDER BY `victoire` DESC;";
  $winner = mysqli_query($connn, $requete8);  

?>


<h1>tableau de bord</h1>
<p>Voici le recapitulatife :</p>
<table>
	<tr>
		<th>name</th>
		<th>surname</th>
		<th>victoire</th>
		<th>Defaite</th>
		<th>Egalité</th>

	</tr>
	<?php while($recap = mysqli_fetch_assoc($winner)) { ?>
		<tr>
			<td><?php echo $recap['prenom']; ?></td>
			<td><?php echo $recap['prenom']; ?></td>
			<td><?php echo $recap['victoire']; ?></td>
			<td><?php echo $recap['defait']; ?></td>
			<td><?php echo $recap['egaliter']; ?></td>
			
		</tr>
	<?php } ?>
</table>








<h1>Résultats</h1>
<p>Voici les résultats de toutes les parties jouées :</p>
<table>
	<tr>
		<th>Date</th>
		<th>Votre coup</th>
		<th>Coup de l'ordinateur</th>
		<th>Résultat</th>
		<th>nom</th>
		<th>prenom</th>
	</tr>
	<?php while($row = mysqli_fetch_assoc($result)) { ?>
		<tr>
			<td><?php echo $row['date_match']; ?></td>
			<td><?php echo $row['choix_joueur']; ?></td>
			<td><?php echo $row['choix_ordi']; ?></td>
			<td><?php echo $row['resultat']; ?></td>
			<td><?php echo $row['nom']; ?></td>
			<td><?php echo $row['prenom']; ?></td>
		</tr>
	<?php } ?>
</table>

</body>
</html>
