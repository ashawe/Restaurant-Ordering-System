<?php

require 'db/debug-functions.php';

session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy(); 

// @ToDo : clear cookies
if (isset($_COOKIE['order_id'])) {
    unset($_COOKIE['order_id']); 
    setcookie('order_id', null, time() -3000, '/');
}
if (isset($_COOKIE['cart'])) {
    unset($_COOKIE['cart']); 
    setcookie('cart', null, time() -3000, '/');
}

header('Location: login.php');

?>