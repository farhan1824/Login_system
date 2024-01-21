<?php
$servername ="mysql:host=localhost;dbname=facebook";
$dbname = "root";
$password = "";

try {
  $pdo = new PDO($servername, $dbname, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>