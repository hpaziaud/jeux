<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['prenom'])) {
	$prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
	$coup_joueur = $_POST['coup'];
	
	// Connexion à la base de données
	$conn = mysqli_connect('192.168.65.60', 'test', 'test', 'JEUX');
    echo"conecter a la base de donner";
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
       
        // Génération d'un coup aléatoire pour l'ordinateur
        $coups_possibles = array('pierre', 'papier', 'ciseaux');
        $coup_ordi = $coups_possibles[array_rand($coups_possibles)];
        
        // Détermination du gagnant
        if($coup_joueur == $coup_ordi) {
            $resultat = 'égalité';
        } else if(($coup_joueur == 'pierre' && $coup_ordi == 'ciseaux') || ($coup_joueur == 'papier' && $coup_ordi == 'pierre') || ($coup_joueur == 'ciseaux' && $coup_ordi == 'papier')) {
            $resultat = 'victoire';
        } else {
            $resultat = 'défaite';
        }
       
        // Insertion du résultat dans la table "matchs"
        $sql = "INSERT INTO matchs (id_joueur, choix_joueur, choix_ordi, resultat) SELECT id_joueur, '$coup_joueur', '$coup_ordi', '$resultat' FROM joueurs WHERE prenom = '$prenom' AND nom = '$nom';" ;
       
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        header('Location: index.php');
        exit;
    }
   echo"fin";
    ?>

   


  
  
  
  
