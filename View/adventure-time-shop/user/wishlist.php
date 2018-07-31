<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php $title = "AT Shop - Wishlist" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-wishlist">
    <div class="wishlist-container">
        <div class="wishlist-header">
            <h3>My Wishlist</h3>
        </div>
        <div class="wishlist-content">
            <?php
            if(empty($items)){
            ?>
            <div>
                <p>Your wishlist is empty, <a href="index.php?redirect=ATshop">continue shopping</a></p>
            </div>
            <?php
            } else {
                for ($i = 0; $i < count($items); $i++) {
                    $item = $items[$i][0];
                    $wishlistItem = $wishlistItems[$i];
                    ?>
            <div class="wishlist-item" data-session-id="<?= $i ?>">
                <div class="wishlist-item-header">
                    <h5><?= $item->getNameItem() ?></h5>
                </div>
                <div class="wishlist-item-content">
                    <div class="wishlist-item-image">
                        <img src="<?= $item->getSrcThumbResolutionItem() ?>" alt="">
                    </div>
                    <div class="wishlist-item-details">
                        <p>Price: <span class="item-price" data-session-id="<?= $i ?>"><?= $item->getPriceItem() ?></span>€</p>
                    </div>
                    <div class="wishlist-item-buttons">
                        <div class="deleteWishlistItem" data-session-id="<?= $i ?>">
                            <i class="fas fa-trash-alt"></i>
                            <span class="wishlist-button-text">Remove</span>
                        </div>
                        <div class="addToBasket" data-item-id="<?= $item->getIdItem() ?>">
                            <i class="fas fa-shopping-basket"></i>
                            <span class="wishlist-button-text">Add to basket</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script src="public/js/ATshop/wishlist.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
