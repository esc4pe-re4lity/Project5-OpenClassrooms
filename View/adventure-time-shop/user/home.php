<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Home" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<div class="AT-preprend-detail-item">
    <div class="AT-detail-item hidden">
        <div class="outer-detail-container">
            <div id="detail-container">

            </div>
        </div>
    </div>
</div>
<section class="AT-allItems">
    <div class="columns">
        <div class="page-content">
            <div class="page-wrapper">
                <?php
                foreach ($res as $item) {
                    ?>
                    <div class="AT-blockImage">
                        <div class="AT-post" style="cursor:pointer; background-image: url('<?= $item->getSrcStandardResolutionItem() ?>');">
                            <div class="AT-text" data-item-id="<?= $item->getIdItem() ?>">
                                <div class="FA-icon-eye">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </div>
                        </div>
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
<script src="public/js/ATshop/home.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
unset($_SESSION['message']);
unset($_SESSION['image']);
