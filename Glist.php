<?php 
session_start();
$user_id = $_SESSION["user_id"] ?? false;
require "DB.php";
require "photos.php";

$db = new photos\DB();
$data = $db->get_all_photos();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Галерея</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Balsamiq+Sans&family=Comfortaa:wght@300..700&family=Oswald&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="The_Witcher.css">
    <link rel="stylesheet" href="Memchc.css">
</head>
<body>
    <div class="Support_LGBT">
    <?php include "header.php" ?>
    </div>

    <div id="D">
    <?php foreach($data as $photo): ?>
        <?= (new Photos\Photo($photo["ID"], $photo["Image"],))->get_html() ?>
        <?php endforeach; ?>
    </div>
    <script src="B.js"></script>
</body>
</html>
