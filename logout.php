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
#require('./include/header.php');
#echo "<p><a href='index.php'>Ingresar de nuevo</a>\n";
# require('login.php');
header(goout());
#echo "<p class='logout'>Logged out. ".$_SESSION['authorized']."\n";
#require('./include/footer.php');

?>
