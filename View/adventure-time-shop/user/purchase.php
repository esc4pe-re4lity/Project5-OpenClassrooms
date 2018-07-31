<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Purchase" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-purchase">
    <div class="purchase-container">
        <div class="purchase-confirmation-message">
            <h3>Order Summary</h3>
            <?php
            if($purchase->getState() === 'pending'){
            ?>
            <p>
                Your purchase is still pending and hasn't been take care of.
                If you want to contact us to modify your shipping or billing address,
                or to delete your order, it is time to do it !
                Send us an email to contact-us@at-shop.com
            </p>
            <?php
            }
            ?>
            <div class="address-container">
                <div class="shipping-address-container" data-shipping-address-id="<?= $purchase->getShippingAddress() ?>">
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
                <div class="billing-address-container" data-billing-address-id="<?= $purchase->getBillingAddress() ?>">
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
        </div>
        <div class="purchase-summary">
            <div class="purchase-summary-header">
                <h4>Order no. <?= $purchase->getIdPurchase() ?></h4>
            </div>
            <?php
            for ($i=0;$i<count($items);$i++){
            ?>
            <div class="purchase-item">
                <div class="purchase-item-image">
                    <img src="<?= $items[$i]->getSrcThumbResolutionItem() ?>" alt="">
                </div>
                <div class="purchase-item-content">
                    <div class="item-content">
                        <p class="item-name"><?= $items[$i]->getNameItem() ?></p>
                        <p class="item-quantity">
                            X <span><?= $purchaseItems[$i]->getQuantityItem() ?></span>
                            <span>
                                (
                                <span><?= $items[$i]->getPriceItem() ?></span>
                                €)
                            </span>
                        </p>
                        <p class="item-sum-price">
                            <span><?= $items[$i]->getPriceItem() * $purchaseItems[$i]->getQuantityItem() ?></span>€
                        </p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="purchase-total">
                <div class="total-left">
                    <p>Subtotal</p>
                    <p>Shipping</p>
                    <p>Total</p>
                </div>
                <div class="total-right">
                    <p class="subtotal-price"><?= $purchase->getSubtotal() ?>€</p>
                    <p class="shipping-price"><?= $purchase->getShippingPrice() ?>€</p>
                    <p class="total-price"><?= $purchase->getTotalPrice() ?>€</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script src="public/js/ATshop/purchase.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
