<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('ROOT', realpath('Controller/Rooter.php'));
define('CONTROLLER', realpath('Controller/Controller.php'));
define('MODEL', realpath('Model/'));
define('VIEW', realpath('View/'));

require ROOT;

$dispatcher = new Rooter();