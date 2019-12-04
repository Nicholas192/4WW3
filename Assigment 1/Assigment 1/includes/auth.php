<?php

  function is_logged_in(){
    return (auth_get_user_id() > 0);
  }

  function auth_set_user($user_id, $logout = false) {
    setcookie('4ww3_auth',openssl_encrypt(ENCRYPTION_FRONT_PAD.$user_id,ENCRYPTION_METHOD,ENCRYPTION_KEY,$options=0,ENCRYPTION_IV),time()+($logout?-3600:2*60*60),'/');
  }

  function auth_get_user_id() {
try{
  if(!empty($_COOKIE['4ww3_auth'])){
    $user_id = substr(openssl_decrypt($_COOKIE['4ww3_auth'],ENCRYPTION_METHOD,ENCRYPTION_KEY,$options=0,ENCRYPTION_IV),30);
    return ($user_id > 0?$user_id:false);
  }
  }catch(Exception $e) {
    return false;
  }
  }

  function auth_logout() {
    auth_set_user(auth_get_user_id(),true);
  }

  if (is_logged_in()) {
    $auth_user = get_user(auth_get_user_id());
  }
