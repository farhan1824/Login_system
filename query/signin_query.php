<?php
require "../pdo.php";
// require "../form_handel/signin_form_handel.php";
function user_input(object $pdo, string $username,string $user_email, string $Fullname, string $Birthday,$Gender, $Picture, string $Bio, string  $hased_password, string $Mobile_number){
    $query = "INSERT INTO signin (username,user_email, Fullname, Birthday, Gender, Mobile_number, Picture, Password, Bio)
    VALUES (:username,:user_email,:Fullname, :Birthday, :Gender, :Mobile_number, :Picture, :Password, :Bio);";

    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":username", $username);
    $stmt->bindparam(":user_email", $user_email);
    $stmt->bindparam(":Fullname", $Fullname);
    $stmt->bindparam(":Birthday", $Birthday);
    $stmt->bindparam(":Gender", $Gender);
    $stmt->bindparam(":Mobile_number", $Mobile_number);
    $stmt->bindparam(":Picture", $Picture); 
    $stmt->bindparam(":Password", $hased_password);
    $stmt->bindparam(":Bio", $Bio);

    if ($stmt->execute()) {
        header("location:http://localhost/facebook/profile_viewing/profile_view.php");
        exit();
    } else {
        header("location:http://localhost/facebook/signin.php");
        // session_unset();
        // session_destroy();
    }
}
function password_match(string $Password,string $C_Password){
if($Password!==$C_Password){
    return true;
}
else{
    return false;
}
}
function empty_input($username,$user_email ,$Fullname, $Birthday, $Gender, $Mobile_number, $Bio, $Picture)
{
    if (empty($username) || empty($Fullname) || empty($Birthday) || empty($Gender) || empty($Mobile_number) || empty($Bio) || empty($Picture)) {
        return true;
    }else {
        return false;
    }
}
function email_validation(string $user_email)
{
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
function is_email_already_registered(object $pdo ,string $user_email){
        $query = "SELECT user_email FROM signin WHERE user_email=:user_email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_email", $user_email);
        $stmt->execute();
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['user_email'] === $user_email) {
            // Email is already registered
            return true;
        } else {
            // Email is not registered
            return false;
        }  
}
function is_username_already_registered(object $pdo ,string $username){
        $query = "SELECT username FROM signin WHERE username=:username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['user_email'] === $username) {
            // username is already registered
            return true;
        } else {
            // username is not registered
            return false;
        }  
}
