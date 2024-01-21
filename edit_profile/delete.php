<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../login.css">
</head>
<body>
<?php
require "../pdo.php";
$usernum=$_GET["gmail"];
$email=base64_decode($usernum);
echo $email;
$query ="DELETE FROM signin WHERE user_email = :user_email";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":user_email", $email);
if($stmt->execute()){
header("location:http://localhost/facebook/");
}

?>
</body>
</html>