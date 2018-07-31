<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
foreach ($res as $item){
?>
<div class="detail-item-content">
    <div class="detail-item-left">
        <div class="detail-item-image-container">
            <img class="detail-item-image" src="<?= $item->getSrcStandardResolutionItem() ?>" alt=""/>
        </div>
    </div>
    <div class="detail-item-right">
        <h3 class="detail-item-name"><?= $item->getNameItem() ?></h3>
        <p><?= $item->getDescriptionItem() ?></p>
        <p><em><?= $item->getFormattedCreationDateItem() ?></em></p>
        <div class="quantity-item-container">
            <button id="minus-quantity">-</button>
            <span class="quantity-item">1</span>
            <button id="plus-quantity">+</button>
        </div>
        <p class="detail-item-price"><?= $item->getPriceItem()?>€</p>
        <div class="addToButtons">
            <div class="addToWishlist" data-item-id="<?= $item->getIdItem() ?>">
                <i class="fas fa-heart"></i>
                <span class="addTo-text">Add to wishlist</span>
            </div>
            <div class="addToBasket" data-item-id="<?= $item->getIdItem() ?>">
                <i class="fas fa-shopping-basket"></i>
                <span class="addTo-text">Add to basket</span>
            </div>
        </div>
    </div>
</div>
<?php 
}
?>