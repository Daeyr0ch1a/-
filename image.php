<?php
session_start();
$user_id = $_SESSION["user_id"] ?? false;
$photo_id = intval($_GET["ID"]);
require "vendor/autoload.php";
$db = new \Photos\DB();
$photo = $db->get_photos_by_id($photo_id);
$comments = $db->get_photos_comments($photo_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фото</title>
    <link rel="stylesheet" href="The_Witcher.css">
    <link rel="stylesheet" href="Memchc.css">
</head>
<body>
    <?php include "header.php"; ?>
    <img src="<?= htmlspecialchars($photo["Image"]) ?>" alt="">
    <h1><?= htmlspecialchars($photo["Text"]) ?></h1>
    <p><?= htmlspecialchars($photo["Name"]) ?></p>
    <div class="comments">
        <div class="form">
            <textarea id="text" rows="5"></textarea>
            <button id="add_comment">Добавить</button>
        </div>
    </div>
    <h2>Комментарии:</h2>
    <?php foreach ($comments as $comment): ?>
    <div class="comment">
        <p class="author"><?= htmlspecialchars($comment["Name"]) ?></p>
        <p class="text"><?= htmlspecialchars($comment["Text"]) ?></p>
        <p class="date"><?= htmlspecialchars($comment["Post_date"]) ?></p>
    </div>
    <?php endforeach; ?>
    <script src="image.js"></script>
</body>
</html>
