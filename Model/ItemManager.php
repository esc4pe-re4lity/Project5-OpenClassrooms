<?php


require_once 'Item.php';
require_once 'Manager.php';


class ItemManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(Item $item) {
        
    }

    public function get($id) {
        
    }

    public function update(Item $item) {
        
    }

    public function delete($id) {
        
    }


}
?>
