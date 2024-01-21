<?php
session_start();
if(($_SESSION["gmail_token"])){
header("Location: http://localhost/facebook/profile_viewing/login_profile_view.php?useremail={$_SESSION['gmail_token']}");
}
else{
    header("location:http://localhost/facebook/login.php");
}

