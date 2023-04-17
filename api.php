<?php
include 'GameAPI.php';



$connn = mysqli_connect('192.168.65.60', 'test', 'test', 'JEUX');
$requeteidcomment = "SELECT id_joueur, nom FROM joueurs ORDER BY id_joueur DESC LIMIT 1;";
$idcomment = mysqli_query($connn, $requeteidcomment);
while ($iduser = mysqli_fetch_assoc($idcomment)) {
    $saved_id_joueur = $iduser['id_joueur'];
}






// include the GameAPI class file


// create a new GameAPI instance with the database configuration
$gameAPI = new GameAPI([
    'host' => '192.168.65.60',
    'dbname' => 'JEUX',
    'username' => 'test',
    'password' => 'test'

], $saved_id_joueur);

// check if the user has submitted a comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_POST['comment-submit'])) {
    // sanitize the comment text
    $comment = $_POST['comment'];

    // add the comment to the database
    $gameAPI->addComment($comment);


    exit;
}

// get all comments from the database
$comments = $gameAPI->getComments();


// Loop through each person and add their details to a new array
$comments_details = array();
foreach ($comments as $comment) {
    $details = array(
        'prenom' => $comment['prenom'],
        'nom' => $comment['nom'], 
        'comment' => $comment['comment']
    );
    $comments_details[] = $details;
}

// Encode the new array as JSON
$json = json_encode($comments_details, JSON_UNESCAPED_UNICODE);

// Output the JSON
echo $json;
?>


