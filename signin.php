<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup System</title>
    <link rel="stylesheet" href="login.css">
</head>
<?php
session_start();
?>
<body>
    <div class="login-container">
        <h2>Sign In</h2>
        <form action="form_handel/signin_form_handel.php" method="POST" enctype="multipart/form-data">
            <label for="username">UserName:</label>
            <input type="text" id="username" name="username" placeholder="Enter your Name">

            <label for="username">Email:</label>
            <input type="text" id="user_email" name="user_email" placeholder="Enter your Email">

            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="Fullname" placeholder="Full Name">

            <label for="Birthday">Birthday:</label>
            <input type="date"  name="Birthday">

            <label>Gender:</label>
            <label for="male">
                <input type="radio" id="male" name="Gender" value="Male"> Male
            </label>
            <label for="female">
                <input type="radio" id="female" name="Gender" value="Female"> Female
            </label>
            <label for="other">
                <input type="radio" id="other" name="Gender" value="Other"> Other
            </label>

            <label for="mobile_number">Mobile Number:</label>
            <input type="tel" id="mobile_number" name="Mobile_number" placeholder="Mobile Number">


            <label for="bio">Bio:</label>
            <textarea id="bio" name="Bio" rows="10" placeholder="Enter Your Bio"></textarea>

            <label for="file-input" class="file-input-label">Upload Profile picture:</label>
            <input type="file" id="file-input" class="file-input" name="Picture">

            <label for="password">Password:</label>
            <input type="password" id="user_password" name="Password" placeholder="Enter your password">

            <label for="password">Confirm Password:</label>
            <input type="password" id="user_password" name="C_Password" placeholder="Enter your password">

            <button type="submit">Sign Up</button>
            <a href="http://localhost/facebook/">
                <h6>Already Have An Account?</h6>
            </a>
        </form>
        <a href="http://localhost/facebook/signin.php"> 
        <?php
require "./error_viewing.php";
?> 
</a>
    </div>
 
</body>

</html>