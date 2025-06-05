<?php

session_start(); //variavel global

unset($_SESSION['usuario']);
unset($_SESSION['email']);

header('Location: index.php');

?>