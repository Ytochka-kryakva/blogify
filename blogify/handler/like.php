<?php

// Запуск сессии
session_start();

// Подключение к БД
require("../handler/db.php");

/** Получаем наш ID статьи из запроса */
$id = $_POST['id'];
$message = '';
$error = true;

/** Если нам передали ID то обновляем */
$result = mysqli_query($db, "SELECT * FROM `likes` WHERE `ID_article` = " . $id . " AND `ID_user` = " . $_SESSION['ID_user']);
if (!mysqli_num_rows($result)) {

  mysqli_query($db, "INSERT INTO `likes` (`ID_article`, `ID_user`) VALUES ('" . $id . "', '" . $_SESSION['ID_user'] . "')");
  $result = mysqli_query($db, "SELECT * FROM `likes` WHERE `ID_article` = " . $id);
  $count = mysqli_num_rows($result);
  $error = false;
} else {

  mysqli_query($db, "DELETE FROM `likes` WHERE `ID_article` = " . $id . " AND `ID_user` = " . $_SESSION['ID_user']);
  $result = mysqli_query($db, "SELECT * FROM `likes` WHERE `ID_article` = " . $id);
  $count = mysqli_num_rows($result);
  $error = true;
}

$out = array(
  'error' => $error,
  'count' => $count,
);

// Устанавливаем заголовок ответа в формате json
header('Content-Type: text/json; charset=utf-8');

// Кодируем данные в формат json и отправляем
echo json_encode($out);
