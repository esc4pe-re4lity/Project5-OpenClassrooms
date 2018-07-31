<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Confirmation" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-confirmation">
    <div>
        <p>
            You have successfully created your account !
            Please check your e-mails and click on the link to verify your account.
        </p>
    </div>
    
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script>
    $(document).ready(function () {
    });
</script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
