<?php
require "../query/signin_query.php";
require "../pdo.php";
require "../global.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // $singin_id  = $_POST["singin_id"];
    $username = $_POST["username"];
    $user_email = $_POST["user_email"];
    $Fullname = $_POST["Fullname"];
    $Birthday = $_POST["Birthday"];
    $Gender = $_POST["Gender"] ?? "Not Specified";
    $selected = "Not Specified";
    if ($Gender == "Male") {
        $selected = "Male";
    } elseif ($Gender == "Female") {
        $selected = "Female";
    } elseif ($Gender == "Other") {
        $selected = "Other";
    }
    $Mobile_number = $_POST["Mobile_number"];
    $Bio = $_POST["Bio"];
    $Picture = "";
    if (isset($_FILES["Picture"]["name"])) {
        $Picture = $_FILES["Picture"]["name"];
        $ext = pathinfo($Picture, PATHINFO_EXTENSION);
        $Picture = $username . rand(0, 999) . "." . $ext;
        $source_path = $_FILES["Picture"]["tmp_name"];
        $destination_path = "../upload_images/" . $Picture;
        // $destination_path = "upload_images/" . $profile_image;
        $upload = move_uploaded_file($source_path, $destination_path);
    }
   $Password = $_POST["Password"];
$C_Password = $_POST["C_Password"];

    var_dump($username, $Fullname, $Gender, $Picture, $Mobile_number, $Bio, $Password);
    echo "<br>";
    echo $username;
    try {
        if (empty_input($username,$user_email,$Fullname, $Birthday, $Gender, $Mobile_number, $Bio, $Picture)) {
            header("location:{$baseURL}signin.php?error=input_empty");
            exit();
        } 
        elseif (is_username_already_registered($pdo,$username)) {
            header("location:{$baseURL}signin.php?error=username_already_exists");
            exit();
        } 
        elseif (email_validation($user_email)) {
            header("location:{$baseURL}signin.php?error=email_invalid");
            exit();
        } 
        elseif (is_email_already_registered($pdo,$user_email)) {
            header("location:{$baseURL}signin.php?error=email_already_exists");
            exit();
        } 
        elseif (password_match($Password, $C_Password)) {
            header("location:{$baseURL}signin.php?error=password_not_matched");
            exit();
        }     
        else {
            $hased_password=md5($Password);
            user_input($pdo, $username,$user_email ,$Fullname, $Birthday, $Gender, $Picture, $Bio, $hased_password, $Mobile_number,$baseURL);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("location:{$baseURL}signin.php");
}