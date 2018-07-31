<?php


require_once 'BasketItem.php';
require_once 'WishlistItem.php';


class Item {
  protected $idItem,
            $idInstagramPost,
            $nameItem,
            $descriptionItem,
            $creationDateItem,
            $srcThumbResolutionItem,
            $srcLowResolutionItem,
            $srcStandardResolutionItem,
            $priceItem,
            $remainingItem;

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
    public function getIdItem() {
        return $this->idItem;
    }

    public function getIdInstagramPost() {
        return $this->idInstagramPost;
    }

    public function getNameItem() {
        return $this->nameItem;
    }

    public function getDescriptionItem() {
        return $this->descriptionItem;
    }

    public function getCreationDateItem() {
        return $this->creationDateItem;
    }

    public function getFormattedCreationDateItem() {
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN);
        $imageDate = new DateTime();
        $imageDate->setTimestamp($this->creationDateItem);
        $creationDateItem = $formatter->format($imageDate);
        return $creationDateItem;
    }

    public function getSrcThumbResolutionItem() {
        return $this->srcThumbResolutionItem;
    }

    public function getSrcLowResolutionItem() {
        return $this->srcLowResolutionItem;
    }

    public function getSrcStandardResolutionItem() {
        return $this->srcStandardResolutionItem;
    }

    public function getPriceItem() {
        return $this->priceItem;
    }

    public function getRemainingItem() {
        return $this->remainingItem;
    }

    public function setIdItem($idItem) {
        $this->idItem = (int) $idItem;
    }

    public function setIdInstagramPost($idInstagramPost) {
        $this->idInstagramPost = $idInstagramPost;
    }

    public function setNameItem($nameItem) {
        $this->nameItem = $nameItem;
    }

    public function setDescriptionItem($descriptionItem) {
        $this->descriptionItem = $descriptionItem;
    }

    public function setCreationDateItem($creationDateItem) {
        $this->creationDateItem = $creationDateItem;
    }

    public function setSrcThumbResolutionItem($srcThumbResolutionItem) {
        $this->srcThumbResolutionItem = $srcThumbResolutionItem;
    }

    public function setSrcLowResolutionItem($srcLowResolutionItem) {
        $this->srcLowResolutionItem = $srcLowResolutionItem;
    }

    public function setSrcStandardResolutionItem($srcStandardResolutionItem) {
        $this->srcStandardResolutionItem = $srcStandardResolutionItem;
    }

    public function setPriceItem($priceItem) {
        $this->priceItem = (int) $priceItem;
    }

    public function setRemainingItem($remainingItem) {
        $this->remainingItem = (int) $remainingItem;
    }


}
?>
