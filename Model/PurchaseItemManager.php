<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PurchaseItemManager
 *
 * @author Fiamma
 */
class PurchaseItemManager extends Manager {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function add(PurchaseItem $purchaseItem) {
        
    }

    public function get($id) {
        
    }

    public function update(PurchaseItem $purchaseItem) {
        
    }

    public function delete($id) {
        
    }
}
