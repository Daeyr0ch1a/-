<?php
if (isset($_POST["image"], $_POST["text"])) {
    require "C:/xampp/htdocs/25/vendor/autoload.php";
    $db = new \Photos\DB();
    session_start();
    $user_id = $_SESSION["user_id"];
    $db->new_photo($user_id, $_POST["image"], $_POST["text"]);
    header("Location: User.php");
    exit();
}
?>
