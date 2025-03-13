<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('bg4096_2304.png'); /* Путь к вашему изображению */
            background-size: cover; /* Растягиваем изображение на весь экран */
            background-position: center; /* Центрируем изображение */
        }
        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-weight: 500;
        }
        .register-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        .register-container button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .register-container button:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }
        .register-container a {
            display: block;
            margin-top: 15px;
            color: #2575fc;
            text-decoration: none;
            font-size: 14px;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Регистрация</h2>
        <form action="register.php" method="POST">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="text" name="full_name" placeholder="ФИО" required>
            <input type="email" name="email" placeholder="Почта" required>
            <input type="text" name="phone" placeholder="Телефон" required>
            <button type="submit">Регистрация</button>
        </form>
        <a href="login.php">Войти</a>
    </div>
</body>
</html>
<?php
session_start();
require 'db.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хешируем пароль
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Проверяем, существует ли пользователь с таким логином
    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Пользователь с таким логином уже существует.";
    } else {
        // Добавляем нового пользователя в базу данных
        $sql = "INSERT INTO users (login, password, full_name, email, phone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $login, $password, $full_name, $email, $phone);

        if ($stmt->execute()) {
            echo "Вы успешно зарегистрированы!";
            header("Location: login.php"); // Перенаправляем на страницу входа
        } else {
            echo "Ошибка при регистрации.";
        }
    }
}
?>