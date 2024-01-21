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
    $usernum = $_GET["gmail"];
    $mail = base64_decode($usernum);
    echo $mail;
    $query = "SELECT * FROM signin WHERE user_email =:user_email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $mail);
    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $singin_id = $results['singin_id'];
                $user_email = $results['user_email'];
                $username = $results['username'];
                $Fullname = $results['Fullname'];
                $Birthday = $results['Birthday'];
                $Gender = $results['Gender'];
                $Mobile_number = $results['Mobile_number'];
                $current_img = $results['Picture'];
                $Bio = $results['Bio'];
            }
        }
    }
$_SESSION["updated_mail"]=base64_encode($user_email);
    ?>

    <div class="login-container">
        <h2>Personal Information</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="username">UserName:</label>
            <input type="text" id="username" name="username" value="<?php echo $username ?>">

            <label for="username">Full Name:</label>
            <input type="text" id="username" name="Fullname" value="<?php echo $Fullname ?>">

            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="Birthday" value="<?php echo $Birthday ?>">

            <label>Gender:</label>
            <label for="male">
                <input type="radio" <?php if ($Gender == "Male")
                    echo "checked" ?> id="male" name="Gender" value="Male">
                    Male
                </label>
                <label for="female">
                    <input type="radio" <?php if ($Gender == "Femal")
                    echo "checked" ?> id="female" name="Gender"
                        value="Female"> Female
                </label>
                <label for="other">
                    <input type="radio" <?php if ($Gender == "Other")
                    echo "checked" ?> id="other" name="Gender"
                        value="Other"> Other
                </label>


                <label for="mobile_number">Mobile Number:</label>
                <input type="tel" id="mobile_number" name="Mobile_number" placeholder="Mobile Number"
                    value="<?php echo $Mobile_number ?>">


            <label for="bio">Bio:</label>
            <textarea id="bio" name="Bio" rows="10" placeholder="Enter Your Bio" value=""><?php echo $Bio ?></textarea>
            <h3>Current IMAGE :</h3>
            <?php
            if ($current_img != "") {
                // Display the current image
                echo '<img src="../upload_images/' . $current_img . '" class="shadow" alt="" width="400px">';
            }
            ?>
            <input type="hidden" class="" name="Picture" value="<?php echo $current_img ?>">

            <label for="file-input" class="file-input-label">Update Profile picture:</label>
            <input type="file" id="file-input" class="file-input" name="Picture">
            <button type="submit">Update</button>
            <?php
            require "../error_viewing.php";
            ?>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
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


        $newPictureName = "";
        if (isset($_FILES["Picture"]["name"])) {
            // Generate a new file name based on username and random number
            $ext = pathinfo($_FILES["Picture"]["name"], PATHINFO_EXTENSION);
            $newPictureName = $username . rand(0, 999) . "." . $ext;
        
            $source_path = $_FILES["Picture"]["tmp_name"];
            $destination_path = "../upload_images/" . $newPictureName;
        
            // Move the uploaded file to the destination path
            $upload = move_uploaded_file($source_path, $destination_path);
        
            // Check if the file was successfully uploaded
            if (!$upload) {
                // Handle the case where the file upload failed
                header("location: http://localhost/facebook/edit_profile/update.php?gmail=" . $_SESSION["updated_mail"] . "&error=pic_not_uploaded");
                exit();
            }
        } else {
            // If no new file was uploaded, keep the current image
            $newPictureName = $current_img;
        }
        
        // Now you can use $newPictureName in your further logic
        $Picture = $newPictureName;
        


        $query_update = "UPDATE signin
    SET username=:username,Fullname=:Fullname, Birthday=:Birthday, Gender=:Gender, Mobile_number=:Mobile_number, Picture=:Picture, Bio=:Bio
    WHERE user_email=:user_email";
        $stmt_update = $pdo->prepare($query_update);
        $stmt_update->bindParam(":user_email", $user_email);
        $stmt_update->bindParam(":username", $username);
        $stmt_update->bindParam(":Fullname", $Fullname);
        $stmt_update->bindParam(":Birthday", $Birthday);
        $stmt_update->bindParam(":Gender", $Gender);
        $stmt_update->bindParam(":Mobile_number", $Mobile_number);
        $stmt_update->bindParam(":Picture", $Picture);
        $stmt_update->bindParam(":Bio", $Bio);

        if ($stmt_update->execute()) {
            header("location: http://localhost/facebook/profile_viewing/login_profile_view.php?useremail=" . $_SESSION["updated_mail"]);
            exit();
        }
        else{
            header("location: http://localhost/facebook/edit_profile/update.php?gmail=" . $_SESSION["updated_mail"] . "&error=not_updated");
            exit();
        }
    }
    ?>
</body>

</html>