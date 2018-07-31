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
        <div class="user-password-container">
            <div class="user-profile-header">
                <div class="button-hide-form" id="closePasswordForm" style="display: none">
                    <i class="fas fa-window-close"></i>
                </div>
                <button id="updatePasswordButton" class="button-show-form">Edit</button>
                <h4 class="user-profile-h4">Modify Password</h4>
            </div>
            <div class="user-password-content">
                <div class="user-password-text">
                    <p>
                        To make your password stronger,<br>
                        Make it at least 6 characters<br>
                        Add lowercase letters<br>
                        Add uppercase letters<br>
                        Add numbers<br>
                        Add special characters
                    </p>
                    <img src="public/images/at-shop/pmb-password.png" alt="pepermint buttler">
                </div>
            </div>
            <div class="user-password-form" style="display: none;">
                <div class="password-left">
                    <form action="index.php?redirect=ATshop&amp;action=updatePassword" method="post" id="updatePasswordForm" class="user-profile-form">
                        <p>
                            <label for="oldPassword">Current password</label>
                            <br/>
                            <input type="password" name="oldPassword" placeholder="Your current password" id="oldPassword"/>
                        </p>
                        <p>
                            <label for="newPassword">New password</label>
                            <br/>
                            <input type="password" name="newPassword" placeholder="Your new password" id="newPassword"/>
                        </p>
                        <button class="button-save-form">Save</button>
                    </form>
                </div>
                <div class="password-right">
                    <p>
                        <span id="info-password-form"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="user-address-container">
            <div class="user-profile-header">
                <div class="button-hide-form" id="closeAddressForm" style="display: none">
                    <i class="fas fa-window-close"></i>
                </div>
                <button id="addAddressButton" class="button-show-form">Add a new address</button>
                <h4 class="user-profile-h4">My address</h4>
            </div>
            <?php
            if (!empty($res1)) {
            ?>
            <div class="user-address-content">
            <?php
                foreach ($res1 as $address) {
                    ?>
                    <div class="user-address-text" data-address-id="<?= $address->getIdAddress() ?>">
                        <div class="address-top-text">
                            <h5>
                                <span class="shipping-address-nameAddress"><?= $address->getNameAddress() ?></span>
                            </h5>
                            <div class="user-address-buttons">
                                <div class="deleteAddress" data-address-id="<?= $address->getIdAddress() ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                                <div class="updateAddress" data-address-id="<?= $address->getIdAddress() ?>">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </div>
                        </div>
                        <div class="address-bottom-text">
                            <p>
                                <span class="shipping-address-fullName"><?= $address->getFullName() ?><br></span>
                                <span class="shipping-address-line1"><?= $address->getLine1() ?><br></span>
                                <span class="shipping-address-line2"><?= $address->getLine2() ?><br></span>
                                <span class="shipping-address-postcode"><?= $address->getPostcode() ?></span>
                                <span class="shipping-address-city"><?= $address->getCity() ?><br></span>
                                <span class="shipping-address-country"><?= $address->getCountry() ?></span>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
                <?php
            } else {
            ?>
            <div class="user-address-content">
                <p>You haven't registered any address yet, it's time to do it !</p>
            </div>
            <?php
            }
            ?>
            <div class="user-address-form">
                <form action="index.php?redirect=ATshop&amp;action=addAddress" method="post" id="addAddressForm" style="display: none;" class="user-profile-form">
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
                            <option value="uk">United Kingdom</option>
                        </select>
                    </p>
                    <p>
                        <span class="info-form"></span>
                    </p>
                    <button class="button-save-form">Save</button>
                </form>
            </div>
        </div>
        <div class="user-order-container">
            <div class="user-profile-header">
                <h4 class="user-profile-h4">My orders</h4>
            </div>
            <div class="user-order-content">
                <?php
                if (!empty($res2)) {
                    foreach ($res2 as $purchase) {
                ?>
                <div class="user-order-text">
                    <div class="order-top-text">
                        <a href="index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>">
                            <i class="fas fa-shopping-basket"></i>
                            <span>Order No. #<?= $purchase->getIdPurchase() ?></span>
                        </a>
                        <span class="order-date"><?= $purchase->getCreationDate() ?></span>
                    </div>
                    <div class="order-bottom-text">
                        <p>
                            Current status: <em><?= $purchase->getState() ?></em>
                        </p>
                        <p><?= $purchase->getTotalPrice() ?>€</p>
                    </div>
                </div>
                <?php
                    }
                } else {
                ?>
                <div class="user-order-text-empty">
                    <p>You haven't ordered anything yet, it's time to place an order !</p>
                </div>
                <?php
                }
                ?>
            </div>
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
