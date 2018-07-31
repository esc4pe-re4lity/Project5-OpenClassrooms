<?php


require_once 'Purchase.php';
require_once 'Manager.php';


class PurchaseManager extends Manager {

    public function add(Purchase $purchase) {
        $req = $this->db->prepare(
                'INSERT INTO purchase(idUser, state, stripeToken, billingAddress, shippingAddress, shippingMethod, shippingPrice, subtotal, totalPrice, totalItems, creationDate)'
                . 'VALUES (:idUser ,:state, :stripeToken, :billingAddress, :shippingAddress, :shippingMethod, :shippingPrice, :subtotal, :totalPrice, :totalItems, NOW())');
        $req->execute([
            'idUser' => $purchase->getIdUser(),
            'state' => $purchase->getState(),
            'stripeToken' => $purchase->getStripeToken(),
            'billingAddress' => $purchase->getBillingAddress(),
            'shippingAddress' => $purchase->getShippingAddress(),
            'shippingMethod' => $purchase->getShippingMethod(),
            'shippingPrice' => $purchase->getShippingPrice(),
            'subtotal' => $purchase->getSubtotal(),
            'totalPrice' => $purchase->getTotalPrice(),
            'totalItems' => $purchase->getTotalItems()
        ]);
        $purchase->hydrate([
            'idPurchase' => $this->db->lastInsertId()
        ]);
    }

    public function get(Purchase $purchase) {
        $req = $this->db->prepare('SELECT * FROM purchase WHERE idPurchase=:idPurchase');
        $req->execute(['idPurchase' => $purchase->getIdPurchase()]);
        $row = $req->fetch();
        $purchase->hydrate($row);
    }

    public function getAllUserPurchase(User $user) {
        $req = $this->db->prepare('SELECT * FROM purchase WHERE idUser=:idUser');
        $req->execute(['idUser' => $user->getIdUser()]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Purchase');
        $res = $req->fetchAll();
        return $res;
    }

    public function getUserPurchase(Purchase $purchase) {
        $req = $this->db->prepare('SELECT * FROM purchase WHERE idPurchase=:idPurchase AND idUser=:idUser');
        $req->execute([
            'idPurchase' => $purchase->getIdPurchase(),
            'idUser' => $purchase->getIdUser()]);
        if ($req->rowCount() === 0) {
            return false;
        } else {
            $row = $req->fetch();
            $purchase->hydrate($row);
            return true;
        }
    }

    public function getAll() {
        $q = $this->db->query('SELECT * FROM purchase');
        $q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Purchase');
        $res = $q->fetchAll();
        return $res;
    }

    public function update(Purchase $purchase) {
        $req = $this->db->prepare('UPDATE purchase SET state=:state WHERE idPurchase=:idPurchase');
        $req->execute([
            'state' => $purchase->getState(),
            'idPurchase' => $purchase->getIdPurchase()
        ]);
        
    }

    public function delete($id) {
    }


}
?>
