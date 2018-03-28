<?php


require_once 'Basket.php';
require_once 'Item.php';


class BasketItem {
  protected $id,
            $basket,
            $item,
            $itemQuantity,
            $itemPrice;
  

    public function getId() {
        return $this->id;
    }

    public function getBasket() {
        return $this->basket;
    }

    public function getItem() {
        return $this->item;
    }

    public function getItemQuantity() {
        return $this->itemQuantity;
    }

    public function getItemPrice() {
        return $this->itemPrice;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function setBasket($basket) {
        $this->basket = (int)$basket;
    }

    public function setItem($item) {
        $this->item = (int)$item;
    }

    public function setItemQuantity($itemQuantity) {
        $this->itemQuantity = (int)$itemQuantity;
    }

    public function setItemPrice($itemPrice) {
        $this->itemPrice = (int)$itemPrice;
    }


}
?>
