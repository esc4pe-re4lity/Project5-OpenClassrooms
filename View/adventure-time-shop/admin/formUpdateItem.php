<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    foreach ($res as $item){
?>
<form action="index.php?redirect=ATshop&amp;action=updateItem" method="post">
    <p>
        <label for="nameItem">Name item</label>
        <br/>
        <input type="text" name="nameItem" id="nameItem" value="<?=$item->getNameItem()?>" required>
    </p>
    <p>
        <label for="priceItem">Price</label>
        <br/>
        <input type="text" name="priceItem" id="priceItem" value="<?=$item->getPriceItem()?>" required>
    </p>
    <p>
        <label for="remainingItem">Quantity available</label>
        <br/>
        <input type="text" name="remainingItem" id="remainingItem" value="<?=$item->getRemainingItem()?>" required>
    </p>
    <p style="display: none;">
        <input type="text" name="idItem" value="<?=$item->getIdItem()?>">
    </p>
    <p class="updateOrDelete">
        <input class="button" type="submit" id="save" value="Update item"/>
        or
        <a href="index.php?redirect=ATshop&amp;action=deleteItem&amp;idItem=<?=$item->getIdItem()?>">
            Delete item
        </a>
    </p>
</form>
<?php
}
