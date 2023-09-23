<?php
// Запуск сессии
session_start();
// Уничтожение сессии
session_destroy();
// Переход на главную
header('Location: ../index.php');