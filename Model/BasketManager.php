<?php


require_once 'Basket.php';
require_once 'User.php';
require_once 'Manager.php';


class BasketManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(Basket $basket) {
        
    }

    public function get($id) {
        
    }

    public function update(Basket $basket) {
        
    }

    public function delete($id) {
        
    }


}
?>
