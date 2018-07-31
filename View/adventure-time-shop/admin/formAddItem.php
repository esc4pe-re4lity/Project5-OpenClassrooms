<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<form action="index.php?redirect=ATshop&amp;action=addItem" method="post">
    <p>
        <label for="nameItem">Nom du Produit</label>
        <br/>
        <input type="text" name="nameItem" id="nameItem" value="" required>
    </p>
    <p>
        <label for="priceItem">Prix</label>
        <br/>
        <input type="text" name="priceItem" id="priceItem" value="" required>
    </p>
    <p>
        <label for="remainingItem">Quantité disponible</label>
        <br/>
        <input type="text" name="remainingItem" id="remainingItem" value="" required>
    </p>
    <p style="display: none;">
        <input type="text" name="idInstagramPost" value="<?=$idInstagramPost?>">
    </p>
    <p>
        <input class="button" type="submit" id="save" value="Ajouter l'article"/>
    </p>
</form>