<?php
session_start();



$conn = mysqli_connect('192.168.65.60', 'test', 'test', 'JEUX');
    echo"conecter a la base de donner";
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

$requete8 = "SELECT joueurs.nom, joueurs.prenom, 
COUNT(CASE WHEN matchs.resultat = 'victoire' THEN 1 END) AS victoire,
COUNT(CASE WHEN matchs.resultat = 'défaite' THEN 1 END) AS defait,
COUNT(CASE WHEN matchs.resultat = 'égalité' THEN 1 END) AS egaliter
FROM matchs 
INNER JOIN joueurs ON matchs.id_joueur = joueurs.id_joueur 
GROUP BY joueurs.id_joueur, joueurs.nom, joueurs.prenom ORDER BY `victoire` DESC LIMIT 3;";
  $winner = mysqli_query($connn, $requete8);  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>1st place</h1>

<?php while($recap = mysqli_fetch_assoc($winner)) { ?>
        <div>
        <div><?php echo $recap['prenom']; ?></div>
        <div><?php echo $recap['prenom']; ?></div>
        <div><?php echo $recap['victoire']; ?></div>
        <div><?php echo $recap['defait']; ?></div>
        <div><?php echo $recap['egaliter']; ?></div>
        <div>
        
    
<?php } ?>
<a href="index.php">Link Text</a>
</table>

</body>
</html>