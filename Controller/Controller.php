<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Fiamma
 */
require(AUTOLOAD);
require (COSENARY . '/src/Instagram.php');
require (COSENARY . '/src/InstagramException.php');

use MetzWeb\Instagram\Instagram;

session_start();

class Controller {
    
    public function isEmailValid(){
        if(isset($_POST['email'])){
            if(!empty(trim($_POST['email']))){
                $data = [
                    'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                ];
                $user = new User($data);
                $userManager = new UserManager();
                $res = $userManager->isValid($user);
                if ($res === true) {
                    echo 'true';
                } else {
                    echo 'false';
                }
            }
        } else {
            $this->getError();
        }
    }

    public function addUser() {
        if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
            if (!empty(trim($_POST['firstName'])) && !empty(trim($_POST['lastName'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['confirmPassword']))) {
                $data = [
                    'firstName' => filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'lastName' => filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'password' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                ];
                $user = new User($data);
                $user->chooseCharacter();
                $userManager = new UserManager();
                $res = $userManager->isValid($user);
                if ($res === true) {
                    $userManager->add($user);
                    $this->addBasket($user);
                    $this->addWishlist($user);
                    $this->sendEmail($user);
                    $this->loginUser();
                } else {
                    $_SESSION['error'] = "<p>You couldn't create an new account because the email has already beeing used. Maybe you have forgotten your password."
                            . "You can try to <a href='index.php?redirect=ATshop&amp;action=login'>login</a> with this email or "
                            . "<a href='index.php?redirect=ATshop&amp;action=login'>create a new account</a> with another email.</p>";
                    require(VIEW . '/adventure-time-shop/error.php');
                }
            } else {
                echo 'Empty field(s)';
            }
        } else {
            require(VIEW . '/adventure-time-shop/createAccount.php');
        }
    }

    public function getUser() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $addressManager = new AddressManager();
            $purchaseManager = new PurchaseManager();
            $res1 = $addressManager->getAll($user);
            $res2 = $purchaseManager->getAllUserPurchase($user);
            if ($user->getIsAdmin() === 1) {
                require(VIEW . '/adventure-time-shop/admin/getUser.php');
            } else {
                require (VIEW . '/adventure-time-shop/user/getUser.php');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function updateUser() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email'])) {
                if (!empty(trim($_POST['firstName'])) && !empty(trim($_POST['lastName'])) && !empty(trim($_POST['email']))) {
                    $userManager = new UserManager();
                    $data = [
                        'firstName' => filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'lastName' => filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)
                    ];
                    $user->hydrate($data);
                    $userManager->updateDetails($user);
                    header('Location: index.php?redirect=ATshop&action=getUser');
                } else {
                    echo 'empty fields';
                }
            } else {
                echo 'empty fields';
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }
    
