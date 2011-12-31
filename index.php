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

# db connection
require_once('./classes/db.php');
$odb->connect();

require_once('./classes/user.php');

if ($user->is_authorized()) {
    # echo "<p>OK. access granted";
    require('index_lims.php');
} else {
    # echo "<p>login error";
    require('login.php');
}

# close database
$odb->close();

?>
