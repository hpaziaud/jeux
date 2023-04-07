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

//deconnection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["deco"])) {
    session_start();
    session_unset();
    session_destroy();
} else {
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>pierre pappier cisseaux</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
   <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body background="images/body-bg.png">
    <!-- header section start -->
    <div class="container-fluid">
        <div class="header_section">
            <div class="container">
                <nav class="navbar navbar-light bg-light justify-content-between">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="edit.php">play</a>
                        <a href="podium.php">podium</a>
                        <a href="deconnexion copy.php">deconnexion</a>


                    </div>
                    <form class="form-inline ">
                        <div class="login_text"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left10">Call admin : +33 0771755876</span></a></div>
                    </form>
                    <a class="logo" href="edit.php"><img src="images/logo.png"></a></a>
                    <span class="toggle" onclick="openNav()"><i class="fa fa-bars"></i></span>
                    <div class="login_text"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left10">Email admin: paziaud-moutima@gmail.com</span></a></div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <!-- header section end -->
    <!-- layout main section start -->
    <div class="container-fluid">
        <div class="layout_main">
            <!-- banner section start -->
            <div class="banner_section">
                <div class="banner_section">
                    <div class="container">
                        <div class="menu_main">
                            <div class="custome_menu">
                                <ul>
                                    <li class="active"><a href="edit.php">play</a></li>




                                </ul>
                            </div>
                            <div class="login_menu">
                                <ul>
                                    <li><a href="podium copy.php">podium</a></li>
                                    <li><a href="deconnexion copy.php">Déconnexion</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['prenom'])) { ?>
                        <div id="main_slider" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h1 class="banner_taital">peirre papier cissaux </h1>
                                                <h1 class="banner_text">play</h1>
                                                <form class="service_taital" method="post" action="">
                                                    <p>Choisissez votre coup :</p>
                                                    <input type="radio" name="coup" value="pierre" id="pierre" required><label for="pierre">Pierre</label><br>
                                                    <input type="radio" name="coup" value="papier" id="papier"><label for="papier">Papier</label><br>
                                                    <input type="radio" name="coup" value="ciseaux" id="ciseaux"><label for="ciseaux">Ciseaux</label><br>


                                                    <div class="banner_text"><input type="submit" name="jouer" value="Jouer"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>

                                <div id="main_slider" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="banner_taital">peirre papier cissaux </h1>
                                                        <h1 class="banner_text">
                                                            Inscrivez-vous pour jouer :
                                                        </h1>


                                                        <form class="service_taital" method="post" action="">

                                                            <label for="prenom" style="color:green;">Prénom :</label>
                                                            <input type="text" style="border: 2px solid #ccc; background-color: #fff; padding: 10px; border-radius: 5px; font-size: 16px; color: #333; width: 300px;" name="prenom" id="prenom" required><br>
                                                            <label for="nom" style="color:green;">Nom :</label>
                                                            <input type="text" style="border: 2px solid #ccc; background-color: #fff; padding: 10px; border-radius: 5px; font-size: 16px; color: #333; width: 300px;" name="nom" id="nom" required><br>



                                                            <div><input type="submit" style="border: 2px solid #ccc; background-color: #fff; padding: 10px; border-radius: 5px; font-size: 16px; color: #333; cursor: pointer;" name="S'inscrire" value="S'inscrire"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
GROUP BY joueurs.id_joueur, joueurs.nom, joueurs.prenom ORDER BY `victoire` DESC LIMIT 1;";
                                    $first = mysqli_query($connn, $requete8);

                                    $requete9 = "SELECT joueurs.nom, joueurs.prenom, 
COUNT(CASE WHEN matchs.resultat = 'victoire' THEN 1 END) AS victoire,
COUNT(CASE WHEN matchs.resultat = 'défaite' THEN 1 END) AS defait,
COUNT(CASE WHEN matchs.resultat = 'égalité' THEN 1 END) AS egaliter
FROM matchs 
INNER JOIN joueurs ON matchs.id_joueur = joueurs.id_joueur 
GROUP BY joueurs.id_joueur, joueurs.nom, joueurs.prenom ORDER BY `victoire` DESC LIMIT 1, 1;";
                                    $second = mysqli_query($connn, $requete9);

                                    $requete10 = "SELECT joueurs.nom, joueurs.prenom, 
COUNT(CASE WHEN matchs.resultat = 'victoire' THEN 1 END) AS victoire,
COUNT(CASE WHEN matchs.resultat = 'défaite' THEN 1 END) AS defait,
COUNT(CASE WHEN matchs.resultat = 'égalité' THEN 1 END) AS egaliter
FROM matchs 
INNER JOIN joueurs ON matchs.id_joueur = joueurs.id_joueur 
GROUP BY joueurs.id_joueur, joueurs.nom, joueurs.prenom ORDER BY `victoire` DESC LIMIT 2, 1;";
                                    $third = mysqli_query($connn, $requete10);
                                    ?>



                                    <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <!-- banner section end -->
                            <!-- service section start -->
                            <div class="service_section layout_padding">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['prenom']) && isset($_POST['jouer'])) {
                                                while ($tabjouerN = mysqli_fetch_assoc($result1)) { ?>
                                                    <h1 class="service_taital">cest une <?php echo $tabjouerN['resultat']; ?></h1>
                                            <?php }
                                            } else {
                                                echo "";
                                            }; ?>

                                            <hr>
                                            <h1 class="service_taital" style="color:green;">podium</h1>
                                        </div>
                                    </div>


                                    <div class="service_section_2">
                                        <div class="row">

                                            <div class="col">
                                                <div>
                                                    <div class="breakfast_img"> <img src="https://st4.depositphotos.com/8888322/24169/v/450/depositphotos_241697356-stock-illustration-heart-emoticon-wears-crown-cartoon.jpg" style="width:250px;height:240px;"></div>
                                                </div>
                                                <h4 class="breakfast_text">2iem</h4>
                                                <h1 style="color:green;">
                                                    <table>
                                                        <tr>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th></th>


                                                        </tr>
                                                        <?php while ($recap1 = mysqli_fetch_assoc($second)) { ?>
                                                            <tr>
                                                                <td><strong><?php echo $recap1['prenom']; ?> - </strong></td>
                                                                <td><strong><?php echo $recap1['nom']; ?> - </strong></td>
                                                                <td><strong><?php echo $recap1['victoire']; ?></strong></td>


                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </h1>
                                                <div class="seemore_bt"><a href="podium copy.php">See in podium</a></div>
                                            </div>

                                            <div class="col">
                                                <div>
                                                    <div class="breakfast_img"><img src="https://st5.depositphotos.com/72897924/62328/v/450/depositphotos_623280004-stock-illustration-coronavirus-cartoon-style-crown.jpg" style="width:250px;height:240px;"></div>
                                                </div>
                                                <h4 class="breakfast_text">1ier</h4>
                                                <h1 style="color:green;">
                                                    <table>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>


                                                        </tr>
                                                        <?php while ($recap11 = mysqli_fetch_assoc($first)) { ?>
                                                            <tr>
                                                                <td><strong><?php echo $recap11['prenom']; ?> -</strong> </td>
                                                                <td><strong><?php echo $recap11['nom']; ?> - </strong></td>
                                                                <td><strong><?php echo $recap11['victoire']; ?></strong></td>

                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </h1>
                                                <div class="seemore_bt"><a href="podium copy.php">See in podium</a></div>
                                            </div>

                                            <div class="col">
                                                <div>
                                                    <div class="breakfast_img"><img src="https://st2.depositphotos.com/1037178/9804/v/450/depositphotos_98049054-stock-illustration-drooling-king-emoji-smiley-emoticon.jpg" style="width:250px;height:240px;"></div>
                                                </div>
                                                <h4 class="breakfast_text">3iem</h4>
                                                <h1 style="color:green;">
                                                    <table>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>


                                                        </tr>
                                                        <?php while ($recap111 = mysqli_fetch_assoc($third)) { ?>
                                                            <tr>
                                                                <td><strong><?php echo $recap111['prenom']; ?> - </strong></td>
                                                                <td><strong><?php echo $recap111['nom']; ?> - </strong></td>
                                                                <td><strong><?php echo $recap111['victoire']; ?></strong></td>


                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </h1>
                                                <div class="seemore_bt"><a href="podium copy.php">See in podium</a></div>
                                            </div>



                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
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

                        <div class="breakfast_text" style="text-align: center;">

                            <p class="breakfast_text">Voici le list gagnant :</p>
                            <table style="text-align: center;">
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
                        </div>
                </div>
                        <!-- service section end -->
                        <!-- footer section start -->
                        <div class="footer_section">
                            <div class="container">
                                <div class="footer_sectio_2">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <h2 class="footer_logo">pierre papier siceaux</h2>
                                            <p class="footer_text">ce jeux fait partie du classement mondial top 10 millions</p>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <h2 class="useful_text">Navigation</h2>
                                            <div class="footer_menu">
                                                <ul>
                                                    <li class="active"><a href="edit.php">play</a></li>
                                                    <li><a href="podium copy.php">podium</a></li>
                                                    <li><a href="deconnexion copy.php">deconnexion</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <h2 class="useful_text">Contact Info</h2>
                                            <div class="map_icon"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left15">( +33 0771755876 )</span></a></div>
                                            <div class="map_icon"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left15">paziaud-moutima@gmail.com</span></a></div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <h2 class="useful_text">Discover</h2>

                                            <div class="social_icon">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- footer section end -->
                </div>
            </div>
        </div>
        <!-- layout main section end -->
        <!-- copyright section start -->
        <div class="copyright_section">
            <div class="container">
                <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">moutima-paziaud enterprise</a></p>
            </div>
        </div>
        <!-- copyright section end -->
        <!-- Javascript files-->
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.0.0.min.js"></script>
        <script src="js/plugin.js"></script>
        <!-- sidebar -->
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/custom.js"></script>
        <!-- javascript -->
        <script src="js/owl.carousel.js"></script>
        <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
</body>

</html>