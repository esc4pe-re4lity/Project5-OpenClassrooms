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
require(MODEL.'/User.php');
require(MODEL.'/UserManager.php');

class Controller {
    public function addUser($data){
        $user = new User($data);
        $userManager = new UserManager();
        $userManager->add($user);
        return $user;
    }
}
