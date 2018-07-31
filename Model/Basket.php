<?php


require_once 'User.php';
require_once 'Item.php';


class Basket {
  protected $idBasket,
            $idUser,
            $totalItemsBasket,
            $totalPriceBasket;

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
  
    public function getIdBasket() {
        return $this->idBasket;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function getTotalItemsBasket() {
        return $this->totalItemsBasket;
    }

    public function getTotalPriceBasket() {
        return $this->totalPriceBasket;
    }

    public function setId($idBasket) {
        $this->idBasket = (int)$idBasket;
    }

    public function setUser($idUser) {
        $this->idUser = (int)$idUser;
    }

    public function setTotalItemsBasket($totalItemsBasket) {
        $this->totalItemsBasket = (int)$totalItemsBasket;
    }

    public function setTotalPriceBasket($totalPriceBasket) {
        $this->totalPriceBasket = (int)$totalPriceBasket;
    }


}
?>
