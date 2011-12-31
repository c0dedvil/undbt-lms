<?php

/**
*  index_lims.php 
* 
*  lims index user
* 
*  @author	Daniel VC
* 
*/

session_start();

require_once('./classes/user.php');
require('./include/header.php');

if ( $user->is_authorized() == true) {
	
	echo "<h2>MAIN MENU</h2>\n
	<table width='400' border='0'>\n";

	// si el usuario no es un analista
	if ($_SESSION['nivel'] < 2) {
		echo "<tr><td width='394'><a href='./customers/index.php'>CUSTOMERS</a></td></tr>\n";
	}

	if ($_SESSION['nivel'] < 2) {
		echo "<tr><td><a href='index_parametro.php'>PARAMETERS</a></td></tr>\n";
	}

	if ($_SESSION['nivel'] < 2) {
		echo "<tr><td><a href='index_normas.php'>REGULATIONS</a></td></tr>\n";
	}

	if ($_SESSION['nivel'] < 2) {
		echo "<tr><td><a href='index_grupos_analistas.php'>ANALYSTS GROUPS ADMINISTRATION</a></td></tr>\n";
	}
	
	echo "<tr><td><a href='index_formato.php'>LAB REPORTS</a></td></tr>\n";
	
	# --- ADMIN MENU ---
	if ($_SESSION['nivel'] == 1) {
	    echo "<tr><td>&nbsp;</td></tr><tr><td><hr size='0' noshade='noshade' /></td></tr><tr><td>&nbsp;</td></tr>\n";
	    echo "<tr><td class='adm_title'>ADMIN MENU</td></tr>\n";
	    echo "<tr><td><a clas='link_adm' href='./users/register_new_user.php'>REGISTER A NEW USER</a></td></tr>\n";
	}	
	# --- END ADMIN MENU ---
	
	echo "</table><p>&nbsp;\n";
	
	require('./include/footer.php');
} else {
	require('index.php');
}

?>
