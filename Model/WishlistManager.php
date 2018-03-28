<?php


require_once 'Wishlist.php';
require_once 'User.php';
require_once 'Manager.php';


class WishlistManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(Wishlist $wishlist) {
        
    }

    public function get($id) {
        
    }

    public function update(Wishlist $wishlist) {
        
    }

    public function delete($id) {
        
    }

}
?>
