<?php
require "./global.php";
session_start();
if(($_SESSION["gmail_token"])){
    header("Location: {$baseURL}/profile_viewing/login_profile_view.php?useremail={$_SESSION['gmail_token']}");
}
else{
    header("location:{$baseURL}login.php");
}

