<?php
session_start();



$connn = mysqli_connect('192.168.65.60', 'test', 'test', 'JEUX');
	if (!$connn) {
		die("Connection failed: " . mysqli_connect_error());
	}



// partie count

$requete8 = "SELECT joueurs.nom, joueurs.prenom, 
COUNT(CASE WHEN matchs.resultat = 'victoire' THEN 1 END) AS victoire,
COUNT(CASE WHEN matchs.resultat = 'défaite' THEN 1 END) AS defait,
COUNT(CASE WHEN matchs.resultat = 'égalité' THEN 1 END) AS egaliter
FROM matchs 
INNER JOIN joueurs ON matchs.id_joueur = joueurs.id_joueur 
GROUP BY joueurs.id_joueur, joueurs.nom, joueurs.prenom ORDER BY `victoire` DESC LIMIT 3;";
  $winner = mysqli_query($connn, $requete8);  

?>


<h1>podium</h1>
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
		<div><tr>
			<td><?php echo $recap['prenom']; ?></td>
			<td><?php echo $recap['prenom']; ?></td>
			<td><?php echo $recap['victoire']; ?></td>
			<td><?php echo $recap['defait']; ?></td>
			<td><?php echo $recap['egaliter']; ?></td>
			
		</tr></div>
	<?php } ?>
</table>
