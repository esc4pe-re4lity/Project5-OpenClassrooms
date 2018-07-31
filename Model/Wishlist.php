<?php


require_once 'User.php';
require_once 'Item.php';


class Wishlist {
  protected $idWishlist,
            $idUser,
            $totalItemsWishlist;

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

    public function getIdWishlist() {
        return $this->idWishlist;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getTotalItemsWishlist() {
        return $this->totalItemsWishlist;
    }

    public function setIdWishlist($idWishlist) {
        $this->idWishlist = (int) $idWishlist;
    }

    public function setIdUser($idUser) {
        $this->idUser = (int) $idUser;
    }

    public function setTotalItemsWishlist($totalItemsWishlist) {
        $this->totalItemsWishlist = (int) $totalItemsWishlist;
    }




}
?>
