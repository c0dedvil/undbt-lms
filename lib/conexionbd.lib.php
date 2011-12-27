<?php

/**
*  conexionbd.lib.php 
* 
*  database connection script
* 
*  @author	Daniel VC
* 
*/

    # Establish connection
    $bd = "antek_lims";
    $conn=mysql_connect("localhost", "limsuser", "q1w2e3r4")
        or die("$strErrConexion");
    # select database
	mysql_select_db($bd,$conn);
		
?>
