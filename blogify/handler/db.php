<?php
// Переменные для подключения к БД
$db_name = 'blogify';
$host = 'localhost';
$user = 'root';
$password = '';

// Подключение к БД
$db = mysqli_connect($host, $user, $password, $db_name);

// Если не удалось подключиться, выводим ошибку
if (!$db) {
  echo 'Не удалось подключится к базе данных!';
}