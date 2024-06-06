<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION["photo_id"], $_POST["text"], $_SESSION["user_id"])) {
    require "vendor/autoload.php";
    $db = new \Photos\DB();
    $uid = $_SESSION["user_id"];
    $pid = $_SESSION["photo_id"];
    $text = $_POST["text"];
    
    $comment = $db->new_comment($uid, $pid, $text);

    if ($comment) {
        echo json_encode(['status' => 'success', 'comment' => $comment]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add comment']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
?>
