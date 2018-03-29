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
            if ($_GET['action'] === 'createAccount') {
                if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
                    if (!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['confirmPassword']))) {
                        $data = [
                            'pseudo' => filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'password' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                        ];
                        $res = $controller->addUser($data);
                        var_dump($res);
                    }else{
                        
                    }
                } else {
                    require(VIEW . '/adventure-time-shop/user/createAccount.php');
                }
            }elseif($_GET['action'] === 'login'){
                if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                    if (!empty(trim($_POST['pseudo'])) && !empty(trim($_POST['password']))) {
                        $data = [
                            'pseudo' => filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'password' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        ];
                        $user = $controller->loginUser($data);
                        var_dump($user);
                    }else{
                        
                    }
                } else {
                    require(VIEW . '/adventure-time-shop/user/login.php');
                }
            }
        } else {
            
        }
    }

}
