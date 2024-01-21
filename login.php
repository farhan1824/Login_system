<?php
 session_start();
 echo '
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="login.css">
         <title>Log In</title>
     </head>
     <body>
     <div class="login-container">
             <h2>Login</h2>
             <form action="form_handel/login_form_handel.php" method="POST">
                 <label for="username">Email:</label>
                 <input type="text" id="user_email" name="user_email" placeholder="Enter your Email" >
                 <label for="password">Password:</label>
                 <input type="password" id="password" name="user_password" placeholder="Enter your password" >
                 <button type="submit">LOG IN</button>
                 <a href="http://localhost/facebook/signin.php"><h6>Dont Have Any Account?</h6></a>
             </form>
         </div>
      
     </body>
     
     </html>';
 ?>
 <a href="http://localhost/facebook/">
     <?php
     require_once "./error_viewing.php";
     ?>
 </a>