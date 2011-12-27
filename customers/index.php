<?php

/**
*  clientes/index.php 
* 
*  customers index
* 
*  @author	Daniel VC
* 
*/

session_start();
require_once('../classes/user.php');
require('../include/header2.php');

echo "<h2>CUSTOMERS</h2>
<table width='300' border='0'>
<tr><td><a href='add_customer.php'>ADD CUSTOMER</a></td></tr>
<tr><td><a href='browse_cliente.php'>BROWSE CUSTOMERS</a></td></tr>
<tr><td><a href='select_cliente_edit.php'>EDIT CUSTOMER INFORMATION</a></td></tr>
<tr><td><a href='../index.php'>BACK</a></td></tr></table>
<p>&nbsp;</p>";

require('../include/footer2.php');

?>
