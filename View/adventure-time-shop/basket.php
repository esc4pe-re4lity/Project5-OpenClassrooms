<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Basket" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-basket">
    <div class="basket-container">
        <div class="basket-header">
            <h3>My Basket</h3>
        </div>
        <div class="basket-content">
            <?php
            if(empty($items)){
            ?>
            <div>
                <p>Your basket is empty, <a href="index.php?redirect=ATshop">continue shopping</a></p>
            </div>
            <?php
            } else {
                for ($i = 0; $i < count($items); $i++) {
                    $item = $items[$i][0];
                    $basketItem = $basketItems[$i];
                    ?>
                    <div class="basket-item" data-session-id="<?= $i ?>">
                        <div class="basket-item-header">
                            <h5><?= $item->getNameItem() ?></h5>
                        </div>
                        <div class="basket-item-content">
                            <div class="basket-item-image">
                                <img src="<?= $item->getSrcThumbResolutionItem() ?>" alt="">
                            </div>
                            <div class="basket-item-details">
                                <p>Unit Price: <span class="item-price" data-session-id="<?= $i ?>"><?= $item->getPriceItem() ?></span>€</p>
                                <p data-session-id="<?= $i ?>">
                                    Quantity <span class="quantity-item-text" data-session-id="<?= $i ?>"><?= $basketItem->getQuantityItem() ?></span>
                                </p>
                                <p>Sum: <span class="sum-price" data-session-id="<?= $i ?>"><?= $item->getPriceItem() * $basketItem->getQuantityItem() ?></span>€</p>
                            </div>
                            <div class="basket-item-buttons" data-session-id="<?= $i ?>">
                                <div class="deleteBasketItem" data-session-id="<?= $i ?>">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="basket-button-text">Remove</span>
                                </div>
                                <div class="updateBasketItem" data-session-id="<?= $i ?>">
                                    <i class="fas fa-edit"></i>
                                    <span class="basket-button-text">Update</span>
                                </div>
                                <div class="addToWishlist" data-item-id="<?= $item->getIdItem() ?>">
                                    <i class="fas fa-heart"></i>
                                    <span class="basket-button-text">Add to wishlist</span>
                                </div>
                            </div>
                            <div class="basket-item-save" style="display: none;" data-session-id="<?= $i ?>">
                                <div class="quantity-item-buttons">
                                    <button id="minus-quantity">-</button>
                                    <span class="quantity-item"><?= $basketItem->getQuantityItem() ?></span>
                                    <button id="plus-quantity">+</button>
                                </div>
                                <button class="saveBasketItem" data-session-id="<?= $i ?>">Save</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="basket-total">
            <p>Total:<?= $_SESSION['basket']['totalPrice'] ?>€</p>
            <p class="basket-text">
                You need to login to proceed to checkout<br>
                Please <a href="index.php?redirect=ATshop&amp;action=login">login</a> and your basket will be transfered<br>
                You don't have an account yet ? Please <a href="index.php?redirect=ATshop&amp;action=createAccount">create an account</a> and your basket will be transfered as well
            </p>
        </div>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script src="public/js/ATshop/basket.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
