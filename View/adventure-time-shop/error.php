<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Error" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-error">
    <div class="error-container">
        <div class="error-header">
            <h3>We're sorry, there is some kind of error...</h3>
        </div>
        <div class="error-content">
            <?=$_SESSION['error']?>
            <img src="public/images/at-shop/error.png" alt="image from the adventure time episode A Glitch is a Glitch">
        </div>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
unset($_SESSION['error']);
