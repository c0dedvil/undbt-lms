<?php

/**
*  logout.php 
* 
*  logout script
* 
*  @author	Daniel VC
* 
*/

session_start();
require_once('./classes/db.php');

$odb->connect(); # connect to db

# log the user operation
include_once('./classes/userlog.php');
echo "<p>LOG_USER_ACT: ".LOG_USER_ACT;
$actlog = 'Logged out the LIMS';
$userlog->reg_log($actlog, 0, 'logout');

require_once('./classes/user.php');
$user->logout();

# close database
$odb->close();

require('login.php');

?>
