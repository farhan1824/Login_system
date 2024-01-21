<?php
require "../pdo.php";
require "../global.php";
function user_exists($pdo, $user_email, $user_password,$baseURL) {
    $hased_password=md5($user_password);
    $query = "SELECT * FROM signin WHERE user_email = :user_email AND Password=:Password;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":Password", $hased_password);
    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            return true; // Make sure to exit after a header redirect
        } else {
            // User does not exist, redirect to the homepage
            header("Location:{$baseURL}?error=email_invalid");
            exit();
        }
    }
   
    
    else {
        // Handle execute error if needed
        echo "Error executing query.";
    }
}


