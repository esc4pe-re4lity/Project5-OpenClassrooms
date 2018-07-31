<?php


require_once 'Wishlist.php';
require_once 'Item.php';


class WishlistItem {
  protected $idWishlistItem,
            $idWishlist,
            $idItem;

    public function __construct($data = []) {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate($data) {
        foreach ($data as $attr => $value) {
            $method = 'set' . ucfirst($attr);
            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
    
    public function getIdWishlistItem() {
        return $this->idWishlistItem;
    }

    public function getIdWishlist() {
        return $this->idWishlist;
    }

    public function getIdItem() {
        return $this->idItem;
    }

    public function setIdWishlistItem($idWishlistItem) {
        $this->idWishlistItem = (int) $idWishlistItem;
    }

    public function setIdWishlist($idWishlist) {
        $this->idWishlist = (int) $idWishlist;
    }

    public function setIdItem($idItem) {
        $this->idItem = (int) $idItem;
    }


}
?>
