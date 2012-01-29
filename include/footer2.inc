<?php

/**
*  footer2.inc 
* 
*  Generic footer for default pages
* 
*  @author	Daniel VC
* 
*/

if ($user->is_authorized()) {

	echo "<table width='100%' border='0'>\n";
	echo "<tr><td colspan='10'><hr size='0' noshade='noshade' /></td></tr>\n";
	echo "<tr><td width='80'><center><a href='../index.php'>Main Menu</a></center></td>\n";
	
	if ($_SESSION['nivel'] < 2) {
		echo "<td width='80'><center><a href='../customers/index.php'>Customers</a></center></td>\n";
		echo "<td width='80'><center><a href='../parameters/index.php'>Parameters</a></center></td>\n";
		echo "<td width='80'><center><a href='../regulations/index.php'>Regulations</a></center></td>\n";
	} else {
		echo "<td>&nbsp;</td>\n";
		echo "<td>&nbsp;</td>\n";
		echo "<td>&nbsp;</td>\n";
	}

	echo "<td align='center' width='80'><a href='../reports/index.php'>Reports</a></td>\n";
	echo "<td align='center' width='120'>\n";
	echo "<a href='../users/changepassword.php'>Change password</a></td>";
	echo "<td align='center' width='150'>\n";
	echo "<b>[ USER:</b> ".$_SESSION['username']." ]</td>\n";
	echo "<td width='300'>CUR.DIR: ".getcwd()."</td>\n";
	echo "<td align='center' width='150'>IP ADDRESS: ".$_SESSION['ipaddr']."</td>";
	echo "<td align='right'>\n";
	echo "<a href='../logout.php'>Logout</a></td></tr></table>";

} else {
	
	echo "<table width='100%' border='0'>\n";
	echo "<tr><td colspan='3'><hr size='0' noshade='noshade' /></td></tr>\n";
	echo "<tr><td align='right' width='55%'>CUR.DIR: ".getcwd()."</td>\n";
	echo "<td align='right' width='20%'>IP ADDRESS: ".$_SERVER['REMOTE_ADDR']."</td>";
	echo "<td align='right' width='25%'><a target='_blank' href='http://www.undbit.com'>Undbit.com Software Solutions</a> Daniel VC &copy; 2011</td></tr>\n";
	echo "</table>\n";

}

?>
