<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Purchase confirmation" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-purchaseConfirmation">
    <div class="purchase-container">
        <div class="purchase-confirmation-message">
            <h3>Your purchase is confirmed</h3>
            <p>
                Thank you so much for your order, <?= $user->getFirstName() ?> !<br>
                You will soon receive an email confirmation at <?= $user->getEmail() ?><br>
                To make sure you haven't made any mistakes, you can have a look on your order<br>
                To find out how fast your order is processed, your can check your profile.
            </p>
            <div class="purchase-confirmed-buttons">
                <a href="index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>">
                    View your order
                </a>
                <a href="index.php?redirect=ATshop&amp;action=getUser">
                    View your profile
                </a>
            </div>
        </div>
        <div class="purchase-summary">
            <div class="purchase-summary-header">
                <h4>Order summary</h4>
                <h5>Order no. <?= $purchase->getIdPurchase() ?></h4>
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
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
