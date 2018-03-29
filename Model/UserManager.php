<?php

require_once 'User.php';
require_once 'Manager.php';

class UserManager extends Manager {

    public function isValid(User $user) {
        $req = $this->db->prepare('SELECT pseudo, email FROM user WHERE pseudo=:pseudo OR email=:email');
        $req->execute([
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail()]);
        if ($req->rowCount() === 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add(User $user) {
        $req = $this->db->prepare('INSERT INTO user(pseudo, email, password, creationDate)'
                . 'VALUES (:pseudo, :email, :password, NOW())');
        $req->execute([
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
        $user->hydrate([
            'idUser' => $this->db->lastInsertId(),
            'isAdmin' => 0,
            'creationDate' => date("Y-m-d H:i:s")
        ]);
    }

    public function get($idUser) {
        $req = $this->db->prepare('SELECT * FROM user WHERE idUser=:idUser');
        $req->execute(['idUser' => $idUser]);
        $req->setFetchMode(PDO::FETCH_CLASS || PDO::FETCH_PROPS_LATE, 'User');
        $users = $req->fetchAll();
        return $users;
    }

    public function getIdUser(User $user) {
        $req = $this->db->prepare('SELECT idUser FROM user WHERE pseudo=:pseudo OR email=:email');
    }

    public function update(User $user) {
        $req = $this->db->prepare('UPDATE user SET pseudo=:pseudo, email=:email WHERE idUser=:idUser');
        $req->execute([
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'idUser' => $user->getIdUser()
        ]);
    }

    public function updateDetails(User $user) {
        $req = $this->db->prepare('UPDATE user SET name=:name, lastName=:lastName, address=:address WHERE idUser=:idUser');
        $req->execute([
            'name' => $user->getName(),
            'lastName' => $user->getLastname(),
            'address' => $user->getAddress(),
            'idUser' => $user->getIdUser()
        ]);
    }

    public function delete($idUser) {
        
    }

    public function login(User $user) {
        $req = $this->db->prepare('SELECT * FROM user WHERE pseudo=:pseudo AND password=:password');
        $req->execute([
            'pseudo' => $user->getPseudo(),
            'password' => $user->getPassword(),
        ]);
        $row = $req->fetch();
        if ($row['pseudo'] === $user->getPseudo() && $row['password'] == $user->getPassword()) {
            $user->hydrate($row);
            return true;
        } else {
            return false;
        }
    }

}

?>
