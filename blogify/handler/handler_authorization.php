<?php
// Запуск сессии
session_start();

// Подключение к БД
require("./db.php");

// Если форма была отправлена, то начинаем её обрабатывать

// Получаем данные, введённые пользователем
$email = $_POST['email'];
$password = $_POST['password'];

// берём из БД данные пользователя и записываем их в переменную, если введённый телефон совпал с телефоном из БД
$row = mysqli_query($db, "SELECT * FROM `users` WHERE `email`='" . $email . "'");

if (mysqli_num_rows($row)) {
  // Если логин верный, то переходим к сравнению паролей
  while ($row = mysqli_fetch_assoc($row)) {
    // сравниваем пароли функцией password_verify
    if (password_verify($password, $row['password'])) {
      // Если пароль верный, то создаём сессию пользователя, и переходим на главную
      $_SESSION['auth'] = true;
      $_SESSION['ID_user'] = $row['ID_user'];
      $sessionLifetime = 300;
      header('Location: ../index.php');
    } else {
      // Если пароль неверный, то выводим ошибку
      header('Location: ../authorization.php?error=error');
    }
  }
} else {
  // Если логин неверный, то выводим ошибку
  header('Location: ../authorization.php?error=error');
}
