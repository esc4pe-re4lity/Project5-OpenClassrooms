<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PurchaseItem
 *
 * @author Fiamma
 */
class PurchaseItem {

    protected $id,
            $purchase,
            $item,
            $itemQuantity,
            $itemPrice;

    public function getId() {
        return $this->id;
    }

    public function getPurchase() {
        return $this->purchase;
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
        $this->id = (int) $id;
    }

    public function setPurchase($purchase) {
        $this->purchase = (int) $purchase;
    }

    public function setItem($item) {
        $this->item = (int) $item;
    }

    public function setItemQuantity($itemQuantity) {
        $this->itemQuantity = (int) $itemQuantity;
    }

    public function setItemPrice($itemPrice) {
        $this->itemPrice = (int) $itemPrice;
    }

}
