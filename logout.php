<?php

/**
*  logout.php 
* 
*  logout script
* 
*  @author	Daniel VC
* 
*/

function goout() {
    return "Location: index.php?exit=true";
}

session_start();
require_once('./classes/user.php');
$user->user_logout();
$_SESSION['usuario'] = NULL;
header(goout());

?>
