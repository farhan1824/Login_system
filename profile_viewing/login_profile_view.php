<?php
require "../pdo.php";
$userobj = $_GET["useremail"];
$user_email = base64_decode($userobj);
$query = "SELECT * FROM signin WHERE user_email = :user_email;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":user_email", $user_email);
if ($stmt->execute()) {
    $rows = $stmt->rowCount();
    if ($rows == 1) {
        while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $singin_id = $results['singin_id'];
            $username = $results['username'];
            $req_send = base64_encode($username);
            $user_email = $results['user_email'];
            $Fullname = $results['Fullname'];
            $Birthday = $results['Birthday'];
            $Gender = $results['Gender'];
            $Mobile_number = $results['Mobile_number'];
            $Picture = $results['Picture'];
            $Bio = $results['Bio'];
            $_SESSION["gmail_token"] = base64_encode($user_email);
            $sending_mail = $_SESSION["gmail_token"];
        }
    } else {
        header("lcoation:http://localhost/facebook/");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_view</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="hero  bg-base-200">
        <div class="hero-content text-center">
        <!-- <button class="btn btn-warning">Warning</button> -->
            <div class="max-w-md">
                <?php 
                 echo '<a href="../notification.php" class="btn btn-warning">Notifications</a>';
                if (isset($Picture)) {
                   
                    echo '<img src="../upload_images/' . $Picture . '" class="shadow" alt=" " width="400px"> ';
                } ?>
                <h1 class="text-2xl font-bold">Username:
                    <?php echo $username ?>
                </h1>
                <h1 class="text-2xl font-bold">Full Name:
                    <?php echo $Fullname ?>
                </h1>
                <h1 class="text-2xl font-bold">Email:
                    <?php echo $user_email ?>
                </h1>
                <p class="py-1">Bio:
                    <?php echo $Bio ?>
                </p>
                <p class="py-1">Birthday:
                    <?php echo $Birthday ?>
                </p>
                <p class="py-1">Gender:
                    <?php echo $Gender ?>
                </p>
                <p class="py-1">Moblie_Number:
                    <?php echo $Mobile_number ?>
                </p>

                <form action="../form_handel/request_form_handel.php?signname=<?php echo $req_send ?>&mail=<?php echo $sending_mail ?>"
                    method="POST">
                    <input type="email" placeholder="Type Users Email for Seacrching Your Friend" name="search_user"
                        class="input input-bordered w-full max-w-xs" />
                    <button class="btn btn-warning" type="submit">search</button>
                </form>



                <a href="http://localhost/facebook/edit_profile/delete.php?gmail=<?php echo $sending_mail ?>"
                    class="btn btn-secondary">delete</a>

                <a href="http://localhost/facebook/edit_profile/update.php?gmail=<?php echo $sending_mail ?>"
                    class="btn btn-secondary">Update</a>

                <a href="http://localhost/facebook/logout.php" class="btn btn-primary">Log Out</a>
            </div>
        </div>
    </div>
</body>

</html>