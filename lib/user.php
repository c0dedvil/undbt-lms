<?php

/**
*  user.php 
* 
*  user class definitions
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
            $this->user_logout();
        }
    }

    // user authorized
    function is_authorized() {
        return $_SESSION['authorized'];
    }

    // bind mysql server
    function mysql_bind() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = sprintf("SELECT username, activation_hash FROM auth_users " .
                         "WHERE username = %s AND password = MD5( %s )",
                         $this->quote_smart( $username),
                         $this->quote_smart( $password) );        
        $result = mysql_query( $query );
        $user_data = mysql_fetch_assoc( $result );

        // if user exists in database
        if( mysql_num_rows( $result ) == 1 ) {
            $_SESSION['authorized'] = true;
            $_SESSION['username']   = $username;

            // check whether user account is activated
            if( ! isset( $user_data['activation_hash'] ) ) {
                $_SESSION['active_account'] = false; // exists hash activation. disabled account
            } else {
                $_SESSION['active_account'] = true;  // there's no activation hash. It's an active account
            }

        // user account not found in database
        } else {
            $_SESSION['authorized'] = false;
        }
    }

    // create new user account
    function user_create($username,$email,$password) {

        if( $this->is_username_available($username) == false ) {
            return false;
        }

        // create an activation hash
        $activation_hash = md5( $username . $password . time() );

		// add username, password, email and activation hash to users table
        $query = sprintf("INSERT INTO auth_users (username,password,email,activation_hash) " .
                         "VALUES ( %s, MD5( %s ), %s, %s )",
                         $this->quote_smart( $username ),
                         $this->quote_smart( $password ),
                         $this->quote_smart( $email ),
                         $this->quote_smart( $activation_hash ) );
        mysql_query( $query );

        $this->user_activation_message( $username );

        return true;
    }

    function user_activation_message($username) {

        // get activation hash of this user account
        $query = sprintf("SELECT activation_hash, email FROM auth_users WHERE username = %s ",
                         $this->quote_smart( $username ) );
        $result = mysql_query( $query );
        $user_data = mysql_fetch_assoc( $result );

        // send a message to the user's email account with a verification link
		$subject = 'Activacion de cuenta en el LIMS de Antek para ' . $username;
   
        // header of verification email
        $header  = 'From: activacionlims@anteksa.com' . "\r\n" .
                   'Reply-To: danielvilla@anteksa.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
   
        // verification email body
        $verification_message =
        "{$username},\n\n" .
		"Por favor visite el link a continuacion para activar su cuenta.\n\n" .
        "http://lims.antek.ath.cx/?activation_code=" . $user_data['activation_hash'] . "\n";
   
        // send the message
        mail( $user_data['email'], $subject, $verification_message, $header );
    }

    // activate a blocked user account
    function user_activation($activation_hash) {
        // check whether the activation hash is valid
        $query = sprintf("SELECT username FROM auth_users WHERE activation_hash= %s",
                         $this->quote_smart($activation_hash) );
        $result = mysql_query( $query );

        // finish if the activation hash is not valid
        if( mysql_num_rows( $result ) != 1 ) {
            return false;
        }

		// remove the activation hash from the table if is valid
        $user_data = mysql_fetch_assoc( $result );
        $query = sprintf("UPDATE auth_users SET activation_hash=NULL WHERE activation_hash = %s",
                         $this->quote_smart( $activation_hash ) );
        mysql_query( $query );
        // get the username previously associated with this activation hash, return it
        return $user_data['username'];
    }

    // change user password
    function user_password_change($username,$password_old,$password_new) {
        $query = sprintf("SELECT username FROM auth_users WHERE username = %s AND password = MD5( %s )",
                         $this->quote_smart( $username ),
                         $this->quote_smart( $password_old) );
        $result = mysql_query( $query );
        if( mysql_num_rows( $result ) != 1 ) {
            return false;
        }
        $query = sprintf("UPDATE auth_users SET password = MD5( %s ) WHERE username = %s",
                         $this->quote_smart( $password_new ),
                         $this->quote_smart( $username ) );
        mysql_query( $query );
    }
   
    // finish current session
    function user_logout() {
        $_SESSION['authorized'] = false;
    }

    // is the requested user available?
    function is_username_available( $username ) {
        if( $username == '' ) {
            return false;
        }
        $query = sprintf("SELECT username FROM auth_users WHERE username=%s", $this->quote_smart( $username ) );
        $result = mysql_query( $query );
        if( mysql_num_rows( $result ) == 0 ) {
            return true;
        } else {
            return false;
        }
    }

    // safety Quote smart
    function quote_smart($value)
    {
       // Stripslashes
       if (get_magic_quotes_gpc()) {
           $value = stripslashes($value);
       }
	   // Quote if isn't a number or a string
       if (!is_numeric($value)) {
           $value = "'" . mysql_real_escape_string($value) . "'";
       }
       return $value;
   }
}

// create user object
$user = new user();

?>
