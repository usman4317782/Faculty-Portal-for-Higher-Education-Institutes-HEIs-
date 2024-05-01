<?php

session_start();
if(!isset($_SESSION))
{
    header("Location: Login.php");
}
if (isset($_SESSION)) {
    session_destroy();
    header('Location: login.php');
}