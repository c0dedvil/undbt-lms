<?php

/**
*  customer.php 
* 
*  customer class definition
* 
*  @author	Daniel VC
* 
*/

class customer {

    # constructor customer method
    function __construct() {    
        $this->error_nit = false;    
    }

    # get data from html form
    function get_from_form() {
    
        $this->empresa = $_POST['empresa'];
        $this->nit = $_POST['nit'];
        $this->contacto = $_POST['contacto'];
        $this->cargo = $_POST['cargo'];
        $this->direccion = $_POST['direccion'];
        $this->telefono = $_POST['telefono'];
        $this->fax = $_POST['fax'];
        $this->ciudad = $_POST['ciudad'];
        $this->email = $_POST['email'];
        $this->contrato = $_POST['contrato'];
        $this->feccontrato = $_POST['feccontrato'];
        $this->cotizacion = $_POST['cotizacion'];
        $this->feccotizacion = $_POST['feccotizacion'];
    
    } # end get_from_form function
    
     # check if nit exists in database
    function check_nit($pnit) {
    
        require('../lib/conexionbd.lib.php');    
    
        #$sql = sprintf("SELECT * FROM lms_clientes WHERE nit = '%s'",mysql_real_escape_string($pnit));
        $sql = sprintf("SELECT * FROM lms_clientes WHERE nit = '%s'",$this->quote_smart($pnit));
        
        #echo "<p>SQL: ".$sql;
        
        $rst = mysql_query($sql);
        $nr = mysql_num_rows($rst);
        if ($nr > 0) {            
            while ($row = mysql_fetch_assoc($rst)) {
                $this->empresa = $row['empresa'];
                $this->nit = $row['nit'];
            }                       
            $this->error_nit = true;
            $reply = false;
        } else {            
            $reply = true;
        }
        
        return $reply;               
        mysql_close($conn);        
            
    } # end check_nit function
    
    # save customer on database
    function save_customer() {
    
        # get data from the form
        $this->get_from_form();
        
        require('../lib/conexionbd.lib.php');
        
        $sql = "INSERT INTO lms_clientes (empresa,nit,solicitante,cargo,";
		$sql.= "direccion,telefono,fax,ciudad,email,cotizacion,feccotizacion,contrato,feccontrato) ";
		$sql.= "VALUES('$this->empresa','$this->nit','$this->contacto','$this->cargo',";
		$sql.= "'$this->direccion','$this->telefono','$this->fax','$this->ciudad','$this->email', ";
		$sql.= "'$this->cotizacion','$this->feccotizacion','$this->contrato','$this->feccontrato')";
		
		# echo "<p>INSERT SQL: ".$sql;
		
		if (!mysql_query($sql,$conn))
		{
			die('Error: ' . mysql_error());
		}
		echo "<p class='logout'>Customer added successfully to database.</p>";

		mysql_close($conn);        
    
    } # end save_customer method
    
    // safety Quote smart
    function quote_smart($value) {
    
       // Stripslashes
       if (get_magic_quotes_gpc()) {
           $value = stripslashes($value);
       }
	   // Quote if isn't a number or a string
       if (!is_numeric($value)) {
           $value = "'" . mysql_real_escape_string($value) . "'";
       }
       return $value;
       
    } # end quote_smart function         
    
} # end customer class definition

// create customer object
$ocustomer = new customer();

?>
