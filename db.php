<?php
$servername = "localhost";
$username = "root"; // Имя пользователя MySQL
$password = ""; // Пароль MySQL
$dbname = "project5"; // Имя вашей базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>