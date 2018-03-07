<?php
session_start();
if($_POST['id'] == 'offer_5') {
   if(!$_SESSION['user_denied']) {
       $_SESSION['user_denied'] = '1';
    } 
}  else {
    setcookie('user_denied', '1', time()+3600 * 24 * 365);
}
