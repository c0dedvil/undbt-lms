<?php

/**
*  activate.php 
* 
*  users activation page
* 
*  @author	Daniel VC
* 
*/

session_start();

require_once('../classes/db.php');
require_once('../include/header2.inc');
require_once('../classes/user.php');

$odb->connect();

if (isset($_GET['activation_code'])) {
   
    $r = $user->user_activation($_GET['activation_code']);
    
    if (!$r) {
        # error. user hadn't been activated
        echo "<p class='redalert'>Error! Invalid activation code. User not activated.";
    } else {
        # To the teddy
        echo "<p class='redalert'>To the teddy! User successfully activated.";
    }    
    
} else {

    # activation code must be entered
    if (isset($_POST['activate'])) {
     
        $r = $user->user_activation($_POST['activation_code']);

        if (!$r) {
            # error. user hadn't been activated
            echo "<p class='redalert'>Error! Invalid activation code.";
        } else {
            # To the teddy
            echo "<p class='redalert'>To the teddy! User [".$r."] successfully activated.";
        }    

        echo "<p><a href='../index.php'>RETURN TO HOME</a></p>\n";
    
    } else {

        echo "<p class='txt02'>In case you have it, enter your activation code</p>\n";

        echo "<p><form name='frm' method='post' action='activate.php'>
        <table width='500' border='0'>
          <tr>
            <td width='30%' align='right'><b>ACTIVATION CODE :</b></td>
            <td width='70%'><input type='text' name='activation_code' size='50' /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align='right'><input type='submit' name='activate' value='Activate' /></td>
          </tr>
        </table>
        </form>";    
    }

}

$odb->close();

require('../include/footer2.inc');

?>
