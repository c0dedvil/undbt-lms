<?php

/**
*  footer.php 
* 
*  Generic footer for default pages
* 
*  @author	Daniel VC
* 
*/

if (isset($_SESSION['username'])) {

	echo "<table width='100%' border='0'>\n";
	echo "<tr><td colspan='8'><hr size='0' noshade='noshade' /></td></tr>\n";
	echo "<tr><td><center><a href='../index_lims.php'>Main Menu</a></center></td>\n";
	
	if ($_SESSION['nivel'] < 2) {
		echo "<td><center><a href='index.php'>Customers</a></center></td>\n";
		echo "<td><center><a href='../parameters/index.php'>Parameters</a></center></td>\n";
		echo "<td><center><a href='../regulations/index.php'>Regulations</a></center></td>\n";
	} else {
		echo "<td>&nbsp;</td>\n";
		echo "<td>&nbsp;</td>\n";
		echo "<td>&nbsp;</td>\n";
	}

	echo "<td align='center'><a href='../reports/index.php'>Reports</a></td>\n";
	echo "<td align='center'>\n";
	echo "<a href='../changepassword.php'>Change password</a></td>";
	echo "<td align='center'>\n";
	echo "<b>[ USER:</b> ".$_SESSION['username']." ]</td>\n";
	echo "<td align='right'>\n";
	echo "<a href='../logout.php'>Logout</a></td></tr></table>";

} else {
	
	echo "<table width='100%' border='0'>\n";
	echo "<tr><td><hr size='0' noshade='noshade' /></td></tr>\n";
	echo "<tr><td align='right'><a target='_blank' href='http://www.undbit.com'>Undbit.com Software Solutions</a> Daniel VC &copy; 2011</td></tr>\n";
	echo "</table>\n";

}

?>
