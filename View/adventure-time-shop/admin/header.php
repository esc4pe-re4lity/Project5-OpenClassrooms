<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php ob_start(); ?>
<div id="AT-fixed-nav">
    <ul id="AT-nav">
        <li>
            <a href="index.php?redirect=ATshop&amp;action=getUser">
                <i class="fas fa-user"></i>
                <!--<img src="Public/images/at-shop/<?= $user->getImage() ?>.png" alt="user profile picture" id="profile-picture">-->
                My Profile
            </a>
            <div id="itemAddedToShop">
                <img class="itemAddedToShop-image" src="">
                <span class="itemAddedToShop-name"></span>
                <span class="itemAddedToShop-text">has been added to the shop !</span>
            </div>
        </li>
        <li>
            <a href="index.php?redirect=ATshop&amp;action=logout">
                <i class="fas fa-power-off"></i>
                Logout
            </a>
        </li>
    </ul>
</div>
<div id="AT-logo">
    <h1 style="display: none;">Adventure Time Shop</h1>
    <a href="index.php?redirect=ATshop">
        <img src="Public/images/atshop/atshop.png" alt="adventure time logo" id="logo">
    </a>
    <p>Adventure Time Merchandise sold by a fan to honor the greatest TV show on Earth</p>
</div>
<div></div>

<?php
$header = ob_get_clean();
