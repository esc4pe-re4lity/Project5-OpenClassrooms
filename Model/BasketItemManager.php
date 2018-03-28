<?php


require_once 'BasketItem.php';
require_once 'Basket.php';
require_once 'Item.php';
require_once 'Manager.php';


class BasketItemManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(BasketItem $basketItem) {
        
    }

    public function get($id) {
        
    }

    public function update(BasketItem $basketItem) {
        
    }

    public function delete($id) {
        
    }


}
?>
