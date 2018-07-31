<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - Home" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-allItems-admin">
    <div class="columns columns-admin">
        <div class="page-content">
            <div class="page-wrapper">
            <?php
            foreach ($res->data as $image) {
                $imageURL = $image->images->low_resolution->url;
                $idInstagramPost = $image->id;
            ?>
                <div class="AT-blockImage">
                    <div class="AT-post" style="cursor:pointer; background-image: url('<?= $imageURL ?>');">
                        <div class="AT-text" data-ig-id="<?=$idInstagramPost?>">
                            <div class="FA-icon-plus">
                                <i class="fas fa-plus"></i>
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
    <div id="addItem">
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $section2 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<script src="public/js/ATshop/homeAdmin.js"></script>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
