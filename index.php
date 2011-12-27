<?php

/**
*  index.php 
* 
*  Main page
* 
*  @author	Daniel VC
* 
*/

session_start();
require('./lib/conexionbd.lib.php');
require('./classes/user.php');

if ( $user->is_authorized() == true) {
    # OK. access granted
    require('index_lims.php');
} else {
    # login error.
    require('login.php');
}

?>
