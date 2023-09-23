<?php
// Запуск сессии
session_start();

// Подключение к БД
require("../handler/db.php");

mysqli_query($db, "INSERT INTO `comments` (`ID_user`, `ID_article`, `text`) VALUES ('" . $_SESSION['ID_user'] . "', '" . $_POST['ID_article'] . "', '" . $_POST['text'] . "')");
$result = mysqli_query($db, "SELECT * FROM `comments` LEFT OUTER JOIN `users` ON comments.ID_user = users.ID_user WHERE `ID_article`='" . $_POST['ID_article'] . "'");

while ($row = mysqli_fetch_assoc($result)) {

  echo "<div class='article__comment'>
  <div class='article__commentAvatar'>
    <p class='article__commentAvatar-text'>" . mb_substr($row['surname'], 0, 1), mb_substr($row['name'], 0, 1) . "</p>
  </div>
  <div class='article__commentNameText'>
    <p>" . $row['surname'] . " " . $row['name'] . "</p>
    <p>" . $row['text'] . "</p>
    <p>" . $row['date'] . "</p>
  </div>
</div>";

}