    public function updatePassword(){
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
                if (!empty(trim($_POST['oldPassword'])) && !empty(trim($_POST['newPassword']))) {
                    $userManager = new UserManager();
                    $data1 = [
                        'password' => filter_input(INPUT_POST, 'oldPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                    ];
                    $user->hydrate($data1);
                    $res = $userManager->verifyPassword($user);
                    if($res === true){
                        $data2 = [
                            'password' => filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                        ];
                        $user->hydrate($data2);
                        $userManager->updatePassword($user);
                        header('Location: index.php?redirect=ATshop&action=getUser');
                    } else {
                        $_SESSION['error'] = "<p>You couldn't change your password because the current password that you entered is not the correct one. "
                                . "You can try again to <a href='index.php?redirect=ATshop&amp;action=getUser'>change your password</a>.</p>";
                        require(VIEW . '/adventure-time-shop/error.php');
                    }
                } else {
                    echo 'empty fields';
                }
            } else {
                echo 'empty fields';
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function loginUser() {
        if (isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {
            if (!empty(trim($_POST['oldPassword'])) && !empty(trim($_POST['newPassword']))) {
                $data = [
                    'oldPassword' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'newPassword' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                ];
                $user = new User($data);
                $userManager = new UserManager;
                $res = $userManager->login($user);
                if ($res === true) {
                    $this->getBasketUser($user);
                    $this->getWishlistUser($user);
                    $this->getAddressUser($user);
                    $_SESSION['user'] = $user;
                    $_SESSION['message'] = 'Welcome ' . ucfirst($user->getFirstName()) . ' !';
                    $_SESSION['image'] = '';
                    header('Location: index.php?redirect=ATshop');
                } else {
                    $_SESSION['error'] = "<p>You couldn't login because the email and the password doesn't match. One of them (or both) might be wrong."
                            . "You can try again to <a href='index.php?redirect=ATshop&amp;action=login'>login</a>.</p>";
                    require(VIEW . '/adventure-time-shop/error.php');
                }
            } else {
                echo 'empty fields';
            }
        } else {
            require(VIEW . '/adventure-time-shop/login.php');
        }
    }

    public function sendEmail(User $user) {
        $to = $user->getEmail();
        $firstName = ucfirst($user->getFirstName());
        $lastName = ucfirst($user->getLastName());
        $subject = 'Welcome to the Adventure Time Shop Family !';
        $message = <<<EOD
        <div style="background:no-repeat top center;margin:0;padding:0">
            <a href="louna-mitsou.fr/index.php?redirect=ATshop">
                <img src="https://78.media.tumblr.com/67c3bec55b8b93a58db3a03d9b61646e/tumblr_p8kkwmT8Ke1x3feeno1_1280.jpg" style="display:block;margin:auto;">
            </a>
            <div style="text-align:center">
                <p style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#333333">Welcome $firstName $lastName</p>
                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#595959;line-height:20px">
                    This is to confirm that you are from now on, a member of the Adventure Time Family.<br/><br/>
                    You can start to shop on our website the merchandise available right away. Don't forget to save an address for the shipping !<br/><br/>
                    Please enjoy yourself<br/><br/>
                    <em>It's Adventure Time !</em>
                </p>
                <br/>
                <img src="http://newnation.sg/wp-content/uploads/fist-bump-adventure.gif" alt="Finn and Jake Trustpound Gif"/>
            </div>
        </div>
EOD;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    public function logoutUser() {
        // enregistrer le panier, la wishlist avec la variable de $_SESSION
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $this->saveBasket($user);
            $this->saveWishlist($user);
        }
        session_destroy();
        session_start();
        $_SESSION['message'] = 'See yaaaaa!';
        $_SESSION['image'] = 'Public/images/at-shop/bye.png';
        // renvoyer vers une page qui dit qu'on a bien été déconnecté ?
        header('Location: index.php?redirect=ATshop');
    }

    public function deleteUser() {
        
    }

    public function addItem() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                if (isset($_SESSION['instagram'])) {
                    $instagram = $_SESSION['instagram'];
                    if (isset($_POST['idInstagramPost'])) {
                        if (!empty(trim($_POST['idInstagramPost']))) {
                            $idInstagramPost = filter_input(INPUT_POST, 'idInstagramPost', FILTER_SANITIZE_SPECIAL_CHARS);
                            $res = $instagram->getMedia($idInstagramPost);
                            if (isset($_POST['nameItem']) && isset($_POST['priceItem']) && isset($_POST['remainingItem'])) {
                                if (!empty(trim($_POST['nameItem'])) && !empty(trim($_POST['priceItem'])) && !empty(trim($_POST['remainingItem']))) {
                                    $data = [
                                        'idInstagramPost' => $idInstagramPost,
                                        'descriptionItem' => $res->data->caption->text,
                                        'creationDateItem' => $res->data->created_time,
                                        'srcThumbResolutionItem' => $res->data->images->thumbnail->url,
                                        'srcLowResolutionItem' => $res->data->images->low_resolution->url,
                                        'srcStandardResolutionItem' => $res->data->images->standard_resolution->url,
                                        'nameItem' => filter_input(INPUT_POST, 'nameItem', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                                        'priceItem' => filter_input(INPUT_POST, 'priceItem', FILTER_SANITIZE_NUMBER_FLOAT),
                                        'remainingItem' => filter_input(INPUT_POST, 'remainingItem', FILTER_SANITIZE_NUMBER_INT)
                                    ];
                                    $item = new Item($data);
                                    $itemManager = new ItemManager();
                                    $res = $itemManager->isValid($item);
                                    if ($res === true) {
                                        $itemManager->add($item);
                                        header('Location: index.php?redirect=ATshop');
                                    } else {
                                        $_SESSION['error'] = "<p>The item you tried to add id already in the data base"
                                                . "You can try to add another one. "
                                                . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                                        require(VIEW . '/adventure-time-shop/error.php');
                                    }
                                } else {
                                    echo 'Champ(s) vide(s)';
                                }
                            } else {
                                // catch error
                                echo 'formulaire mal envoyé';
                            }
                        } else {
                            echo 'empty id';
                        }
                    } else {
                        echo 'no id';
                    }
                } else {
                    $this->authInsta();
                }
            } else {
                header('Location: index.php?redirect=ATshop&action=login');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function getAllItems() {
        $itemManager = new ItemManager();
        $res = $itemManager->getAllItems();
        return $res;
    }

    public function getItem() {
        if (isset($_GET['idInstagramPost'])) {
            if (!empty(trim($_GET['idInstagramPost']))) {
                $idInstagramPost = filter_input(INPUT_GET, 'idInstagramPost', FILTER_SANITIZE_SPECIAL_CHARS);
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    if ($user->getIsAdmin() === 1) {
                        $itemManager = new ItemManager();
                        $res = $itemManager->getItemFromIdInstagramPost($idInstagramPost);
                        if (!empty($res)) {
                            require(VIEW . '/adventure-time-shop/admin/formUpdateItem.php');
                        } else {
                            require(VIEW . '/adventure-time-shop/admin/formAddItem.php');
                        }
                    } else {
                        header('Location: index.php?redirect=ATshop&action=login');
                    }
                } else {
                    header('Location: index.php?redirect=ATshop&action=login');
                }
            } else {
                $_SESSION['error'] = "<p>You need to put the id of the item if you want to see it. "
                        . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                require(VIEW . '/adventure-time-shop/error.php');
            }
        } elseif (isset($_GET['idItem'])) {
            if (!empty(trim($_GET['idItem']))) {
                $idItem = filter_input(INPUT_GET, 'idItem', FILTER_SANITIZE_SPECIAL_CHARS);
                $itemManager = new ItemManager();
                $res = $itemManager->getItem($idItem);
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    if ($user->getIsAdmin() === 1) {
                        require(VIEW . '/adventure-time-shop/admin/item.php');
                    } else {
                        require(VIEW . '/adventure-time-shop/user/item.php');
                    }
                } else {
                    require(VIEW . '/adventure-time-shop/item.php');
                }
            } else {
                $_SESSION['error'] = "<p>You need to put the id of the item if you want to see it. "
                        . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                require(VIEW . '/adventure-time-shop/error.php');
            }
        } else {
            $_SESSION['error'] = "<p>You need to put the id of the item if you want to see it. "
                    . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
            require(VIEW . '/adventure-time-shop/error.php');
        }
    }

    public function updateItem() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                if (isset($_POST['nameItem']) && isset($_POST['priceItem']) && isset($_POST['remainingItem']) && isset($_POST['idItem'])) {
                    if (!empty(trim($_POST['nameItem'])) && !empty(trim($_POST['priceItem'])) && !empty(trim($_POST['remainingItem'])) && !empty(trim($_POST['idItem']))) {
                        $data = [
                            'idItem' => filter_input(INPUT_POST, 'idItem', FILTER_SANITIZE_NUMBER_INT),
                            'nameItem' => filter_input(INPUT_POST, 'nameItem', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'priceItem' => filter_input(INPUT_POST, 'priceItem', FILTER_SANITIZE_NUMBER_FLOAT),
                            'remainingItem' => filter_input(INPUT_POST, 'remainingItem', FILTER_SANITIZE_NUMBER_INT)
                        ];
                        $item = new Item($data);
                        $itemManager = new ItemManager();
                        $res = $itemManager->isValid($item);
                        if ($res === true) {
                            $itemManager->update($item);
                            header('Location: index.php?redirect=ATshop');
                        } else {
                            $_SESSION['error'] = "<p>The item you tried to add id already in the data base"
                                    . "You can try to add another one. "
                                    . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                            require(VIEW . '/adventure-time-shop/error.php');
                        }
                    } else {
                        echo 'Champ(s) vide(s)';
                    }
                } else {
                    // catch error
                    echo 'formulaire mal envoyé';
                }
            } else {
                header('Location: index.php?redirect=ATshop&action=login');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }
    
    public function deleteItem(){
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                if (isset($_GET['idItem'])) {
                    $idItem = filter_input(INPUT_GET, 'idItem', FILTER_SANITIZE_NUMBER_INT);
                    $itemManager = new ItemManager();
                    $itemManager->delete($idItem);
                    header('Location: index.php?redirect=ATshop');
                } else {
                    echo 'no id';
                }                
            } else {
                header('Location: index.php?redirect=ATshop&action=login');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function addBasket(User $user) {
        $basketManager = new BasketManager();
        $basketManager->add($user);
    }

    public function addToBasket() {
        if (isset($_POST['idItem']) && isset($_POST['quantityItem']) && isset($_POST['priceItem'])) {
            $idItem = filter_input(INPUT_POST, 'idItem', FILTER_SANITIZE_NUMBER_INT);
            $quantityItem = filter_input(INPUT_POST, 'quantityItem', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $priceItem = filter_input(INPUT_POST, 'priceItem', FILTER_SANITIZE_NUMBER_FLOAT);
            if (empty($_SESSION['basket'])) {
                $_SESSION['basket'] = array();
                $_SESSION['basket']['idItem'] = array();
                $_SESSION['basket']['quantityItem'] = array();
                $_SESSION['basket']['priceItem'] = array();
                $_SESSION['basket']['totalItem'] = 0;
                $_SESSION['basket']['totalPrice'] = 0.00;
            }
            array_push($_SESSION['basket']['idItem'], $idItem);
            array_push($_SESSION['basket']['quantityItem'], $quantityItem);
            array_push($_SESSION['basket']['priceItem'], $priceItem);
            $_SESSION['basket']['totalItem'] = $_SESSION['basket']['totalItem'] + $quantityItem;
            $_SESSION['basket']['totalPrice'] = $_SESSION['basket']['totalPrice'] + ($quantityItem * $priceItem);
        } else {
            echo 'empty data';
        }
    }

    public function getBasket() {
        $itemManager = new ItemManager();
        $basketItems = array();
        $items = array();
        for ($i = 0; $i < count($_SESSION['basket']['idItem']); $i++) {
            $data = [
                'idItem' => $_SESSION['basket']['idItem'][$i],
                'quantityItem' => $_SESSION['basket']['quantityItem'][$i]
            ];
            $basketItem = new BasketItem($data);
            $item = $itemManager->getItem($_SESSION['basket']['idItem'][$i]);
            array_push($basketItems, $basketItem);
            array_push($items, $item);
        }
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                require(VIEW . '/adventure-time-shop/admin/basket.php');
            } else {
                require(VIEW . '/adventure-time-shop/user/basket.php');
            }
        } else {
            require(VIEW . '/adventure-time-shop/basket.php');
        }
    }

    public function getBasketUser(User $user) {
        $basketManager = new BasketManager();
        $basketItemManager = new BasketItemManager();
        $res = $basketManager->get($user);
        foreach ($res as $basket) {
            $res = $basketItemManager->get($basket);
            if (empty($_SESSION['basket'])) {
                $_SESSION['basket'] = array();
                $_SESSION['basket']['idItem'] = array();
                $_SESSION['basket']['quantityItem'] = array();
                $_SESSION['basket']['priceItem'] = array();
                $_SESSION['basket']['totalItem'] = 0;
                $_SESSION['basket']['totalPrice'] = 0.00;
            }
            foreach ($res as $basketItem) {
                array_push($_SESSION['basket']['idItem'], $basketItem->getIdItem());
                array_push($_SESSION['basket']['quantityItem'], $basketItem->getQuantityItem());
                array_push($_SESSION['basket']['priceItem'], $basketItem->getPriceItem());
            }
            $_SESSION['basket']['totalItem'] = $basket->getTotalItemsBasket() + $_SESSION['basket']['totalItem'];
            $_SESSION['basket']['totalPrice'] = $basket->getTotalPriceBasket() + $_SESSION['basket']['totalPrice'];
        }
    }

    public function updateBasket() {
        $item = $this->getItem();
        $data = [
        ];
        $basketItem = new BasketItem($data);
    }

    public function saveBasket(User $user) {
        $basketManager = new BasketManager();
        $res = $basketManager->get($user);
        $basketItemManager = new BasketItemManager();
        if (!empty($_SESSION['basket'])) {
            $data = [
                'totalItemsBasket' => $_SESSION['basket']['totalItem'],
                'totalPriceBasket' => $_SESSION['basket']['totalPrice']
            ];
            foreach ($res as $basket) {
                $basket->hydrate($data);
                $basketManager->update($basket);
                $basketItemManager->delete($basket); // supprime tous les basket_item avec l'id du basket pour actualiser les items qu'il y a dans le panier
                for ($i = 0; $i < count($_SESSION['basket']['idItem']); $i++) {
                    $data = [
                        'idBasket' => $basket->getIdBasket(),
                        'idItem' => $_SESSION['basket']['idItem'][$i],
                        'quantityItem' => $_SESSION['basket']['quantityItem'][$i],
                        'priceItem' => $_SESSION['basket']['priceItem'][$i],
                    ];
                    $basketItem = new BasketItem($data);
                    $basketItemManager->add($basketItem);
                }
            }
        } else {
            echo 'no basket';
        }
    }

    public function resetBasket(User $user) {
        $basketManager = new BasketManager();
        $res = $basketManager->get($user);
        $basketItemManager = new BasketItemManager();
        foreach ($res as $basket) {
            $basket->hydrate([
                'totalItemsBasket' => 0,
                'totalPriceBasket' => 0
            ]);
            $basketManager->update($basket);
            $basketItemManager->delete($basket);
        }
        $_SESSION['basket'] = array();
        $_SESSION['basket']['idItem'] = array();
        $_SESSION['basket']['quantityItem'] = array();
        $_SESSION['basket']['priceItem'] = array();
        $_SESSION['basket']['totalItem'] = 0;
        $_SESSION['basket']['totalPrice'] = 0.00;
    }

    public function addBasketItem() {
        
    }

    public function getBasketItem() {
        
    }

    public function saveBasketItem() {
        if (isset($_POST['idSession']) && isset($_POST['quantityItem']) && isset($_POST['priceItem'])) {
            $idSession = filter_input(INPUT_POST, 'idSession', FILTER_SANITIZE_NUMBER_INT);
            $quantityItem = filter_input(INPUT_POST, 'quantityItem', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $priceItem = filter_input(INPUT_POST, 'priceItem', FILTER_SANITIZE_NUMBER_FLOAT);
            $_SESSION['basket']['totalItem'] = (int) ($_SESSION['basket']['totalItem'] + ($quantityItem - $_SESSION['basket']['quantityItem'][$idSession]));
            $_SESSION['basket']['totalPrice'] = (int) ($_SESSION['basket']['totalPrice'] + (($quantityItem - $_SESSION['basket']['quantityItem'][$idSession]) * $priceItem));
            $_SESSION['basket']['quantityItem'][$idSession] = $quantityItem;
            $_SESSION['basket']['priceItem'][$idSession] = $priceItem;
            header('Content-Type: application/json');
            echo json_encode([
                'totalItem' => $_SESSION['basket']['totalItem'],
                'totalPrice' => $_SESSION['basket']['totalPrice']
            ]);
        }
    }

    public function deleteBasketItem() {
        if (isset($_POST['idSession']) && isset($_POST['quantityItem']) && isset($_POST['priceItem'])) {
            $idSession = filter_input(INPUT_POST, 'idSession', FILTER_SANITIZE_NUMBER_INT);
            $quantityItem = filter_input(INPUT_POST, 'quantityItem', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $priceItem = filter_input(INPUT_POST, 'priceItem', FILTER_SANITIZE_NUMBER_FLOAT);
            unset($_SESSION['basket']['idItem'][$idSession]);
            unset($_SESSION['basket']['quantityItem'][$idSession]);
            unset($_SESSION['basket']['priceItem'][$idSession]);
            $_SESSION['basket']['idItem'] = array_values($_SESSION['basket']['idItem']);
            $_SESSION['basket']['quantityItem'] = array_values($_SESSION['basket']['quantityItem']);
            $_SESSION['basket']['priceItem'] = array_values($_SESSION['basket']['priceItem']);
            $_SESSION['basket']['totalItem'] = $_SESSION['basket']['totalItem'] - $quantityItem;
            $_SESSION['basket']['totalPrice'] = $_SESSION['basket']['totalPrice'] - ($quantityItem * $priceItem);
        } else {
            'missing data';
        }
    }

    public function addWishlist(User $user) {
        $wishlistManager = new WishlistManager();
        $wishlistManager->add($user);
    }

    public function addToWishlist() {
        if (isset($_POST['idItem'])) {
            $idItem = filter_input(INPUT_POST, 'idItem', FILTER_SANITIZE_NUMBER_INT);
            if (empty($_SESSION['wishlist'])) {
                $_SESSION['wishlist'] = array();
                $_SESSION['wishlist']['idItem'] = array();
                $_SESSION['wishlist']['totalItem'] = 0;
            }
            if ($_SESSION['wishlist']['totalItem'] === 0) {
                array_push($_SESSION['wishlist']['idItem'], $idItem);
                $_SESSION['wishlist']['totalItem'] = $_SESSION['wishlist']['totalItem'] + 1;
            } else {
                if (in_array($idItem, $_SESSION['wishlist']['idItem'])) {
                    echo 'The item has already been added to your wishlist';
                } else {
                    array_push($_SESSION['wishlist']['idItem'], $idItem);
                    $_SESSION['wishlist']['totalItem'] = $_SESSION['wishlist']['totalItem'] + 1;
                }
            }
        } else {
            echo 'no id';
        }
    }

    public function getWishlist() {
        $itemManager = new ItemManager();
        $wishlistItems = array();
        $items = array();
        for ($i = 0; $i < count($_SESSION['wishlist']['idItem']); $i++) {
            $data = [
                'idItem' => $_SESSION['wishlist']['idItem'][$i]
            ];
            $wishlistItem = new WishlistItem($data);
            $item = $itemManager->getItem($_SESSION['wishlist']['idItem'][$i]);
            array_push($wishlistItems, $wishlistItem);
            array_push($items, $item);
        }
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                require(VIEW . '/adventure-time-shop/admin/wishlist.php');
            } else {
                require(VIEW . '/adventure-time-shop/user/wishlist.php');
            }
        } else {
            require(VIEW . '/adventure-time-shop/wishlist.php');
        }
    }

    public function getWishlistUser(User $user) {
        $wishlistManager = new WishlistManager();
        $wishlistItemManager = new WishlistItemManager();
        $res = $wishlistManager->get($user);
        foreach ($res as $wishlist) {
            $res = $wishlistItemManager->get($wishlist);
            if (empty($_SESSION['wishlist'])) {
                $_SESSION['wishlist'] = array();
                $_SESSION['wishlist']['idItem'] = array();
                $_SESSION['wishlist']['totalItem'] = 0;
            }
            foreach ($res as $wishlistItem) {
                array_push($_SESSION['wishlist']['idItem'], $wishlistItem->getIdItem());
            }
            $_SESSION['wishlist']['totalItem'] = $wishlist->getTotalItemsWishlist() + $_SESSION['wishlist']['totalItem'];
        }
    }

    public function updateWishlist() {
        $idItem = filter_input(INPUT_GET, 'idItem', FILTER_VALIDATE_INT);
        $_SESSION['wishlist']['items'] = $idItem;
    }

    public function deleteWishlistItem() {
        if (isset($_POST['idSession'])) {
            $idSession = filter_input(INPUT_POST, 'idSession', FILTER_SANITIZE_NUMBER_INT);
            unset($_SESSION['wishlist']['idItem'][$idSession]);
            $_SESSION['wishlist']['idItem'] = array_values($_SESSION['wishlist']['idItem']);
            $_SESSION['wishlist']['totalItem'] = $_SESSION['wishlist']['totalItem'] - 1;
            var_dump($_SESSION['wishlist']);
        } else {
            'missing data';
        }
    }

    public function saveWishlist(User $user) {
        $wishlistManager = new WishlistManager();
        $wishlistItemManager = new WishlistItemManager();
        $res = $wishlistManager->get($user);
        if (!empty($_SESSION['wishlist'])) {
            $data = [
                'totalItemsWishlist' => $_SESSION['wishlist']['totalItem']
            ];
            foreach ($res as $wishlist) {
                $wishlist->hydrate($data);
                $wishlistManager->update($wishlist);
                $wishlistItemManager->delete($wishlist); // supprime tous les basket_item avec l'id du basket pour actualiser les items qu'il y a dans le panier
                for ($i = 0; $i < count($_SESSION['wishlist']['idItem']); $i++) {
                    $data = [
                        'idWishlist' => $wishlist->getIdWishlist(),
                        'idItem' => $_SESSION['wishlist']['idItem'][$i]
                    ];
                    $wishlistItem = new WishlistItem($data);
                    $wishlistItemManager->add($wishlistItem);
                }
            }
        }
    }

    public function addAddress() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (isset($_POST['fullName']) && isset($_POST['nameAddress']) && isset($_POST['line1']) && isset($_POST['postcode']) && isset($_POST['city']) && isset($_POST['country'])) {
                if (!empty(trim($_POST['fullName'])) && !empty(trim($_POST['nameAddress'])) && !empty(trim($_POST['line1'])) && !empty(trim($_POST['postcode'])) && !empty(trim($_POST['city']))) {
                    $addressManager = new AddressManager();
                    $data = [
                        'idUser' => $user->getIdUser(),
                        'fullName' => filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'nameAddress' => filter_input(INPUT_POST, 'nameAddress', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'line1' => filter_input(INPUT_POST, 'line1', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'line2' => filter_input(INPUT_POST, 'line2', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'postcode' => filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'city' => filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'country' => filter_input(INPUT_POST, 'country', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        'inUse' => 1
                    ];
                    $address = new Address($data);
                    $addressManager->add($address);
                    if (isset($_GET['shipping'])) {
                        header('Location: index.php?redirect=ATshop&action=shipping');
                    } else {
                        header('Location: index.php?redirect=ATshop&action=getUser');
                    }
                } else {
                    echo 'empty fields';
                } 
            } else {
                echo 'empty fields';
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function getAddressUser(User $user) {
        $addressManager = new AddressManager();
        $address = $addressManager->getAll($user);
    }

    public function getAddress() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (isset($_POST['idAddress'])) {
                if (!empty(trim($_POST['idAddress']))) {
                    $idAddress = filter_input(INPUT_POST, 'idAddress', FILTER_SANITIZE_NUMBER_INT);
                    $addressManager = new AddressManager();
                    $res = $addressManager->get($idAddress);
                    foreach ($res as $address) {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'nameAddress' => $address->getNameAddress(),
                            'fullName' => $address->getFullName(),
                            'line1' => $address->getLine1(),
                            'line2' => $address->getLine2(),
                            'postcode' => $address->getPostcode(),
                            'city' => $address->getCity(),
                            'country' => $address->getCountry(),
                        ]);
                    }
                } else {
                    echo 'empty fields';
                }
            } else {
                echo 'no id address';
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function updateAddress() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (isset($_GET['idAddress'])) {
                $idAddress = filter_input(INPUT_GET, 'idAddress', FILTER_SANITIZE_NUMBER_INT);
                if (isset($_POST['nameAddress']) && isset($_POST['fullName']) && isset($_POST['line1']) && isset($_POST['postcode']) && isset($_POST['city']) && isset($_POST['country'])) {
                    if (!empty(trim($_POST['nameAddress'])) && !empty(trim($_POST['fullName'])) && !empty(trim($_POST['line1'])) && !empty(trim($_POST['postcode'])) && !empty(trim($_POST['city']))) {
                        $addressManager = new AddressManager();
                        $data = [
                            'idAddress' => $idAddress,
                            'nameAddress' => filter_input(INPUT_POST, 'nameAddress', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'fullName' => filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'line1' => filter_input(INPUT_POST, 'line1', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'line2' => filter_input(INPUT_POST, 'line2', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'postcode' => filter_input(INPUT_POST, 'postcode', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'city' => filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                            'country' => filter_input(INPUT_POST, 'country', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                        ];
                        $address = new Address($data);
                        $addressManager->update($address);
                        header('Location: index.php?redirect=ATshop&action=getUser');
                    }
                } else {
                    echo 'empty fields';
                }
            } else {
                echo 'missing id';
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function deleteAddress() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (isset($_POST['idAddress'])) {
                if (!empty(trim($_POST['idAddress']))) {
                    $addressManager = new AddressManager();
                    $data = [
                        'idAddress' => filter_input(INPUT_POST, 'idAddress', FILTER_SANITIZE_NUMBER_INT),
                        'inUse' => 0
                    ];
                    $address = new Address($data);
                    $addressManager->changeInUse($address);
                } else {
                    echo 'empty fields';
                }
            } else {
                echo 'no id';
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function addPurchase(User $user) {
        $dataPurchase = [
            'idUser' => $user->getIdUser(),
            'state' => 1,
            'stripeToken' => $_SESSION['stripeToken'],
            'billingAddress' => $_SESSION['shipping']['billingAddress'],
            'shippingAddress' => $_SESSION['shipping']['shippingAddress'],
            'shippingMethod' => $_SESSION['shipping']['shippingMethod'],
            'shippingPrice' => $_SESSION['shipping']['shippingPrice'],
            'subtotal' => $_SESSION['basket']['totalPrice'],
            'totalPrice' => (int) ($_SESSION['totalPrice']),
            'totalItems' => $_SESSION['basket']['totalItem']
        ];
        $purchaseManager = New PurchaseManager();
        $purchase = new Purchase($dataPurchase);
        $purchaseManager->add($purchase);
        return $purchase;
    }

    public function getAllPurchase() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                $purchaseManager = new PurchaseManager();
                $res = $purchaseManager->getAll();
                $pendingPurchase = [];
                $deliveringPurchase = [];
                $passedPurchase = [];
                $canceledPurchase = [];
                foreach ($res as $purchase){
                    switch ($purchase->getState()){
                        case 'pending' :
                            array_push($pendingPurchase, $purchase);
                            break;
                        case 'delivering' :
                            array_push($deliveringPurchase, $purchase);
                            break;
                        case 'passed' :
                            array_push($passedPurchase, $purchase);
                            break;
                        case 'canceled' :
                            array_push($canceledPurchase, $purchase);
                            break;
                    }
                }
                require(VIEW . '/adventure-time-shop/admin/allPurchase.php');
            } else {
                header('Location: index.php?redirect=ATshop&action=login');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function getPurchase() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (isset($_GET['idPurchase'])) {
                $data = [
                    'idPurchase' => filter_input(INPUT_GET, 'idPurchase', FILTER_SANITIZE_NUMBER_INT),
                    'idUser' => $user->getIdUser()
                ];
                $purchaseManager = new PurchaseManager();
                $purchaseItemManager = new PurchaseItemManager();
                $purchase = new Purchase($data);
                if ($user->getIsAdmin() === 1) {
                    $purchaseManager->get($purchase);
                    $purchaseItems = $purchaseItemManager->get($purchase);
                    $items = [];
                    foreach ($purchaseItems as $purchaseItem) {
                        $itemManager = new ItemManager();
                        $res = $itemManager->getItem($purchaseItem->getIdItem());
                        array_push($items, $res[0]);
                    }
                    require(VIEW . '/adventure-time-shop/admin/purchase.php');
                } else {
                    $res1 = $purchaseManager->getUserPurchase($purchase);
                    if ($res1 === true) {
                        $purchaseItems = $purchaseItemManager->get($purchase);
                        $items = [];
                        foreach ($purchaseItems as $purchaseItem) {
                            $itemManager = new ItemManager();
                            $res2 = $itemManager->getItem($purchaseItem->getIdItem());
                            array_push($items, $res2[0]);
                        }
                        require(VIEW . '/adventure-time-shop/user/purchase.php');
                    } else {
                        $_SESSION['error'] = "<p>You cannot access to this page because the order your tried to see is not your order. "
                                . "That's bad, man! But you can go back to your <a href='index.php?redirect=ATshop&amp;action=getUser'>profile</a>"
                                . " and look into your own stuff.</p>";
                        require(VIEW . '/adventure-time-shop/error.php');
                    }
                }
                
            } else {
                $_SESSION['error'] = "<p>You need to put the id of the order if you want to see it. "
                        . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                require(VIEW . '/adventure-time-shop/error.php');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }
    
    public function updatePurchase(){
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                if (isset($_GET['idPurchase']) && isset($_GET['statePurchase'])) {
                    $data = [
                        'idPurchase' => filter_input(INPUT_GET, 'idPurchase', FILTER_SANITIZE_NUMBER_INT),
                        'state' => filter_input(INPUT_GET, 'statePurchase', FILTER_SANITIZE_NUMBER_INT)
                    ];
                    $purchaseManager = new PurchaseManager();
                    $purchase = new Purchase($data);
                    $purchaseManager->update($purchase);
                    header('Location: index.php?redirect=ATshop&action=getAllPurchase');
                } else {
                    $_SESSION['error'] = "<p>You need to put the id of the order if you want to see it. "
                            . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                    require(VIEW . '/adventure-time-shop/error.php');
                }
            } else {
                header('Location: index.php?redirect=ATshop&action=login');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function addPurchaseItem(Purchase $purchase) {
        $purchaseItems = [];
        for ($i = 0; $i < count($_SESSION['basket']['idItem']); $i++) {
            $dataPurchaseItem = [
                'idPurchase' => $purchase->getIdPurchase(),
                'idItem' => $_SESSION['basket']['idItem'][$i],
                'quantityItem' => $_SESSION['basket']['quantityItem'][$i],
                'priceItem' => $_SESSION['basket']['priceItem'][$i]
            ];
            $purchaseItemManager = new PurchaseItemManager();
            $purchaseItem = new PurchaseItem($dataPurchaseItem);
            $purchaseItemManager->add($purchaseItem);
            array_push($purchaseItems, $purchaseItem);
        }
        return $purchaseItems;
    }

    public function shipping() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($_SESSION['basket']['totalItem'] !== 0) {
                if (isset($_POST['shippingAddress']) && isset($_POST['billingAddress']) && isset($_POST['shippingMethod'])) {
                    if (!empty(trim($_POST['shippingAddress'])) && !empty(trim($_POST['billingAddress'])) && !empty(trim($_POST['shippingMethod']))) {
                        $shippingAddress = filter_input(INPUT_POST, 'shippingAddress', FILTER_SANITIZE_NUMBER_INT);
                        $billingAddress = filter_input(INPUT_POST, 'billingAddress', FILTER_SANITIZE_NUMBER_INT);
                        $shippingMethod = filter_input(INPUT_POST, 'shippingMethod', FILTER_SANITIZE_NUMBER_INT);
                        $_SESSION['shipping']['shippingAddress'] = $shippingAddress;
                        $_SESSION['shipping']['billingAddress'] = $billingAddress;
                        $_SESSION['shipping']['shippingMethod'] = $shippingMethod;
                        switch ($_SESSION['shipping']['shippingMethod']) {
                            case '1':
                                if ($_SESSION['basket']['totalPrice'] >= 50) {
                                    $shippingPrice = 0;
                                } else {
                                    $shippingPrice = 2;
                                }
                                break;
                            case '2':
                                $shippingPrice = 7;
                                break;
                            case '3':
                                $shippingPrice = 12;
                                break;
                        }
                        $_SESSION['shipping']['shippingPrice'] = $shippingPrice;
                        $_SESSION['totalPrice'] = (int) ($_SESSION['basket']['totalPrice'] + $shippingPrice);
                        $this->saveBasket($user);
                        require(VIEW . '/adventure-time-shop/user/payment.php');
                    } else {
                        echo 'tous les champs doivent être remplis';
                    }
                } else {
                    $addressManager = new AddressManager();
                    $res = $addressManager->getAll($user);
                    if ($user->getIsAdmin() === 1) {
                        require(VIEW . '/adventure-time-shop/admin/shipping.php');
                    } else {
                        require(VIEW . '/adventure-time-shop/user/shipping.php');
                    }
                }
            } else {
                $_SESSION['error'] = "<p>Your basket is empty right now. "
                        . "You can go back shopping, I'm sure you'll find something you like. "
                        . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                require(VIEW . '/adventure-time-shop/error.php');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function sendAdminEmail(Purchase $purchase) {
        if (isset($_SESSION['user'])) {
            $idPurchase = $purchase->getIdPurchase();
            $user = $_SESSION['user'];
            $to = 'fiamma.pellicane@gmail.com';
            $firstName = ucfirst($user->getFirstName());
            $lastName = ucfirst($user->getLastName());
            $idUser = $user->getIdUser();
            $subject = 'Congratulation! A new purchase has been sent!';
            $message = <<<EOD
            <div style="background:no-repeat top center;margin:0;padding:0">
                <a href="louna-mitsou.fr/index.php?redirect=ATshop">
                    <img src="https://78.media.tumblr.com/67c3bec55b8b93a58db3a03d9b61646e/tumblr_p8kkwmT8Ke1x3feeno1_1280.jpg" style="display:block;margin:auto;">
                </a>
                <div style="text-align:center">
                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#333333">Congratulations!</p>
                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#595959;line-height:20px">
                        User id no. #$idUser ($firstName $lastName) just made an order.<br/><br/>
                        Have a look on the order and prepare it quick!<br/><br/>
                        Don't forget to go on your profile and change the status when you will sent the order.<br/><br/>
                    </p>
                    <div class="purchase-confirmed-buttons" style="margin: 10px 0;">
                        <a href="louna-mitsou.fr/index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=$idPurchase"
                            style="padding: 10px 15px;margin: 20px;border-radius: 2px;background-color: #73bcdf;color: white;
                                font-weight: bold;text-decoration:none;">
                            View order
                        </a>
                        <a href="louna-mitsou.fr/index.php?redirect=ATshop&amp;action=getUser"
                            style="padding: 10px 15px;margin: 20px;border-radius: 2px;background-color: #73bcdf;color: white;
                                font-weight: bold;text-decoration:none;">
                            View profile
                        </a>
                    </div>
                    <br/>
                    <img src="https://media1.tenor.com/images/8373dd8b18dacf6292f73f004e2ac454/tenor.gif?itemid=8025388" alt="Yay Bmo Dancing"/>
                </div>
            </div>
EOD;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($to, $subject, $message, $headers);
        }
    }

    public function sendEmailConfirmation(Purchase $purchase) {
        if (isset($_SESSION['user'])) {
            $idPurchase = $purchase->getIdPurchase();
            $user = $_SESSION['user'];
            $to = $user->getEmail();
            $firstName = ucfirst($user->getFirstName());
            $lastName = ucfirst($user->getLastName());
            $subject = 'Your purchase no. #' . $idPurchase . ' is confirmed';
            $message = <<<EOD
            <div style="background:no-repeat top center;margin:0;padding:0">
                <a href="louna-mitsou.fr/index.php?redirect=ATshop">
                    <img src="https://78.media.tumblr.com/67c3bec55b8b93a58db3a03d9b61646e/tumblr_p8kkwmT8Ke1x3feeno1_1280.jpg" style="display:block;margin:auto;">
                </a>
                <div style="text-align:center">
                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#333333">Your purchase is confirmed</p>
                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#595959;line-height:20px">
                        Thank you so much for your order, $firstName.<br/><br/>
                        To make sure you haven't made any mistakes, you can have a look on your order<br/><br/>
                        To find out how fast your order is processed, your can check your profile.<br/><br/>
                    </p>
                    <div class="purchase-confirmed-buttons" style="margin: 10px 0;">
                        <a href="louna-mitsou.fr/index.php?redirect=ATshop&amp;action=getPurchase&amp;idPurchase=$idPurchase"
                            style="padding: 10px 15px;margin: 20px;border-radius: 2px;background-color: #73bcdf;color: white;
                                font-weight: bold;text-decoration:none;">
                            View your order
                        </a>
                        <a href="louna-mitsou.fr/index.php?redirect=ATshop&amp;action=getUser"
                            style="padding: 10px 15px;margin: 20px;border-radius: 2px;background-color: #73bcdf;color: white;
                                font-weight: bold;text-decoration:none;">
                            View your profile
                        </a>
                    </div>
                    <br/>
                    <img src="https://media1.tenor.com/images/8373dd8b18dacf6292f73f004e2ac454/tenor.gif?itemid=8025388" alt="Yay Bmo Dancing"/>
                </div>
            </div>
EOD;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($to, $subject, $message, $headers);
        }
    }

    public function payment() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if($_SESSION['basket']['totalItems'] !== 0){
                $stripeToken = filter_input(INPUT_POST, 'stripeToken', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $_SESSION['stripeToken'] = $stripeToken;
                $this->stripePayment($stripeToken);
                header('Location: index.php?redirect=ATshop&action=confirmationPayment');
            } else {
                $_SESSION['error'] = "<p>Your basket is empty right now. "
                        . "You can go back shopping, I'm sure you'll find something you like. "
                        . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
                require(VIEW . '/adventure-time-shop/error.php');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }
    
    public function confirmationPayment(){
        if (isset($_SESSION['user']) && isset($_SESSION['stripeToken'])) {
            $user = $_SESSION['user'];
            $purchase = $this->addPurchase($user);
            $this->sendEmailConfirmation($purchase);
            $this->sendAdminEmail($purchase);
            $purchaseItems = $this->addPurchaseItem($purchase);
            $items = [];
            foreach ($purchaseItems as $purchaseItem) {
                $itemManager = new ItemManager();
                $res = $itemManager->getItem($purchaseItem->getIdItem());
                array_push($items, $res[0]);
            }
            $this->resetBasket($user);
            unset($_SESSION['shipping']);
            unset($_SESSION['stripeToken']);
            require (VIEW . '/adventure-time-shop/user/purchaseConfirmation.php');
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function stripePayment($stripeToken) {
        require('vendor/autoload.php');
        $apiKey = require('configStripe.php');
        Stripe\Stripe::setApiKey($apiKey['key']);
        try {
            Stripe\Customer::create([
                'description' => 'customer',
                'source' => $stripeToken
            ]);
            $payment = \Stripe\Charge::create([
                        'amount' => (int) $_SESSION['totalPrice'] * 100,
                        'currency' => 'eur',
                        'source' => 'tok_visa'
            ]);
        } catch (\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $body = $e->getJsonBody();
            $err = $body['error'];

            print('Status is:' . $e->getHttpStatus() . "\n");
            print('Type is:' . $err['type'] . "\n");
            print('Code is:' . $err['code'] . "\n");
            // param is '' in this case
            print('Param is:' . $err['param'] . "\n");
            print('Message is:' . $err['message'] . "\n");
        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            echo $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            echo $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            echo $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            echo $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            echo $e->getMessage();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            echo $e->getMessage();
        }
    }

    public function getAllInstagramPosts() {
        if (isset($_SESSION['instagram'])) {
            $instagram = $_SESSION['instagram'];
            $res = $instagram->getUserMedia();
            return $res;
        } else {
            $this->authInsta();
        }
    }

    public function getInstagramPost() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                if (isset($_SESSION['instagram'])) {
                    $instagram = $_SESSION['instagram'];
                    if (isset($_GET['idInstagramPost'])) {
                        if (!empty(trim($_GET['idInstagramPost']))) {
                            $idInstagramPost = filter_input(INPUT_GET, 'idInstagramPost', FILTER_SANITIZE_SPECIAL_CHARS);
                            $res = $instagram->getMedia($idInstagramPost);
                            require(VIEW . '/adventure-time-shop/admin/instagramPost.php');
                        } else {
                            echo 'empty';
                        }
                    } else {
                        echo 'no id';
                    }
                } else {
                    $this->authInsta();
                }
            } else {
                header('Location: index.php?redirect=ATshop&action=login');
            }
        } else {
            header('Location: index.php?redirect=ATshop&action=login');
        }
    }

    public function getHome() {
        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = array();
            $_SESSION['basket']['idItem'] = array();
            $_SESSION['basket']['quantityItem'] = array();
            $_SESSION['basket']['priceItem'] = array();
            $_SESSION['basket']['totalItem'] = 0;
            $_SESSION['basket']['totalPrice'] = 0.00;
        }
        if (!isset($_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = array();
            $_SESSION['wishlist']['idItem'] = array();
            $_SESSION['wishlist']['totalItem'] = 0;
        }
        if (!isset($_SESSION['message'])) {
            $_SESSION['message'] = "";
        }
        if (!isset($_SESSION['image'])) {
            $_SESSION['image'] = "";
        }
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                $res = $this->getAllInstagramPosts();
                require(VIEW . '/adventure-time-shop/admin/home.php');
            } else {
                $res = $this->getAllItems();
                require(VIEW . '/adventure-time-shop/user/home.php');
            }
        } else {
            $res = $this->getAllItems();
            if (!empty($res)) {
                require(VIEW . '/adventure-time-shop/home.php');
            } else {
                require(VIEW . '/adventure-time-shop/home.php');
            }
        }
    }
    
    public function getError(){
        $_SESSION['error'] = "<h3>ERROR 404 : Page not found</h3>"
                . "<p>Dude, suckin' at something is the first step towards being sorta good at something. "
                . "<a href='index.php?redirect=ATshop'>Home</a> is where your heart is.</p>";
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getIsAdmin() === 1) {
                require(VIEW . '/adventure-time-shop/admin/error.php');
            } else {
                require(VIEW . '/adventure-time-shop/user/error.php');
            }
        } else {
            require(VIEW . '/adventure-time-shop/error.php');
        }
    }

    public function authInsta() {
        $instagram = new Instagram(array(
            'apiKey' => '912f24fae39c438a8cfe21b436d05e5d',
            'apiSecret' => '2cad35a21e6948819b38d8198fd0a7cd',
            'apiCallback' => 'http://www.louna-mitsou.fr/?redirect=ATshop'
        ));
        $code = $_GET['code'];
        if (isset($code)) {
            $data = $instagram->getOAuthToken($code);
            $instagram->setAccessToken($data);
            $_SESSION['instagram'] = $instagram;
            header('Location: http://www.louna-mitsou.fr/?redirect=ATshop');
        } else {
            if (isset($_GET['error'])) {
                echo 'An error occurred: ' . $_GET['error_description'];
            } else {
                header('Location: https://www.instagram.com/oauth/authorize/?client_id=912f24fae39c438a8cfe21b436d05e5d&redirect' .
                        '_uri=http://www.louna-mitsou.fr/?redirect=ATshop&response_type=code');
            }
        }
    }

}

// unset($_SESSION);
// session_destroy();
// utiliser ajax pour envoyer des infos pour ne charger qu'une partie de la page (exemple : pour mettre des articles dans le panier
// ajouter les items au panier ou à la wishlist
// s'occuper d'enregistrer le user dans une session
// authentification insta et récupération des données (authInsta dans le controller puis récupération des données avec un objet Instagram et affichage dans la vue)
// ajout d'une image aléatoire au profil de chaque utilisateur
// faire le menu utilisateur
// modification du profil utilisateur
// ajout d'une addresse dans le profil de l'utilisateur


// comment je fais pour récupérer un panier qui a été fait alors que la personne n'était pas connecté ?
// la personne fait son panier, puis quand elle veut procéder au checkout on lui demande de créer un compte
// elle crée son compte, reçoit un mail de confirmation puis clique sur le lien de validation et se connecte
// comment savoir que le panier qu'elle a fait lorsqu'elle n'était pas connecté est le sien ?