<?php


require_once 'User.php';
require_once 'Item.php';


class Wishlist {
  protected $id,
            $user,
            $totalItems;

  
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getTotalItems() {
        return $this->totalItems;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function setUser($user) {
        $this->user = (int)$user;
    }

    public function setTotalItems($totalItems) {
        $this->totalItems = (int)$totalItems;
    }


}
?>
