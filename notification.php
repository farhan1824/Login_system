<?php
session_start();
require "./pdo.php";
$_SESSION["req_send_to"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
</body>
</html>
<?php
$query = "SELECT messages FROM frined_request WHERE request_to=:request_to;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":request_to",$_SESSION["req_send_to"]);

// echo $btn=$_POST["request_accpet"];
if ($stmt->execute()) {
    $rows = $stmt->rowCount();
    if($rows >0){
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $msg = $result['messages']."<br>";
            echo $msg;
        }
    }
}


?>
