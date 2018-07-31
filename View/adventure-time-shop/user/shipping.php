<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Shipping" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-shipping">
    <div class="shipping-container">
        <div class="shipping-header">
            <h3>Checkout : Shipping (Step 2)</h3>
        </div>
        <div class="shipping-content">
            <h4>Where would you like your merchandise to be shipped ?</h4>
            <?php
            if(empty($res)){
            ?>
            <div>
                <p>
                    You don't have any address registered yet. Please enter a new address using the form below :
                </p>
                <form action="index.php?redirect=ATshop&amp;action=addAddress&amp;shipping=1" method="post" id="addAddressForm" class="shipping-form">
                    <p>
                        <label for="nameAddress">Name of the address</label>
                        <br/>
                        <input type="text" name="nameAddress" id="nameAddress" required/>
                    </p>
                    <p>
                        <label for="fullName">Full Name</label>
                        <br/>
                        <input type="text" name="fullName" id="fullName" required/>
                    </p>
                    <p>
                        <label for="line1">Address (line 1)</label>
                        <br/>
                        <input type="text" name="line1" id="line1" required/>
                    </p>
                    <p>
                        <label for="line2">Address (line 2)</label>
                        <br/>
                        <input type="text" name="line2" id="line2"/>
                    </p>
                    <p>
                        <label for="postcode">Postcode</label>
                        <br/>
                        <input type="text" name="postcode" id="postcode" required/>
                    </p>
                    <p>
                        <label for="city">City</label>
                        <br/>
                        <input type="text" name="city" id="city" required/>
                    </p>
                    <p>
                        <label for="country">Country</label>
                        <br/>
                        <select name="country">
                            <option value="fr">France</option>
                            <option value="be">Belgium</option>
                            <option value="it">Italy</option>
                            <option value="es">Spain</option>
                            <option value="en">United Kingdom</option>
                        </select>
                    </p>
                    <p>
                        <span class="info-form"></span>
                    </p>
                    <button class="button-save-form">Save</button>
                </form>
            </div>
            <?php
            } else {
            ?>
            <div class="address-container">
                <div class="shipping-address-container" style="display: none">
                    <div class="address-header">
                            <h4>Shipping address</h4>
                        </div>
                        <div class="address-content">
                            <h5>
                                <span class="shipping-address-nameAddress"></span>
                            </h5>
                            <p>
                                <span class="shipping-address-fullName"></span>
                                <span class="shipping-address-line1"></span>
                                <span class="shipping-address-line2"></span>
                                <span class="shipping-address-postcode"></span>
                                <span class="shipping-address-city"></span>
                                <span class="shipping-address-country"></span>
                            </p>
                        </div>
                </div>
                <div class="billing-address-container" style="display: none">
                    <div class="address-header">
                            <h4>Billing address</h4>
                        </div>
                        <div class="address-content">
                            <h5>
                                <span class="billing-address-nameAddress"></span>
                            </h5>
                            <p>
                                <span class="billing-address-fullName"></span>
                                <span class="billing-address-line1"></span>
                                <span class="billing-address-line2"></span>
                                <span class="billing-address-postcode"></span>
                                <span class="billing-address-city"></span>
                                <span class="billing-address-country"></span>
                            </p>
                        </div>
                </div>
            </div>
            <div class="basket-shipping-details">
                <i class="fas fa-truck"></i>
                <p>Free Standard Delivery on European orders over 50€</p>
            </div>
            <div class="basket-shipping-options">
                <form action="index.php?redirect=ATshop&amp;action=shipping" method="post" id="shipping-options">
                    <p>
                        <label for="shippingAddress">Select your shipping address</label>
                        <select name="shippingAddress" id="shippingAddress">
                            <option disabled selected value> -- select an option -- </option>
                            <?php
                            for($i=0;$i<count($res);$i++){
                            ?>
                            <option value="<?= $res[$i]->getIdAddress() ?>" data-array-id="<?= $i ?>"><?= $res[$i]->getNameAddress() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label for="billingAddress">Select your billing address</label>
                        <select name="billingAddress" id="billingAddress">
                            <option disabled selected value> -- select an option -- </option>
                            <?php
                            for($i=0;$i<count($res);$i++){
                            ?>
                            <option value="<?= $res[$i]->getIdAddress() ?>" data-array-id="<?= $i ?>"><?= $res[$i]->getNameAddress() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label for="shippingMethod">Delivery</label>
                        <select name="shippingMethod" id="shippingMethod">
                            <option disabled selected value> -- select an option -- </option>
                            <option value="1">Standard Delivery</option>
                            <option value="2">Track Delivery</option>
                            <option value="3">Express Delivery</option>
                        </select>
                    </p>
                    <button class="button-payment">Payment</button>
                    <div class="basket-total-shipping">
                        <div class="total-left">
                            <p>Subtotal</p>
                            <p>Shipping</p>
                            <p>Total</p>
                        </div>
                        <div class="total-right">
                            <p><span class="subtotal-price"><?= $_SESSION['basket']['totalPrice'] ?></span>€</p>
                            <p><span class="shipping-price">0</span>€</p>
                            <p><span class="total-price"><?= $_SESSION['basket']['totalPrice'] ?></span>€</p>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script src="public/js/ATshop/shipping.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
