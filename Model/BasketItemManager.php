<?php

require_once 'BasketItem.php';
require_once 'Basket.php';
require_once 'Item.php';
require_once 'Manager.php';

class BasketItemManager extends Manager {

    public function add(BasketItem $basketItem) {
        $req = $this->db->prepare('INSERT INTO basket_item(idBasket, idItem, quantityItem, priceItem)'.''
                . 'VALUES(:idBasket, :idItem, :quantityItem, :priceItem)');
        $req->execute([
            'idBasket' => $basketItem->getIdBasket(),
            'idItem' => $basketItem->getIdItem(),
            'quantityItem' => $basketItem->getQuantityItem(),
            'priceItem' => $basketItem->getPriceItem()
        ]);
    }

    public function get(Basket $basket) {
        $req = $this->db->prepare('SELECT * FROM basket_item WHERE idBasket=:idBasket');
        $req->execute(['idBasket' => $basket->getIdBasket()]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'BasketItem');
        $basketItem = $req->fetchAll();
        return $basketItem;
    }

    public function update(BasketItem $basketItem) {
        
    }

    public function delete(Basket $basket) {
        $req=$this->db->prepare('DELETE FROM basket_item WHERE idBasket=:idBasket');
        $req->execute(['idBasket' => $basket->getIdBasket()]);
    }

}

?>
