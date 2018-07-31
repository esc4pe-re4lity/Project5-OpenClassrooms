<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $description = ""; ?>

<?php $title = "AT Shop - Payment" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-payment">
    <div class="basket-payment">
        <div class="payment-header">
            <h3>Checkout : Payment (Step 3)</h3>
        </div>
        <form action="index.php?redirect=ATshop&amp;action=payment" method="POST" id="payment-form">
            <div class="form-row">
                <label for="card-element">
                    Credit or Debit Card
                </label>
                <div id="card-element"></div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button class="button-payment">Pay</button>
            <div class="basket-total-payment">
                <p>Total: <span class="price-items-basket"><?= $_SESSION['totalPrice'] ?></span>€</p>
            </div>
        </form>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script src="public/js/ATshop/payment.js"></script>
<script src="public/js/ATshop/stripe.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
