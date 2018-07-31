<?php


require_once 'Wishlist.php';
require_once 'User.php';
require_once 'Manager.php';


class WishlistManager extends Manager {

    public function add(User $user) {
        $req = $this->db->prepare('INSERT INTO wishlist(idUser) VALUES(:idUser)');
        $req->execute(['idUser' => $user->getIdUser()]);
    }

    public function get(User $user) {
        $req = $this->db->prepare('SELECT * FROM wishlist WHERE idUser=:idUser');
        $req->execute(['idUser' => $user->getIdUser()]);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Wishlist');
        $wishlist = $req->fetchAll();
        return $wishlist;
    }

    public function update(Wishlist $wishlist) {
        $req = $this->db->prepare('UPDATE wishlist SET totalItemsWishlist=:totalItemsWishlist WHERE idWishlist=:idWishlist');
        $req->execute([
            'totalItemsWishlist' => $wishlist->getTotalItemsWishlist(),
            'idWishlist' => $wishlist->getIdWishlist()
        ]);
    }

    public function delete($id) {
        
    }

}
?>
