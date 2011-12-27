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
require('./lib/conexionbd.lib.php');
require_once('./classes/user.php');

if ( $user->is_authorized() == true) {

	require('./include/header.php');
	
	/*
	echo "<p>NIVEL : ".$_SESSION['nivel']."<p>\n";
	echo "<p>AREA : ".$_SESSION['area']."<p>\n";
	echo "<p>USUARIO : ".$_SESSION['username']."<p>\n";
	*/
	
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
	echo "</table><p>&nbsp;</p>\n";
	//echo "<p>Bienvenido ".$_SESSION['usuario'];
	require('./include/footer.php');
} else {
	require('index.php');
}

mysql_close($conn);

?>
