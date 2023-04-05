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
    <title>Foodfinda</title>
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

<body>

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
    <!-- header section end -->
    <!-- layout main section start -->
    <div class="container-fluid">
        <div class="layout_main">
            <!-- banner section start -->
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
                <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
        <!-- banner section end -->

        <?php
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
        <!-- blog section start -->
        <div class="blog_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="blog_taital">classement</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog_section_2 layout_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="blog_img"><img src="https://st5.depositphotos.com/72897924/62328/v/450/depositphotos_623280004-stock-illustration-coronavirus-cartoon-style-crown.jpg"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog_taital_main">
                        <h4 style="color: blue; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-shadow: 0.5px 1.5px #ccc; font-size: 70px;"><strong>1ier place</strong></h4>


                            
                            <p class="blog_taital"><?php while ($recap11 = mysqli_fetch_assoc($first)) { ?>
                                    <tr style="color: blue;">
                                        <td class="useful_text"><strong><?php echo $recap11['prenom']; ?> -</strong> </td>
                                        <td><strong><?php echo $recap11['nom']; ?> - </strong></td>
                                        <td><strong><?php echo $recap11['victoire']; ?></strong></td>

                                    </tr>
                                <?php } ?>
                            </p>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog_img"><img src="https://st4.depositphotos.com/8888322/24169/v/450/depositphotos_241697356-stock-illustration-heart-emoticon-wears-crown-cartoon.jpg"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog_taital_main">
                        <h4 style="color: red; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-shadow: 0.5px 1.5px #ccc; font-size: 70px;"><strong>2iem place</strong></h4>
                            <p class="blog_taital"><?php while ($recap1 = mysqli_fetch_assoc($second)) { ?>
                        <tr>
                            <td><strong><?php echo $recap1['prenom']; ?> -</strong> </td>
                            <td><strong><?php echo $recap1['nom']; ?> - </strong></td>
                            <td><strong><?php echo $recap1['victoire']; ?></strong></td>

                        </tr>
                    <?php } ?></p>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog_img"><img src="https://st2.depositphotos.com/1037178/9804/v/450/depositphotos_98049054-stock-illustration-drooling-king-emoji-smiley-emoticon.jpg"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog_taital_main">
                        <h4 style="color:  yellow; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-shadow: 0.5px 1.5px #ccc; font-size: 70px;"><strong>3iem place</strong></h4>
                            <p class="blog_taital"><?php while ($recap111 = mysqli_fetch_assoc($third)) { ?>
                        <tr>
                            <td><strong><?php echo $recap111['prenom']; ?> - </strong></td>
                            <td><strong><?php echo $recap111['nom']; ?> - </strong></td>
                            <td><strong><?php echo $recap111['victoire']; ?></strong></td>


                        </tr>
                    <?php } ?></p>
                            <div class="readmore_btn"><a href="#">Read More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog section end -->
       <?php // Récupération des parties jouées par le joueur
	$sql = "SELECT * FROM matchs, joueurs where matchs.id_joueur = joueurs.id_joueur ORDER BY `matchs`.`date_match` DESC";
	$result = mysqli_query($connn, $sql);
?>
<div class="breakfast_text" style="text-align: center;">
<p class="breakfast_text">Voici le recapitulatife :</p>
<table class="breakfast_text">
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
			<td><?php echo $recap['nom']; ?></td>
			<td><?php echo $recap['victoire']; ?></td>
			<td><?php echo $recap['defait']; ?></td>
			<td><?php echo $recap['egaliter']; ?></td>
			
		</tr></div>
	<?php } ?>
</table>
</div>



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