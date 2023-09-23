<?php

// Запуск сессии
session_start();

// Если пользователь не авторизован, то он переадресовывается на страницу авторизации
if (!isset($_SESSION['auth'])) {
  header('Location: ./authorization.php');
}

// Подключение к БД
require("../handler/db.php");

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "../img/" . $filename;
$article = $_POST['article'];
$user = $_SESSION['ID_user'];

mysqli_query($db, "INSERT INTO `articles` (`ID_user`, `text`, `img`) VALUES ('" . $user . "', '" . $article . "', '" . $filename . "')");

// Now let's move the uploaded image into the folder: image
move_uploaded_file($tempname, $folder);

header('Location: ../index.php');
