<?php
// Запуск сессии
session_start();

// Подключение к БД
require("./db.php");

// Проверка на совпадение паролей
if ($_POST['password'] !== $_POST['passwordRepeat']) {
  header('Location: ../registration.php?error=error');
} else {

  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  echo $name;
  echo $surname;
  echo $email;

  // Пароль хешируется
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Добавление пользователя
  mysqli_query($db, "INSERT INTO `users` (`name`, `surname`, `email`, `password`) VALUES ('" . $name . "', '" . $surname . "', '" . $email . "', '" . $password . "')");

  header('Location: ../authorization.php');
}
