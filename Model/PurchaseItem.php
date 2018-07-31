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

    protected $idPurchaseItem,
            $idPurchase,
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
    
    public function getIdPurchaseItem() {
        return $this->idPurchaseItem;
    }

    public function getIdPurchase() {
        return $this->idPurchase;
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

    public function setIdPurchaseItem($idPurchaseItem) {
        $this->idPurchaseItem = (int) $idPurchaseItem;
    }

    public function setIdPurchase($idPurchase) {
        $this->idPurchase = (int) $idPurchase;
    }

    public function setIdItem($idItem) {
        $this->idItem = (int) $idItem;
    }

    public function setQuantityItem($quantityItem) {
        $this->quantityItem = (int) $quantityItem;
    }

    public function setPriceItem($priceItem) {
        $this->priceItem = (int) $priceItem;
    }

   

}
