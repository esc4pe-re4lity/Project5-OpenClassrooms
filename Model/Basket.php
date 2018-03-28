<?php


require_once 'User.php';
require_once 'Item.php';


class Basket {
  protected $id,
            $user,
            $totalItems,
            $totalPrice;
  
  
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getTotalItems() {
        return $this->totalItems;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
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

    public function setTotalPrice($totalPrice) {
        $this->totalPrice = (int)$totalPrice;
    }


}
?>
