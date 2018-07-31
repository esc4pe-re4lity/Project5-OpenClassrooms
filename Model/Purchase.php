<?php


require_once 'User.php';
require_once 'Basket.php';


class Purchase {
  protected $idPurchase,
            $idUser,
            $state,
            $creationDate,
            $stripeToken,
            $billingAddress,
            $shippingAddress,
            $shippingMethod,
            $shippingPrice,
            $subtotal,
            $totalPrice,
            $totalItems;
    
  const PURCHASE_PENDING = 1, // in process = en cours de traitement
        PURCHASE_DELIVERING = 2, // being sent = en cours de livraison
        PURCHASE_PASSED = 3, // delivered - passed = expédiée
        PURCHASE_CANCELED = 4; // canceled = supprimée

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
    
    public function getIdPurchase() {
        return $this->idPurchase;
    }
    
    public function getIdUser() {
        return $this->idUser;
    }

    public function getState() {
        switch ($this->state){
            case '1': return 'pending';
                break;
            case '2': return 'delivering';
                break;
            case '3': return 'passed';
                break;
            case '4': return 'canceled';
                break;
            default : return $this->state;
        }
    }

    public function getCreationDate() {
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::NONE, 'Europe/Paris', IntlDateFormatter::GREGORIAN);
        $formattedDate = new DateTime($this->creationDate);
        $creationDate = $formatter->format($formattedDate);
        return $creationDate;
    }

    public function getStripeToken() {
        return $this->stripeToken;
    }

    public function getBillingAddress() {
        return $this->billingAddress;
    }

    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    public function getShippingMethod() {
        return $this->shippingMethod;
    }

    public function getShippingPrice() {
        return $this->shippingPrice;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function getTotalItems() {
        return $this->totalItems;
    }

    public function setIdPurchase($idPurchase) {
        $this->idPurchase = (int) $idPurchase;
    }

    public function setIdUser($idUser) {
        $this->idUser = (int) $idUser;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setStripeToken($stripeToken) {
        $this->stripeToken = $stripeToken;
    }

    public function setBillingAddress($billingAddress) {
        $this->billingAddress = (int) $billingAddress;
    }

    public function setShippingAddress($shippingAddress) {
        $this->shippingAddress = (int) $shippingAddress;
    }

    public function setShippingMethod($shippingMethod) {
        $this->shippingMethod = (int) $shippingMethod;
    }

    public function setShippingPrice($shippingPrice) {
        $this->shippingPrice = (float) $shippingPrice;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = (float) $subtotal;
    }

    public function setTotalPrice($totalPrice) {
        $this->totalPrice = (float) $totalPrice;
    }

    public function setTotalItems($totalItems) {
        $this->totalItems = (int) $totalItems;
    }


}
?>
