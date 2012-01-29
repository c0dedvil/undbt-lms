<?php

/**
*  header.inc 
* 
*  generic header por default pages
* 
*  @author	Daniel VC
* 
*/

echo "<head><title>LIMS << LABORATORY INFORMATION MANAGEMENT SYSTEM >> - [[ DEMO ]]</title>\n";
echo "<link href='./css/css01.css' rel='stylesheet' type='text/css' /></head>\n";
echo "<script src='./js/jquery.js'></script>\n";
echo "<table width='100%' border='0'>\n
      <tr><td width='40%'>";

echo "<a href='index.php'><img src='./img/logo.png' alt='LIMS :: UndBit.com [[ DEMO ]]' border='0'/></a>";

echo "</td>\n
<td width='30%'>&nbsp;</td><td width='30%' valign='top'><table width='100%' border='0'>\n
<tr><td align='right'>";

if ($user->is_authorized()) {
    if ( $_SESSION['userlog'] ) {
        echo "<p>USER LOG: <span class='logout'>ON</span></p>";
    } else {
        echo "<p>USER LOG: <span class='redalert'>OFF</span></p>";
    }
}

echo "</td></tr><tr><td align='right'>&nbsp;</td></tr><tr><td>&nbsp;</td>\n
</tr></table></td></tr></table>\n";

?>
