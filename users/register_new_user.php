<?php

/**
*  users/register_new_user.php 
* 
*  register new lims user
* 
*  @author	Daniel VC
* 
*/

session_start();
require_once('../classes/db.php');
require_once('../classes/user.php');
require_once('../include/header2.inc');

?>

<p class='adm_title'>REGISTER NEW USER</p>

<?php

	if (isset($_POST['signup'])) {
	
	    $odb->connect();
	    
	    if ($user->is_username_available($_POST['username'])) {
	        if ($user->user_create($_POST['username'],$_POST['email'],$_POST['pwd'],$_POST['nivel'],$_POST['area'])) { 
       	        echo "<p class='logout'>User [".$_POST['username']."] has been created.";
       	    } else {
       	        echo "<p class='redalert'>Error. Unable to create user [".$_POST['username']."].";
       	    }
	    } else {
	        echo "<p class='redalert'>Error! User name [".$_POST['username']."] already used.";
	    }
	    
	    $odb->close();
	}	
	
?>

<form name="form" method="post" action="register_new_user.php">
  <table width="30%" border="0" cellpadding="0" cellspacing="5">
    <tr>
      <td width="30%"><div align="right"><b>USER NAME:</b> </div></td>
      <td width="70%"><input name="username" type="text" id="username" size="20" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" />      
    </tr>
    <tr>
      <td><div align="right"><b>E-MAIL :</b> </div></td>
      <td><input name="email" type="text" id="email" size="30" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" />
    </tr>
    <tr>
      <td><div align="right"><b>PASSWORD :</b></div></td>
      <td><input name="pwd" type="password" id="pwd" size="20" /></td>
    </tr>
	<tr>
	<tr>
      <td align="right"><b>NIVEL :</b></div></td>
      <td>
        <select name="nivel" id="nivel">
          <option value="1">Administrator</option>
          <option value="2">Supervisor</option>
          <option value="3">Area Chief</option>
          <option value="4" selected="selected">Normal User</option>
        </select>
      </td>
    </tr>
    <tr class="areasec">
      <td align="right"><b>AREA :</b></td>
      <td>
        <select name="area" id="area">
          <option value="" selected="selected">Select area ...</option>
          <option value="fq">Fisicoquimico</option>
          <option value="aa">Absorcion Atomica</option>
          <option value="mb">Microbiologia</option>
          <option value="gq">Geoquimica</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
	  <td><hr size="0" noshade="noshade" />
	</tr>    
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="signup" value="Sign Up" /> <input align="right" type="reset" name="clear" value="Reset" /></td>
    </tr>
      <td colspan='2' align='right'><a href='../index.php'>Back</a></td>
    <tr>
    </tr>
  </table>
</form>

<?php 

# js handler
echo "<script src='../js/reguser.js'></script>\n";

require_once('../include/footer2.inc');

?>
