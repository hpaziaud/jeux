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
?>