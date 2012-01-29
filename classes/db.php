<?php

/**
*  db.php 
* 
*  database class definition
* 
*  @author	Daniel VC
* 
*/

class db {

    # constructor customer method
    function __construct() {    
        $this->host = 'localhost';
        $this->user = 'limsuser';
        $this->pwd = 'q1w2e3r4';
        $this->bd = 'demo_lims';        
    }
    
    # connect to database
    function connect() {
        $this->conn = mysql_pconnect($this->host, $this->user, $this->pwd)
            or die("$strErrConexion");
        # select database
	    mysql_select_db($this->bd);
    }
    
    # close database connection
    function close() {
        mysql_close($this->conn);
    }
    
} # end db class definition

// create db object
$odb = new db();

?>
