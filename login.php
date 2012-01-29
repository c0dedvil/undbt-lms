<?php

/**
*  login.php 
* 
*  Main login page
* 
*  @author	Daniel VC
* 
*/

session_start();

require('./include/header.inc');

if($_SESSION['logout']) {
    echo "<p class='logout'>Logged out. Bye.";
}

# invalid user and/or password
if (isset($_POST['password'])) {
    if (!$_SESSION['authorized']) {
        if (!$_SESSION['active_account']) {
            echo "<p class='redalert'>Disabled account. Activate it using the link sent to your e-mail</p>\n";
            echo "<p class= 'txt02'>If have the activation code, enter <a class='link02' href='./users/activate.php'>here.</a></p>\n";
        } else {
            echo "<p class='redalert'>Login error. Enter a valid user and password.</p>\n";
        } # active_account
    } # authorized
} # post

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

<?php require('./include/footer.inc'); ?>
