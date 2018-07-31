<?php

require_once 'Item.php';
require_once 'Manager.php';

class ItemManager extends Manager {

    public function isValid(Item $item) {
        $req = $this->db->prepare('SELECT idItem FROM item WHERE idInstagramPost=:idInstagramPost');
        $req->execute([
            'idInstagramPost' => $item->getIdInstagramPost()]);
        if ($req->rowCount() === 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add(Item $item) {
        $req = $this->db->prepare('INSERT INTO item(idInstagramPost, nameItem, descriptionItem,'
                . 'creationDateItem, srcThumbResolutionItem, srcLowResolutionItem, srcStandardResolutionItem, priceItem, remainingItem)'
                . 'VALUES (:idInstagramPost, :nameItem, :descriptionItem, :creationDateItem, :srcThumbResolutionItem,'
                . ':srcLowResolutionItem, :srcStandardResolutionItem, :priceItem, :remainingItem)');
        $req->execute([
            'idInstagramPost' => $item->getIdInstagramPost(),
            'nameItem' => $item->getNameItem(),
            'descriptionItem' => $item->getDescriptionItem(),
            'creationDateItem' => $item->getCreationDateItem(),
            'srcThumbResolutionItem' => $item->getSrcThumbResolutionItem(),
            'srcLowResolutionItem' => $item->getSrcLowResolutionItem(),
            'srcStandardResolutionItem' => $item->getSrcStandardResolutionItem(),
            'priceItem' => $item->getPriceItem(),
            'remainingItem' => $item->getRemainingItem()
        ]);
        $item->hydrate([
            'idItem' => $this->db->lastInsertId(),
            'creationDateItem' => date("Y-m-d H:i:s")
        ]);
    }

    public function getAllItems() {
        $q = $this->db->query('SELECT * FROM item ORDER BY idItem DESC');
        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item');
        $items = $q->fetchAll();
        return $items;
    }

    public function getItem($idItem) {
        $req = $this->db->prepare('SELECT * FROM item WHERE idItem=:idItem');
        $req->execute(['idItem' => $idItem]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item');
        $res = $req->fetchAll();
        return $res;
    }

    public function getItemFromIdInstagramPost($idInstagramPost) {
        $req = $this->db->prepare('SELECT * FROM item WHERE idInstagramPost=:idInstagramPost');
        $req->execute(['idInstagramPost' => $idInstagramPost]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item');
        $res = $req->fetchAll();
        return $res;
    }

    public function update(Item $item) {
        $req = $this->db->prepare('UPDATE item SET nameItem=:nameItem, priceItem=:priceItem, remainingItem=:remainingItem WHERE idItem=:idItem');
        $req->execute([
            'nameItem' => $item->getNameItem(),
            'priceItem' => $item->getPriceItem(),
            'remainingItem' => $item->getRemainingItem(),
            'idItem' => $item->getIdItem()
        ]);
    }

    public function delete($id) {
        $req=$this->db->prepare('DELETE FROM item WHERE idItem=:idItem');
        $req->execute(['idItem' => $id]);
    }

}

?>
