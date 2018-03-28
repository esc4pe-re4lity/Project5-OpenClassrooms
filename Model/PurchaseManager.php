<?php


require_once 'Purchase.php';
require_once 'Manager.php';


class PurchaseManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(Purchase $purchase) {
        
    }

    public function get($id) {
        
    }

    public function update(Purchase $purchase) {
        
    }

    public function delete($id) {
        
    }


}
?>
