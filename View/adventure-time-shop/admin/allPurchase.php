<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php $title = "AT Shop - All purchase" ?>

<?php require('header.php'); ?>

<?php ob_start(); ?>
<section class="AT-purchase">
    <div class="user-profile-header">
        <h4 class="user-profile-h4">Orders</h4>
    </div>
    <div class="allPurchase-content">
        <?php
        if (!empty($res)) {
        ?>
        <div class="pending-orders-container">
            <div class="pending-orders-header">
                <h4>Pending Orders</h4>
            </div>
            <?php
            foreach ($pendingPurchase as $purchase) {
            ?>
            <div class="pending-orders">
                <div class="user-order-text">
                    <div class="order-top-text">
                        <a href="index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>">
                            <i class="fas fa-shopping-basket"></i>
                            <span>Order No. #<?= $purchase->getIdPurchase() ?></span>
                        </a>
                        <span class="order-date"><?= $purchase->getCreationDate() ?></span>
                    </div>
                    <div class="order-bottom-text">
                        <div class="order-bottom-text-left">
                            <p>
                                Current status: <em><?= $purchase->getState() ?></em>
                            </p>
                            <p><?= $purchase->getTotalPrice() ?>€</p>
                        </div>
                        <div class="order-bottom-text-right">
                            <a href="index.php?redirect=ATshop&amp;action=updatePurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>&amp;statePurchase=4">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            <a href="index.php?redirect=ATshop&amp;action=updatePurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>&amp;statePurchase=2">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="delivering-orders-container">
            <div class="delivering-orders-header">
                <h4>Delivering Orders</h4>
            </div>
            <?php
            foreach ($deliveringPurchase as $purchase) {
            ?>
            <div class="delivering-orders">
                <div class="user-order-text">
                    <div class="order-top-text">
                        <a href="index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>">
                            <i class="fas fa-shopping-basket"></i>
                            <span>Order No. #<?= $purchase->getIdPurchase() ?></span>
                        </a>
                        <span class="order-date"><?= $purchase->getCreationDate() ?></span>
                    </div>
                    <div class="order-bottom-text">
                        <div class="order-bottom-text-left">
                            <p>
                                Current status: <em><?= $purchase->getState() ?></em>
                            </p>
                            <p><?= $purchase->getTotalPrice() ?>€</p>
                        </div>
                        <div class="order-bottom-text-right">
                            <a href="index.php?redirect=ATshop&amp;action=updatePurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>&amp;statePurchase=3">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

        <div class="passed-orders-container">
            <div class="passed-orders-header">
                <h4>Passed Orders</h4>
            </div>
            <?php
            foreach ($passedPurchase as $purchase) {
            ?>
            <div class="passed-orders">
                <div class="user-order-text">
                    <div class="order-top-text">
                        <a href="index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>">
                            <i class="fas fa-shopping-basket"></i>
                            <span>Order No. #<?= $purchase->getIdPurchase() ?></span>
                        </a>
                        <span class="order-date"><?= $purchase->getCreationDate() ?></span>
                    </div>
                    <div class="order-bottom-text">
                        <div class="order-bottom-text-left">
                            <p>
                                Current status: <em><?= $purchase->getState() ?></em>
                            </p>
                            <p><?= $purchase->getTotalPrice() ?>€</p>
                        </div>
                        <div class="order-bottom-text-right">
                            <a href="index.php?redirect=ATshop&amp;action=updatePurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>&amp;statePurchase=4">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

        <div class="canceled-orders-container">
            <div class="canceled-orders-header">
                <h4>Canceled Orders</h4>
            </div>
            <?php
            foreach ($canceledPurchase as $purchase) {
            ?>
            <div class="canceled-orders">
                <div class="user-order-text">
                    <div class="order-top-text">
                        <a href="index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=<?= $purchase->getIdPurchase() ?>">
                            <i class="fas fa-shopping-basket"></i>
                            <span>Order No. #<?= $purchase->getIdPurchase() ?></span>
                        </a>
                        <span class="order-date"><?= $purchase->getCreationDate() ?></span>
                    </div>
                    <div class="order-bottom-text">
                        <div class="order-bottom-text-left">
                            <p>
                                Current status: <em><?= $purchase->getState() ?></em>
                            </p>
                            <p><?= $purchase->getTotalPrice() ?>€</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <?php
        } else {
        ?>
        <div class="user-order-text">
            <p>No orders have been made yet.</p>
        </div>
        <?php
        }
        ?>
    </div>
</section>
<?php $section1 = ob_get_clean(); ?>

<?php require('footer.php'); ?>

<?php ob_start(); ?>
<?php $script = ob_get_clean(); ?>

<?php
require('template.php');
