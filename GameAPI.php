<?php

class GameAPI
{
    private $db; // database connection object
    private $saved_id_joueur;

    public function __construct($db_config, $saved_id_joueur)
    {
        // establish database connection
        $this->db = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);
        $this->saved_id_joueur =  $saved_id_joueur;
    }

    public function addComment($comment)
    {
        // insert new comment into database




        $stmt = $this->db->prepare("INSERT INTO `comments` (`id`, `comment`, `created_at`, `idUserQuiEcrit`) VALUES (NULL, :comment, current_timestamp(), :saved_id_joueur)");
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindValue(':saved_id_joueur', $this->saved_id_joueur, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getComments()
    {
        // retrieve all comments from database
        $stmt = $this->db->query("SELECT * FROM `comments` INNER JOIN `joueurs` ON `comments`.`idUserQuiEcrit` = `joueurs`.`id_joueur` ORDER BY `comments`.`idUserQuiEcrit` ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // add more methods as needed
}
?>