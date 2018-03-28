<?php


require_once 'BasketItem.php';
require_once 'WishlistItem.php';


class Item {
  public static $CATEGORY_HAT = 1;

  public static $CATEGORY_SHIRT = 2;

  public static $CATEGORY_PLUSH = 3;

  protected $id,
            $name,
            $picture,
            $description,
            $availableQuantity,
            $available,
            $category;


    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPicture() {
        return $this->picture;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAvailableQuantity() {
        return $this->availableQuantity;
    }

    public function getAvailable() {
        return $this->available;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPicture($picture) {
        $this->picture = $picture;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAvailableQuantity($availableQuantity) {
        $this->availableQuantity = (int)$availableQuantity;
    }

    public function setAvailable($available) {
        $this->available = (int)$available;
    }

    public function setCategory($category) {
        $this->category = $category;
    }


}
?>
