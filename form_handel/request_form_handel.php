<?php
session_start();
require "../pdo.php";
$obj = $_GET["signname"];
$request_send_from = base64_decode($obj);

$_SESSION["request_send_from"] = $request_send_from;

$obj_mail = $_GET["mail"];
$_SESSION["email_send_from"] = $obj_mail;
$mail_send_from = base64_decode($obj_mail);
// $_SESSION["email_send_from"] = $mail_send_from;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 

    $searching_user = $_POST["search_user"];

    $query = "SELECT * FROM signin WHERE user_email=:user_email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $searching_user);
    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_email = $results['user_email'];
            $singin_id = $results['singin_id'];

            $username = $results['username'];
            $_SESSION["req_send_to"] = $username;

            $Fullname = $results['Fullname'];
            $Birthday = $results['Birthday'];
            $Gender = $results['Gender'];
            $Mobile_number = $results['Mobile_number'];
            $Picture = $results['Picture'];
            $Bio = $results['Bio'];
            // $_SESSION["request_email"]=base64_encode($user_email);
        }
    } else {
        header("location:http://localhost/facebook/profile_viewing/login_profile_view.php?error=user_not_available");
        exit;
    }
}
 else {
    header("location:http://localhost/facebook/profile_viewing/login_profile_view.php?useremail=" . $_SESSION["updated_mail"] . "&error=user_not_available");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>friend request</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../login.css">
</head>

<body>
    <form action="" method="POST" class="shadow-xl login-container bg-black text-white gap-5"
        enctype="multipart/form-data">
        <?php if (isset($Picture)) {
            echo '<img src="../upload_images/' . $Picture . '" class="shadow" alt=" " width="400px"> ';
        } ?>
        <!-- <h3>id: <?php echo $id; ?></h3> -->
        <!-- <h3>send_to: <?php echo $username; ?></h3> -->
        <h3>Username:
            <?php echo $username; ?>
        </h3>
        <h3>Username:
            <?php echo $user_email; ?>
        </h3>
        <h3>Fullname:
            <?php echo $Fullname; ?>
        </h3>
        <h3>Birthday:
            <?php echo $Birthday; ?>
        </h3>
        <h3>Gender:
            <?php echo $Gender; ?>
        </h3>
        <h3>Mobile Number:
            <?php echo $Mobile_number; ?>
        </h3>
        <h3>Bio:
            <?php echo $Bio; ?>
        </h3>
        <h3>send_from:
            <?php echo $request_send_from; ?>
        </h3>
        <h3>mail_send_from :
            <?php echo $mail_send_from; ?>
        </h3>


        <button type="submit" name="friend_request_submit" class="btn btn-info">Friend Request</button>
        <!-- // $friend_request = isFriendRequestSent($pdo, $request_send_from, $username); -->
    </form>
    <?php
if (isset($_POST["friend_request_submit"])) {
    $acceptButton = '<button class="btn btn-primary">Accept</button>';
    $rejectButton = '<button class="btn btn-error">Reject</button>';
    $messages = "<p class='text-xl py-5 px-8 my-5 mx-5 bg-gray-600 text-stone-50 inline'>$username has sent you a friend request  $acceptButton $rejectButton</p>";

    $query_insertion = "INSERT INTO frined_request (request_from, request_to, messages)
                        VALUES (:request_from, :request_to, :messages);";
    $stmt_insertion = $pdo->prepare($query_insertion);
    $stmt_insertion->bindParam(":request_from",$_SESSION["request_send_from"] );
    $stmt_insertion->bindParam(":request_to", $_SESSION["req_send_to"]);
    $stmt_insertion->bindParam(":messages", $messages);
    $stmt_insertion->execute();

    // Redirect after processing the form
    header("location: http://localhost/facebook/profile_viewing/login_profile_view.php?useremail=" . $_SESSION["email_send_from"]);
    exit();
}


   


    ?>
</body>

</html>