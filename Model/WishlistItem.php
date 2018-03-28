<?php


require_once 'Wishlist.php';
require_once 'Item.php';


class WishlistItem {
  protected $id,
            $wishlist,
            $item;

    public function getId() {
        return $this->id;
    }

    public function getWishlist() {
        return $this->wishlist;
    }

    public function getItem() {
        return $this->item;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function setWishlist($wishlist) {
        $this->wishlist = (int)$wishlist;
    }

    public function setItem($item) {
        $this->item = (int)$item;
    }


}
?>
