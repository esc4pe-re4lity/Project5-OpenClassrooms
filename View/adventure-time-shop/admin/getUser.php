<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

-->
<?php $title = "AT Shop - Profile" ?>

<?php 
require('header.php');
?>

<?php ob_start(); ?>
<section class="AT-userProfile">
    <div class="user-profile-left">
        <div class="user-profile-image">
            <img src="Public/images/at-shop/<?= $user->getImage() ?>.png" alt="user profile picture" id="profile-picture">
        </div>
        <div class="user-profile-name">
            <h3><?= ucfirst($user->getFirstName()).' '.ucfirst($user->getLastName()) ?></h3>
            <p>Membre depuis le <?= $user->getCreationDate() ?></p>
        </div>
    </div>
    <div class="user-profile-right">
        <div class="user-details-container">
            <div class="user-profile-header">
                <div class="button-hide-form" id="closeUserForm" style="display: none">
                    <i class="fas fa-window-close"></i>
                </div>
                <button id="updateUserButton" class="button-show-form">Edit</button>
                <h4 class="user-profile-h4">General informations</h4>
            </div>
            <div class="user-details-content">
                <div class="user-details-text">
                    <p>
                        <?= ucfirst($user->getFirstName()) ?>
                        <?= ucfirst($user->getLastName()) ?><br/>
                        <?= $user->getEmail() ?>
                    </p>
                </div>
            </div>
            <div class="user-details-form"  style="display: none;">
                <div class="details-left">
                    <form action="index.php?redirect=ATshop&amp;action=updateUser" method="post" id="updateUserForm" class="user-profile-form">
                        <p>
                            <label for="firstName">Name</label>
                            <br/>
                            <input type="text" name="firstName" value="<?= ucfirst($user->getFirstName()) ?>" id="firstName"/>
                        </p>
                        <p>
                            <label for="lastName">Last Name</label>
                            <br/>
                            <input type="text" name="lastName" value="<?= ucfirst($user->getLastName()) ?>" id="lastName"/>
                        </p>
                        <p>
                            <label for="email">Email</label>
                            <br/>
                            <input type="text" name="email" value="<?= $user->getEmail() ?>" id="email"/>
                        </p>
                        <p>
                            <span class="info-form"></span>
                        </p>
                        <button class="button-save-form">Save</button>
                    </form>
                </div>
                <div class="details-right">
                    <p>
                        <span id="info-details-form"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="user-order-container">
            <div class="user-profile-header">
                <h4 class="user-profile-h4">My orders</h4>
            </div>
            <div class="user-order-content">
                <p>
                    <a href="index.php?redirect=ATshop&amp;action=getAllPurchase">See all orders</a>
                </p>
        </div>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script src="public/js/ATshop/getUser.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
