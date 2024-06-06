<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION["user_id"] ?? false;

require 'vendor/autoload.php';
require "DB.php";
require "photos.php";
require "User.php";


$db = new \Photos\DB();
$data = $db->get_all_photos();

if(isset($_GET["error"])){
    $error = "Ошибка входа";
}
if(isset($_GET["signup_error"])){
    $signup_error = "Логин уже занят";
}
if(isset($_GET["signup_success"])){
    $signup_success = "Регистрация успешна";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Галерея</title>
    <link rel="stylesheet" href="The_Witcher.css">
    <link rel="stylesheet" href="Memchc.css">
</head>
<body>
<?php include "header.php"; ?>
<?php if ($user_id): ?>
    <?php foreach ($data as $photo): ?>
        <?php if (isset($photo['Image'])): ?>
            <?php
            $image = $photo['Image'];
            $text = $photo['Text'];
            echo (new \Photos\Photo($image, $text))->get_html();
            ?>
        <?php else: ?>
            <div class="form">
                <form action="login.php" method="post">
                    <h1>Авторизация</h1>
                    <input type="text" placeholder="Логин" name="login">
                    <input type="text" placeholder="Пароль" name="password">
                    <button>Войти</button>
                    <?php if(isset($_GET["error"])): ?>
                        <p class="error"><?= $error ?></p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="form">
                <form action="signup.php" method="post">
                    <h2>Регистрация</h2>
                    <input type="text" placeholder="Логин" name="login">
                    <input type="text" placeholder="Пароль" name="password">
                    <button>Зарегистрироваться</button>
                    <?php if(isset($_GET["signup_error"])): ?>
                        <p class="signup_error"><?= $signup_error ?></p>
                    <?php endif; ?>
                    <?php if(isset($_GET["signup_success"])): ?>
                        <p class="success"><?= $signup_success ?></p>
                    <?php endif; ?>
                </form>
            </div>
            <?php include "add.php"; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <script src="B.js"></script>
<?php endif; ?>
</body>
</html>
