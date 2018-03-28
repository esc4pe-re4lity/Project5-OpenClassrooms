<?php


require_once 'User.php';


class Address {
  protected $id,
            $line1,
            $line2,
            $postcode,
            $city,
            $country,
            $user;

    public function getId() {
        return $this->id;
    }

    public function getLine1() {
        return $this->line1;
    }

    public function getLine2() {
        return $this->line2;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getUser() {
        return $this->user;
    }

    public function setId($id) {
        $this->id = (int)$id;
    }

    public function setLine1($line1) {
        $this->line1 = $line1;
    }

    public function setLine2($line2) {
        $this->line2 = $line2;
    }

    public function setPostcode($postcode) {
        $this->postcode = (int)$postcode;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setUser($user) {
        $this->user = (int)$user;
    }

      
  public function getAddress(): string
  {
  }

}
?>
