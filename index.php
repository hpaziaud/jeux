<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Jeu de pierre, papier, ciseaux</title>
</head>
<body>
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
<?php while($tabjouerN = mysqli_fetch_assoc($result1)) { echo"coucou";?>
<h1>cest une <?php echo $tabjouerN['resultat']; ?></h1>
<?php } ?>

<?php
// partie count

$requete8 = "SELECT joueurs.nom,joueurs.prenom,COUNT(matchs.id_joueur) FROM `matchs`,`joueurs` WHERE matchs.resultat='victoire' AND matchs.id_joueur=joueurs.id_joueur GROUP BY id_joueur;";
    }else{echo"";}
  $resultat8 = $GLOBALS["pdo"]->query($requete8);
  $tabjouerG = $resultat8->fetchALL();

?>



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