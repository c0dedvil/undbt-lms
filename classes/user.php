<?php

/**
*  user.php 
* 
*  user class definition
* 
*  @author	Daniel VC
* 
*/

class user {

    // constructor method
    function user() {
        if( isset( $_POST['username'] ) && isset( $_POST['password'] ) )
        {   
            $this->mysql_bind(); }
        else if ( isset( $_GET['logout'] ) ) {
            $this->logout();
        }
    }

    // user authorized
    function is_authorized() {
        
        # check if is an active account
        if ($_SESSION['authorized'] && ! $_SESSION['active_account']) {
            $_SESSION['authorized'] = false;
            unset($_SESSION['username']);
        }
        
        $_SESSION['ipaddr'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['logout'] = false;
        return $_SESSION['authorized'];        
    }

    // bind mysql server
    function mysql_bind() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = sprintf("SELECT * FROM lms_users " .
                         "WHERE username = %s AND password = MD5( %s )",
                         $this->quote_smart( $username),
                         $this->quote_smart( $password) );        
        $result = mysql_query( $query );
        $user_data = mysql_fetch_assoc( $result );

        // if user exists in database
        if( mysql_num_rows( $result ) == 1 ) {
            $_SESSION['authorized'] = true;
            $_SESSION['loggedout'] = false;
            $_SESSION['idusuario']   = $user_data['id'];
            $_SESSION['username']   = $user_data['username'];
            $_SESSION['nivel'] = $user_data['nivel'];
            $_SESSION['area'] = $user_data['area'];
            
            $this->username = $user_data['username'];
            $this->pwd_md5 = $user_data['password'];

            // check whether user account is activated
            if( isset( $user_data['activation_hash'] ) ) {
                $_SESSION['active_account'] = false; // exists hash activation. disabled account
            } else {
                $_SESSION['active_account'] = true;  // there's no activation hash. It's an active account
            }

        // user account not found in database
        } else {
            $_SESSION['authorized'] = false;
        }
    }
    
    # check if an user is active
    function check_if_active() {
    
        $sql = sprintf("SELECT * FROM lms_users " .
                "WHERE username = %s AND password = MD5( %s )",
                $this->quote_smart( $username),
                $this->quote_smart( $password) );        
        
        $rst = mysql_query($sql);
        $ud = mysql_fetch_assoc($rst);
        
        // check whether user account is activated
        if( ! isset( $ud['activation_hash'] ) ) {
            # $_SESSION['active_account'] = false; // exists hash activation. disabled account
            return true;
        } else {
            # $_SESSION['active_account'] = true;  // there's no activation hash. It's an active account
            return false;
        }

    }

    // create new user account
    function user_create($username,$email,$password,$nivel,$area) {

        /*
        if( $this->is_username_available($username) == false ) {
            return false;
        }
        */
       
        // create an activation hash
        $activation_hash = md5( $username . $password . time() );
        
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->activation_hash = $activation_hash;

		// add username, password, email and activation hash to users table
        $query = sprintf("INSERT INTO lms_users (username,password,email,activation_hash,nivel,area) " .
                         "VALUES ( %s, MD5( %s ), %s, %s )",
                         $this->quote_smart( $this->username ),
                         $this->quote_smart( $this->password ),
                         $this->quote_smart( $this->email ),
                         $this->quote_smart( $this->activation_hash ) );
        
        mysql_query( $query );
        echo "<p>USER INSERT SQL: ".$query;

        # $this->user_activation_message( $username );

        return true;
    }

    function user_activation_message($username) {
    
        // send a message to the user's email account with a verification link
		$subject = 'LIMS user activation for user ' . $username;
   
        // header of verification email
        $header  = 'From: noreply@undbtlims.com' . "\r\n" .
                   'Reply-To: lims@undbtlims.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
   
        // verification email body
        $verification_message =
        "$this->username,\n\n" .
		"Please visit the following link to activate your user account.\n\n" .
        "http://localhost/nlims/users/activate.php?activation_code=" . $this->activation_hash . "\n";
   
        // send the message
        mail( $this->email, $subject, $verification_message, $header );
                
    }

    # activate a blocked user account
    function user_activation($activation_hash) {
    
        # check whether the activation hash is valid
        $sql = sprintf("SELECT username FROM lms_users WHERE activation_hash= %s",
                         $this->quote_smart($activation_hash) );
        $rst = mysql_query($sql);

        # finish if the activation hash is not valid
        if( mysql_num_rows($rst) != 1 ) {
            return false;
        }

		# remove the activation hash from the table if is valid
        $ud = mysql_fetch_assoc($rst);
        $sql = sprintf("UPDATE lms_users SET activation_hash=NULL WHERE activation_hash = %s",
                         $this->quote_smart($activation_hash));
        mysql_query($sql);
        # get the username previously associated with this activation hash, return it
        return $ud['username'];
    }

    // change user password
    function user_password_change($username,$password_old,$password_new) {
        $query = sprintf("SELECT username FROM lms_users WHERE username = %s AND password = MD5( %s )",
                         $this->quote_smart( $username ),
                         $this->quote_smart( $password_old) );
        $result = mysql_query( $query );
        if( mysql_num_rows( $result ) != 1 ) {
            return false;
        }
        $query = sprintf("UPDATE lms_users SET password = MD5( %s ) WHERE username = %s",
                         $this->quote_smart( $password_new ),
                         $this->quote_smart( $username ) );
        mysql_query( $query );
    }
   
    // finish current session
    function logout() {
        
        # free all session variables
        session_unset();
        
        $_SESSION['authorized'] = false;
        $_SESSION['logout'] = true;
                
    }

    // is the requested user available?
    function is_username_available($username) {
        if(empty($username)) {
            return false;
        }
        $query = sprintf("SELECT username FROM lms_users WHERE username=%s", $this->quote_smart( $username ) );
        $result = mysql_query( $query );
        if( mysql_num_rows( $result ) == 0 ) {
            return true;
        } else {
            return false;
        }
    }

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
}

// create user object
$user = new user();

?>
