<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Fiamma
 */
require(AUTOLOAD);

class Controller {

    public function addUser($data) {
        $user = new User($data);
        $userManager = new UserManager();
        $res=$userManager->isValid($user);
        if($res === true){
            $userManager->add($user);
            return $user;
        }else{
            return $res;
        }
    }

    public function loginUser($data) {
        $user = new User($data);
        $userManager = new UserManager;
        $userManager->login($user);
        return $user;
    }

}
