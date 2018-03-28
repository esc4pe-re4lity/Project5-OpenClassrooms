<?php

require_once 'Address.php';
require_once 'User.php';
require_once 'Manager.php';

class AddressManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(Address $address) {
        
    }

    public function get($id) {
        
    }

    public function update(Address $address) {
        
    }

    public function delete($id) {
        
    }

}

?>
