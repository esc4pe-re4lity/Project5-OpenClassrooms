<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('vendor/autoload.php');
$apiKey = require('configStripe.php');

Stripe\Stripe::setApiKey($apiKey['key']);
Stripe\Customer::create([
    'description' => 'customer',
    'source'=>$_POST['stripeToken']
]);
$payment = \Stripe\Charge::create([
    'amount'=> (int)$_SESSION['basket']['totalPrice']*100,
    'currency'=> 'eur',
    'source'=> 'tok_visa'
]);
var_dump($payment->values());