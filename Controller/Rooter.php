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

        if (isset($_GET['redirect'])) {
            if ($_GET['redirect'] === 'ATshop') {
                if (isset($_GET['action'])) {
                    if ($_GET['action'] === 'addItem') {
                        $controller->addItem();
                    } elseif ($_GET['action'] === 'getItem') {
                        $controller->getItem();
                    } elseif ($_GET['action'] === 'getInstagramPost') {
                        $controller->getInstagramPost();
                    } elseif ($_GET['action'] === 'updateItem') {
                        $controller->updateItem();
                    } elseif ($_GET['action'] === 'deleteItem') {
                        $controller->deleteItem();
                    } elseif ($_GET['action'] === 'createAccount') {
                        $controller->addUser();
                    } elseif ($_GET['action'] === 'login') {
                        $controller->loginUser();
                    } elseif ($_GET['action'] === 'logout') {
                        $controller->logoutUser();
                    } elseif ($_GET['action'] === 'getUser') {
                        $controller->getUser();
                    }  elseif ($_GET['action'] === 'updateUser') {
                        $controller->updateUser();
                    } elseif ($_GET['action'] === 'updatePassword') {
                        $controller->updatePassword();
                    } elseif($_GET['action'] === 'getBasket') {
                        $controller->getBasket();
                    } elseif ($_GET['action'] === 'addToBasket') {
                        $controller->addToBasket();
                    } elseif ($_GET['action'] === 'saveBasketItem') {
                        $controller->saveBasketItem();
                    } elseif ($_GET['action'] === 'deleteBasketItem') {
                        $controller->deleteBasketItem();
                    } elseif($_GET['action'] === 'getWishlist') {
                        $controller->getWishlist();
                    } elseif ($_GET['action'] === 'addToWishlist') {
                        $controller->addToWishlist();
                    } elseif ($_GET['action'] === 'deleteWishlistItem') {
                        $controller->deleteWishlistItem();
                    } elseif ($_GET['action'] === 'getAddress') {
                        $controller->getAddress();
                    } elseif ($_GET['action'] === 'addAddress') {
                        $controller->addAddress();
                    } elseif ($_GET['action'] === 'updateAddress'){
                        $controller->updateAddress();
                    } elseif ($_GET['action'] === 'deleteAddress'){
                        $controller->deleteAddress();
                    } elseif ($_GET['action'] === 'getAllPurchase') {
                        $controller->getAllPurchase();
                    } elseif ($_GET['action'] === 'getPurchase') {
                        $controller->getPurchase();
                    } elseif ($_GET['action'] === 'updatePurchase') {
                        $controller->updatePurchase();
                    } elseif ($_GET['action'] === 'shipping') {
                        $controller->shipping();
                    } elseif($_GET['action'] === 'payment'){
                        $controller->payment();
                    } elseif($_GET['action'] === 'confirmationPayment'){
                        $controller->confirmationPayment();
                    } elseif($_GET['action'] === 'isEmailValid'){
                        $controller->isEmailValid();
                    } else {
                        $controller->getError();
                    }
                } else {
                    $controller->getHome();
                }
            }
        } else {
            require (VIEW . '/home/home.php');
        }
    }

}
