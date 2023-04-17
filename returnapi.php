<?php
include


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

                                ?>
                                   <form class="form-comment">
                                    <ul class="comment-list">
                                        <?php foreach ($comments as $comment) : ?>
                                            <li class="comment1">
                                                <div style="color: #8eb50b;"><?= $comment['prenom'] ?> <?= $comment['nom'] ?> : </div><?= $comment['comment'] ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                </form>

                                
