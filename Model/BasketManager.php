<?php

require_once 'Basket.php';
require_once 'User.php';
require_once 'Manager.php';

class BasketManager extends Manager {

    public function add(User $user) {
        $req = $this->db->prepare('INSERT INTO basket(idUser) VALUES(:idUser)');
        $req->execute(['idUser' => $user->getIdUser()]);
    }

    public function get(User $user) {
        $req = $this->db->prepare('SELECT * FROM basket WHERE idUser=:idUser');
        $req->execute(['idUser' => $user->getIdUser()]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Basket');
        $basket = $req->fetchAll();
        return $basket;
    }

    public function update(Basket $basket) {
        $req = $this->db->prepare('UPDATE basket SET totalItemsBasket=:totalItemsBasket, totalPriceBasket=:totalPriceBasket WHERE idBasket=:idBasket');
        $req->execute([
            'totalItemsBasket' => $basket->getTotalItemsBasket(),
            'totalPriceBasket' => $basket->getTotalPriceBasket(),
            'idBasket' => $basket->getIdBasket()
        ]);
    }

    public function delete($idBasket) {
        
    }

}

?>
