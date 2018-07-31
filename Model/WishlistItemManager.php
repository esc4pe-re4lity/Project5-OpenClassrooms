<?php


require_once 'WishlistItem.php';
require_once 'Wishlist.php';
require_once 'Item.php';
require_once 'Manager.php';


class WishlistItemManager extends Manager {

    public function add(WishlistItem $wishlistItem) {
        $req = $this->db->prepare('INSERT INTO wishlist_item(idWishlist, idItem)'.''
                . 'VALUES(:idWishlist, :idItem)');
        $req->execute([
            'idWishlist' => $wishlistItem->getIdWishlist(),
            'idItem' => $wishlistItem->getIdItem()
        ]);
    }

    public function get(Wishlist $wishlist) {
        $req = $this->db->prepare('SELECT * FROM wishlist_item WHERE idWishlist=:idWishlist');
        $req->execute(['idWishlist' => $wishlist->getIdWishlist()]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'WishlistItem');
        $wishlistItem = $req->fetchAll();
        return $wishlistItem;
    }

    public function update(WishlistItem $wishlistItem) {
        
    }

    public function delete(Wishlist $wishlist) {
        $req=$this->db->prepare('DELETE FROM wishlist_item WHERE idWishlist=:idWishlist');
        $req->execute(['idWishlist' => $wishlist->getIdWishlist()]);
    }

}
?>
