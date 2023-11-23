<?php 
// esse arquivo destroi a session para fazer o logout

session_start();
session_unset();
session_destroy();
header("location: index.php")
?>