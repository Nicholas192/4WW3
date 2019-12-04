<?php

    /*
        This file houses all functions related user authentication (excluding database calls)
    */



    // Function is_logged_in()
    // Returns boolean true/false if the user is logged in
    function is_logged_in(){
        return (auth_get_user_id() > 0);
    }



    // Function auth_set_user()
    // This function set the auth cookie to keep a user logged in during their session.
    // Keeps a user logged in for 2 hours
    // Will invalidate the cookie if $logout is set to true
    function auth_set_user($user_id, $logout = false) {
        setcookie('4ww3_auth',openssl_encrypt(ENCRYPTION_FRONT_PAD.$user_id,ENCRYPTION_METHOD,ENCRYPTION_KEY,$options=0,ENCRYPTION_IV),time()+($logout?-3600:2*60*60),'/');
    }



    // Function auth_get_user_id()
    // Checks the auth cookie for a valid user id and returns the id
    function auth_get_user_id() {

        // Try/catch incase something fails during the decryption
        try{
            // Check for the cookie to see if the user is logged in
            if(!empty($_COOKIE['4ww3_auth'])){

                // Decrypt the cookie
                $user_id = substr(openssl_decrypt($_COOKIE['4ww3_auth'],ENCRYPTION_METHOD,ENCRYPTION_KEY,$options=0,ENCRYPTION_IV),30);

                // Return the user_id only if the ID is greater than 0
                return (0 < $user_id?$user_id:false);
            }

        // If it fail, then the user isn't logged in
        }catch(Exception $e) {
            return false;
        }
    }



    // Function auth_logout()
    // Shortcut to logging out a user
    function auth_logout() {
        auth_set_user(auth_get_user_id(),true);
    }

    // Autoloads user's info into $auth_user so it can be used around the site
    if (is_logged_in()) {
        $auth_user = get_user(auth_get_user_id());
    }
