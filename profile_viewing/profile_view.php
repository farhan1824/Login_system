<?php
echo "Profile view";
require "../pdo.php";
$query_01 = "SELECT * FROM signin WHERE singin_id = (SELECT MAX(singin_id) FROM signin)";
$stmt_01 = $pdo->prepare($query_01);
if ($stmt_01->execute()) {
    while ($results = $stmt_01->fetch(PDO::FETCH_ASSOC)) {
        $singin_id = $results['singin_id'];
        $username = $results['username'];
        $user_email = $results['user_email'];
        $Fullname = $results['Fullname'];
        $Birthday = $results['Birthday'];
        $Gender = $results['Gender'];
        $Mobile_number = $results['Mobile_number'];
        $Picture = $results['Picture'];
        $Bio = $results['Bio'];
        // echo $singin_id, $username, $user_email, $Fullname, $Birthday, $Gender, $Mobile_number, $Picture, $Bio;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin_View</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="hero  bg-base-200">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <?php if (isset($Picture)) {
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
                <a href="http://localhost/facebook/signout.php" class="btn btn-primary">Signout</a>
            </div>
        </div>
    </div>
</body>

</html>