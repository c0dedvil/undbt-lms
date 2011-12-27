<?php

/**
*  login.php 
* 
*  Main login page
* 
*  @author	Daniel VC
* 
*/

require('./include/header.php');
session_start();

if ($_GET['exit'] == true) {
    echo "<p class='logout'>Logged out. ".$_SESSION['authorized']."\n";
}

/*
# logged out
if ($_SESSION['loggedout'] == true) {
    echo "<p class='logout'>Logged out. ".$_SESSION['authorized']."\n";
    $_SESSION['loggedout'] = false;
}
*/

# invalid user and/or password
if (isset($_POST['password']) && $_SESSION['authorized'] == false) {
    echo "<p class='redalert'>Login error. Enter a valid user and password.</p>\n";
}

?>

<form name="frm" method="post" action="index.php">
<table width="25%" border="0">
  <tr>
    <td width="40%" align="right"><b>USER :</b></td>
    <td width="60%"><input type="text" name="username"/></td>
  </tr>
  <tr>
    <td align="right"><b>PASSWORD :</b></td>
    <td><input type="password" name="password"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input type="submit" name="entrar" value="Login" /></td>
  </tr>
</table>
</form>

<?php require('./include/footer.php'); ?>
