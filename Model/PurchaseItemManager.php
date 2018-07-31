<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PurchaseItemManager
 *
 * @author Fiamma
 */
class PurchaseItemManager extends Manager {

    public function add(PurchaseItem $purchaseItem) {
        $req = $this->db->prepare('INSERT INTO purchase_item(idPurchase, idItem, quantityItem, priceItem)'.''
                . 'VALUES(:idPurchase, :idItem, :quantityItem, :priceItem)');
        $req->execute([
            'idPurchase' => $purchaseItem->getIdPurchase(),
            'idItem' => $purchaseItem->getIdItem(),
            'quantityItem' => $purchaseItem->getQuantityItem(),
            'priceItem' => $purchaseItem->getPriceItem()
        ]);
        $purchaseItem->hydrate([
            'idPurchaseItem' => $this->db->lastInsertId()
        ]);
    }

    public function get(Purchase $purchase) {
        $req = $this->db->prepare('SELECT * FROM purchase_item WHERE idPurchase=:idPurchase');
        $req->execute(['idPurchase' => $purchase->getIdPurchase()]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'PurchaseItem');
        $res = $req->fetchAll();
        return $res;
        
    }

    public function update(PurchaseItem $purchaseItem) {
        
    }

    public function delete($id) {
        
    }
}
