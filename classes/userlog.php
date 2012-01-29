<?php

/**
*  userlog.php 
* 
*  user log activities class definition
* 
*  @author	Daniel VC
* 
*/

# log user activity switch
define("LOG_USER_ACT", false);

class userlog {

    # userlog constructor method
    function userlog() {
        if($_SESSION['authorized'] && isset($_SESSION['username'])) {   
            $this->user = $_SESSION['username'];
            $this->ipaddr = $_SERVER['REMOTE_ADDR'];            
        }
        
        if ( LOG_USER_ACT ) {
            $_SESSION['userlog'] = true;
            $this->logactive = true;
        } elseif ( ! LOG_USER_ACT ) {
            $_SESSION['userlog'] = false;
            $this->logactive = false;
        }            
        
    } # end constructor method

    # register event user log
    function reg_log($p_activity,$p_acttype,$p_module) {
    
        $this->activity = $p_activity;
        $this->act_type = $p_acttype;
        $this->module = $p_module;
        
        # $this->timestamp = date("Y-m-d H:i:s.u") . substr((string)microtime(), 1, 8);
        $this->timestamp = date("Y-m-d H:i:s");
               
        $sql = sprintf("INSERT INTO lms_log (c_user, c_ip_address, t_activity, n_activity_type, c_module, d_timestamp) " .
                         "VALUES ( %s, %s, %s, %d, %s, %s)",
                         $this->quote_smart( $this->user ),
                         $this->quote_smart( $this->ipaddr ),
                         $this->quote_smart( $this->activity ),
                         $this->quote_smart( $this->act_type ),
                         $this->quote_smart( $this->module ),
                         $this->quote_smart( $this->timestamp) );
                                 
        if ( $this->logactive ) {
            # store log into database
            mysql_query($sql);
        } else {
            # display sql insert
            echo "<p>SLQ LOG INSERT: ".$sql;
        }                
        
    } # end register event user log

    # safety Quote smart
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
}

# create userlog object
$userlog = new userlog();

?>
