<?php


require_once 'User.php';
require_once 'Basket.php';


class Purchase {
  protected $id,
            $state,
            $creationDate,
            $payment,
            $basket;
    
  const PURCHASE_UNPAYED = 1,
        PURCHASE_PAYED = 2,
        PURCHASE_PENDING = 3,
        PURCHASE_SENT = 4,
        PURCHASE_DELIVERING = 5,
        PURCHASE_DELIVERED = 6;
  
    public function getId() {
        return $this->id;
    }

    public function getState() {
        return $this->state;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getPayment() {
        return $this->payment;
    }

    public function getBasket() {
        return $this->basket;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function setState($state) {
        $this->state = (int)$state;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setPayment($payment) {
        $this->payment = $payment;
    }

    public function setBasket($basket) {
        $this->basket = (int)$basket;
    }


}
?>
