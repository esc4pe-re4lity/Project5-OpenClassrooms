<?php

require_once 'Basket.php';
require_once 'Item.php';

class BasketItem {

    protected $idBasketItem,
            $idBasket,
            $idItem,
            $quantityItem,
            $priceItem;

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
    
    public function getIdBasketItem() {
        return $this->idBasketItem;
    }

    public function getIdBasket() {
        return $this->idBasket;
    }

    public function getIdItem() {
        return $this->idItem;
    }

    public function getQuantityItem() {
        return $this->quantityItem;
    }

    public function getPriceItem() {
        return $this->priceItem;
    }

    public function setIdBasketItem($idBasketItem) {
        $this->idBasketItem = (int) $idBasketItem;
    }

    public function setIdBasket($idBasket) {
        $this->idBasket = (int) $idBasket;
    }

    public function setIdItem($idItem) {
        $this->idItem = (int) $idItem;
    }

    public function setQuantityItem($quantityItem) {
        $this->quantityItem = (int) $quantityItem;
    }

    public function setPriceItem($priceItem) {
        $this->priceItem = (float) $priceItem;
    }


}

?>
