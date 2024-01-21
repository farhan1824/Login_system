<?Php
require "./global.php";
session_unset();
session_destroy();
echo" you are not logged in ";
// header("location:../login/login.php");
header("location:{$baseURL}");
exit();