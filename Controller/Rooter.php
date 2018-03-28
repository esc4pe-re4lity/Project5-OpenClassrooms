<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rooter
 *
 * @author Fiamma
 */
class Rooter {

    public function __construct() {
        $this->initURL();
    }

    private function initURL() {
        require CONTROLLER;
        $controller = new Controller();

        if (isset($_GET['action'])) {
            
        } else {
            
        }
    }

}
