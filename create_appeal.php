<?php
session_start();
require 'db.php'; // Подключение к базе данных

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Перенаправляем на страницу входа, если пользователь не авторизован
    exit();
}

$error = ''; // Переменная для хранения ошибки

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_number = $_POST['car_number'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Добавляем заявку в базу данных
    $sql = "INSERT INTO appeals (user_id, car_number, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $car_number, $description);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Перенаправляем в личный кабинет
        exit();
    } else {
        $error = "Ошибка при создании заявки."; // Сообщение об ошибке
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание заявки</title>
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
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
        }
        .appeal-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 500px;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .appeal-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-weight: 500;
        }
        .appeal-container input, .appeal-container textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .appeal-container input:focus, .appeal-container textarea:focus {
            border-color: #6a11cb;
        }
        .appeal-container textarea {
            resize: vertical;
            min-height: 100px;
        }
        .appeal-container button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .appeal-container button:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: translateY(-3px);
        }
        .appeal-container a {
            display: block;
            margin-top: 15px;
            color: #2575fc;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        .appeal-container a:hover {
            color: #1a5bbf;
        }
        .error {
            color: #ff0000;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="appeal-container">
        <h2>Создание заявки</h2>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="car_number" placeholder="Номер авто" required>
            <textarea name="description" placeholder="Описание нарушения" required></textarea>
            <button type="submit">Отправить</button>
            <a href="dashboard.php">Отменить</a>
        </form>
    </div>
</body>
</html>