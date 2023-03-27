<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
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
	$sql = "INSERT INTO joueurs (prenom, nom) VALUES ('$prenom', '$nom')";
	if (mysqli_query($conn, $sql)) {
		header('Location: index.php');
		exit;
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
?>
