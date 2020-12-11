<?php 
session_start();
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
session_destroy();
?>