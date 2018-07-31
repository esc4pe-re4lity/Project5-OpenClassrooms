<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Create account" ?>


<?php require('header.php'); ?>


<?php ob_start(); ?>
<section class="AT-createAccount">
    <div class="createAccount-container">
        <div class="createAccount-header">
            <h3>Create a new account</h3>
        </div>
        <div class="createAccount-content">
            <div class="createAccount-left">
                <form class="login" method="post" action="index.php?redirect=ATshop&amp;action=createAccount">
                    <p>
                        <label for="firstName">First Name <span class="login-asterix">*</span></label>
                        <br/>
                        <input type="text" name="firstName" id="firstName" required/>
                    </p>
                    <p>
                        <label for="lastName">Last Name <span class="login-asterix">*</span></label>
                        <br/>
                        <input type="text" name="lastName" id="lastName" required/>
                    </p>
                    <p>
                        <label for="email">Email <span class="login-asterix">*</span></label>
                        <br/>
                        <input type="email" name="email" id="email" required/>
                    </p>
                    <p>
                        <label for="password">Create a password <span class="login-asterix">*</span></label>
                        <br/>
                        <input type="password" name="password" id="password" required/>
                    </p>
                    <p>
                        <label for="confirmPassword">Confirm your password <span class="login-asterix">*</span></label>
                        <br/>
                        <input type="password" name="confirmPassword" id="confirmPassword" required/>
                    </p>
                    <p>
                        <button class="login-button">Create new account</button>
                    </p>
                    <p>You already have an account ? Please click <a href="index.php?redirect=ATshop&amp;action=login">here</a></p>
                </form>
            </div>
            <div class="createAccount-right">
                <img src="public/images/at-shop/pb-form.png" alt="princess bubblegum">
                <p>
                    <span id="info-form"></span>
                </p>
            </div>
        </div>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>


<?php require('footer.php'); ?>


<?php ob_start(); ?>
<script src="public/js/ATshop/createAccount.js"></script>
<?php $script = ob_get_clean(); ?>


<?php
require('template.php');
