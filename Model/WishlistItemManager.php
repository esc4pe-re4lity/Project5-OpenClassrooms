<?php


require_once 'WishlistItem.php';
require_once 'Wishlist.php';
require_once 'Item.php';
require_once 'Manager.php';


class WishlistItemManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(WishlistItem $wishlistItem) {
        
    }

    public function get($id) {
        
    }

    public function update(WishlistItem $wishlistItem) {
        
    }

    public function delete($id) {
        
    }

}
?>
