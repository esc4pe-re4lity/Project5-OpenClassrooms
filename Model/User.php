<?php

class User {

    protected $id,
            $pseudo,
            $email,
            $password,
            $isAdmin,
            $creationDate,
            $name,
            $lastname,
            $phoneNumber,
            $address;

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

    public function getId() {
        return $this->id;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password=hash('sha256',$password);
    }

    public function setIsAdmin($isAdmin) {
        if($isAdmin >=0 && $isAdmin <=1){
            $this->isAdmin=$isAdmin;
        }
    }

    public function setCreationDate($creationDate) {
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::SHORT, 'Europe/Paris', IntlDateFormatter::GREGORIAN);
        $formattedDate = new DateTime($creationDate);
        $this->creationDate = $formatter->format($formattedDate);
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function setAddress($address) {
        $this->address = (int) $address;
    }

}

?>
