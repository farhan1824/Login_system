<?php
if(isset($_GET["error"])){
if ( $_GET["error"] == "input_empty") {
    echo "<p style='color: red;'>Input cannot be empty.</p>";
    unset($_GET["error"]);
} elseif ( $_GET["error"] == "password_not_matched") {
    echo "<p style='color: red;'>Passwords do not match.</p>";
    unset($_GET["error"]);
}
 elseif ($_GET["error"] == "email_invalid") {
    echo "<p style='color: red;'>email_invalid.</p>";
    unset($_GET["error"]);
}
 elseif ($_GET["error"] == "email_already_exists") {
    echo "<p style='color: red;'>email_already_exists.</p>"; 
    unset($_GET["error"]);
}
 elseif ($_GET["error"] == "username_already_exists") {
    echo "<p style='color: red;'>username_already_exists.</p>";
    unset($_GET["error"]);
}
 elseif ($_GET["error"] == "email_invalid") {
    echo "<p style='color: red;'>email_invalid.</p>";
    unset($_GET["error"]);
}
 elseif ($_GET["error"] == "not_updated") {
    echo "<p style='color: red;'>There Seems To be a problem Fix that.</p>";
    unset($_GET["error"]);
}
 elseif ($_GET["error"] == "pic_not_uploaded") {
    echo "<p style='color: red;'>Image is not uploaded.</p>";
    unset($_GET["error"]);
}
 elseif ($_GET["success"] == "updated") {
    echo "<p style='color: green;'>Successfully Updated.</p>";
    unset($_GET["error"]);
}
 elseif ($_GET["success"] == "user_not_available") {
    echo "<p style='color: green;'>user not available .</p>";
    unset($_GET["error"]);
}
}

