<?php session_start();
//jouer.php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['prenom'])) {
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$coup_joueur = $_POST['coup'];

	// Connexion à la base de données
	$conn = mysqli_connect('192.168.65.60', 'test', 'test', 'JEUX');

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Génération d'un coup aléatoire pour l'ordinateur
	$coups_possibles = array('pierre', 'papier', 'ciseaux');
	$coup_ordi = $coups_possibles[array_rand($coups_possibles)];

	// Détermination du gagnant
	if ($coup_joueur == $coup_ordi) {
		$resultat = 'égalité';
	} else if (($coup_joueur == 'pierre' && $coup_ordi == 'ciseaux') || ($coup_joueur == 'papier' && $coup_ordi == 'pierre') || ($coup_joueur == 'ciseaux' && $coup_ordi == 'papier')) {
		$resultat = 'victoire';
	} else {
		$resultat = 'défaite';
	}

	// Insertion du résultat dans la table "matchs"
	$sql = "INSERT INTO matchs (id_joueur, choix_joueur, choix_ordi, resultat) SELECT id_joueur, '$coup_joueur', '$coup_ordi', '$resultat' FROM joueurs WHERE prenom = '$prenom' AND nom = '$nom';";

	if (mysqli_query($conn, $sql)) {
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
} else {
}


//inscription.php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["S'inscrire"])) {
	$prenom = $_POST['prenom'];
	$nom = $_POST['nom'];
	$_SESSION['prenom'] = $prenom;
	$_SESSION['nom'] = $nom;

	// Connexion à la base de données
	$conn = mysqli_connect('192.168.65.60', 'test', 'test', 'JEUX');
	if (!$conn) {
		die("Connexion échouée: " . mysqli_connect_error());
	}




	// Insertion du nouvel utilisateur dans la table "joueurs"
	$sql = "INSERT INTO joueurs (prenom, nom) VALUES ('$prenom', '$nom');";
	if (mysqli_query($conn, $sql)) {
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}



?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/comment.css">
	<title>Jeu de pierre, papier, ciseaux</title>
</head>

<body>

	<h1>Jeu de pierre, papier, ciseaux</h1>

	<?php if (isset($_SESSION['prenom'])) { ?>
		<p>Bienvenue, <?php echo $_SESSION['prenom']; ?> !</p>
		<form method="post" action="">
			<p>Choisissez votre coup :</p>
			<input type="radio" name="coup" value="pierre" id="pierre" required><label for="pierre">Pierre</label><br>
			<input type="radio" name="coup" value="papier" id="papier"><label for="papier">Papier</label><br>
			<input type="radio" name="coup" value="ciseaux" id="ciseaux"><label for="ciseaux">Ciseaux</label><br>
			<input type="submit" name="jouer" value="Jouer">
		</form>
		<a href="podium.php">voir podium</a>
		
		<button><a href="deconnexion.php">Déconnexion</a></p></button>

	<?php } else { ?>
		<form method="post" action="">
			<p>Inscrivez-vous pour jouer :</p>
			<label for="prenom">Prénom :</label>
			<input type="text" name="prenom" id="prenom" required><br>
			<label for="nom">Nom :</label>
			<input type="text" name="nom" id="nom" required><br>
			<input type="submit" name="S'inscrire" value="S'inscrire">
		</form>

		<a href="podium.php">voir podium</a>
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
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['prenom']) && isset($_POST['jouer'])) {
		while ($tabjouerN = mysqli_fetch_assoc($result1)) { ?>
			<h1>cest une <?php echo $tabjouerN['resultat']; ?></h1>
	<?php }
	} else {
		echo "";
	}; ?>







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
		<?php while ($recap = mysqli_fetch_assoc($winner)) { ?>
			<tr>
				<td><?php echo $recap['prenom']; ?></td>
				<td><?php echo $recap['nom']; ?></td>
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
		<?php while ($row = mysqli_fetch_assoc($result)) { ?>
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


<?php

class GameAPI {
    private $db; // database connection object
    
    public function __construct($db_config) {
        // establish database connection
        $this->db = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);
    }
    
    public function addComment($comment) {
        // insert new comment into database
        $stmt = $this->db->prepare("INSERT INTO comments (comment) VALUES (:comment)");
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function getComments() {
        // retrieve all comments from database
        $stmt = $this->db->query("SELECT * FROM comments ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // add more methods as needed
}





// include the GameAPI class file


// create a new GameAPI instance with the database configuration
$gameAPI = new GameAPI([
    'host' => '192.168.65.60',
    'dbname' => 'JEUX',
    'username' => 'test',
    'password' => 'test'
]);

// check if the user has submitted a comment
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['comment'])) {
    // sanitize the comment text
    $comment = filter_var($_GET['comment'], FILTER_SANITIZE_STRING);
    
    // add the comment to the database
    $gameAPI->addComment($comment);
    
    
  
}

// get all comments from the database
$comments = $gameAPI->getComments();

// output the comments as an HTML list
echo '<ul>';
foreach ($comments as $comment) {
    echo '<li>' . htmlspecialchars($comment['comment']) . '</li>';
}
echo '</ul>';

// output the comment form
echo '<form method="GET">';
echo '<label for="comment">Leave a comment:</label>';
echo '<textarea name="comment" id="comment"></textarea>';
echo '<button type="submit">Submit</button>';
echo '</form>';




?>

<form style="margin-top: 20px;" class="comment-form" method="GET">
    <div class="form-group">
        <label for="comment">Leave a comment:</label>
        <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="Type your comment here..."></textarea>
    </div>
    <button sqtyle="padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;" class="btn btn-primary" type="submit">Submit</button>
</form>

































</body>

</html>