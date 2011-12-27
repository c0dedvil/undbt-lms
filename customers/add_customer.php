<?php

/**
*  clientes/add_customer.php 
* 
*  add customer to database
* 
*  @author	Daniel VC
* 
*/

session_start();
require_once('../classes/user.php');
require('../include/header2.php');

?>

<h2>CUSTOMER INFORMATION</h2>

<?php

	if (isset($_POST['save'])) {
	    require('../classes/customer.php');
		        
        # check nit number
        if ($ocustomer->check_nit($_POST['nit'])) {
            # echo "<p class='logout'>OK! correct NIT. Customer can be saved.";
            $ocustomer->save_customer();
        } else {
            echo "<p class='redalert'>Error. Nit ".$ocustomer->nit." used by ".$ocustomer->empresa;
        }
        
        # show nit error        
        if($ocustomer->error_nit) echo "<p class='redalert'>ERROR NIT!";
	}
	
?>

<form name="form" method="post" action="add_customer.php">
  <table width="40%" border="0" cellpadding="0" cellspacing="5">
    <tr>
      <td width="30%"><div align="right"><b>COMPANY NAME:</b> </div></td>
      <td width="70%"><input name="empresa" type="text" id="empresa" size="40" value="<?php echo isset($_POST['empresa']) ? $_POST['empresa'] : '' ?>" />
      <span class='redalert'> *</span></td>
    </tr>
    <tr>
      <td><div align="right"><b>NIT :</b> </div></td>
      <td><input <?php echo ($ocustomer->error_nit) ? "class='input_error'" : '' ?> name="nit" type="text" id="nit" size="20" value="<?php echo isset($_POST['nit']) ? $_POST['nit'] : '' ?>" />
      <span class='redalert'> *</span></td>
    </tr>
    <tr>
      <td><div align="right"><b>CONTACT :</b></div></td>
      <td><input name="contacto" type="text" id="contacto" size="40" value="<?php echo isset($_POST['contacto']) ? $_POST['contacto'] : '' ?>" /></td>
    </tr>
    <tr>
      <td><div align="right"><b>JOB POSITION :</b></div></td>
      <td><input name="cargo" type="text" id="cargo" size="20" value="<?php echo isset($_POST['cargo']) ? $_POST['cargo'] : '' ?>" /></td>
    </tr>
    <tr>
      <td><div align="right"><b>ADDRESS :</b></div></td>
      <td><input name="direccion" type="text" id="direccion" size="30" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>" /></td>
    </tr>
    <tr>
      <td><div align="right"><b>TELEPHONE(S) :</b></div></td>
      <td><input name="telefono" type="text" id="telefono" size="20" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : '' ?>" /></td>
    </tr>
    <tr>
      <td><div align="right"><b>FAX :</b></div></td>
      <td><input name="fax" type="text" id="fax" size="20"  value="<?php echo isset($_POST['fax']) ? $_POST['fax'] : '' ?>" /></td>
    </tr>
    <tr>
      <td><div align="right"><b>E-MAIL :</b></div></td>
      <td><input name="email" type="text" id="email" size="30" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" /></td>
    </tr>

    <tr>
      <td><div align="right"><b>CITY :</b></div></td>
      <td><input name="ciudad" type="text" id="ciudad" size="20" value="<?php echo isset($_POST['ciudad']) ? $_POST['ciudad'] : '' ?>" /></td>
    </tr>    
    <tr>
      <td><div align="right"><b>QUOTATION :</b></div></td>
      <td><input name="cotizacion" type="text" id="cotizacion" size="20" value="<?php echo isset($_POST['cotizacion']) ? $_POST['cotizacion'] : '' ?>" /></td>
    </tr>    
    <tr>
      <td><div align="right"><b>DATA QUOTATION :</b></div></td>
      <td><input name="feccotizacion" type="text" id="feccotizacion" size="20" value="<?php echo isset($_POST['feccotizacion']) ? $_POST['feccotizacion'] : '' ?>" />
      <span class='bluehint'> [yyyy/mm/dd]</span></td>
    </tr>    
     <tr>
      <td><div align="right"><b>CONTRACT :</b></div></td>
      <td><input name="contrato" type="text" id="contrato" size="20" value="<?php echo isset($_POST['contrato']) ? $_POST['contrato'] : '' ?>" /></td>
    </tr>    
    <tr>
      <td><div align="right"><b>DATA CONTRACT :</b></div></td>
      <td><input name="feccontrato" type="text" id="feccontrato" size="20" value="<?php echo isset($_POST['feccontrato']) ? $_POST['feccontrato'] : '' ?>" />
      <span class='bluehint'> [yyyy/mm/dd]</span></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
	  <td><hr size=\"0\" noshade=\"noshade\" />
	</tr>    
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="save" value="Save Customer" /> <input align="right" type="reset" name="clear" value="Clear Values" /></td>
    </tr>
      <td colspan='2' align='right'><a href='index.php'>Back</a></td>
    <tr>
    </tr>
  </table>
</form>

<?php require('../include/footer2.php'); ?>
