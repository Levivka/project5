<?php
session_start();
require 'db.php'; // Подключение к базе данных

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Перенаправляем на страницу входа, если пользователь не авторизован
    exit();
}

$user_id = $_SESSION['user_id'];

// Получаем заявки пользователя
$sql = "SELECT * FROM appeals WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            font-weight: 500;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .create-appeal-button, .logout-button, .admin-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        .create-appeal-button:hover, .logout-button:hover, .admin-button:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }
    </style>
</head>
<body>
    <h1>Ваши заявки</h1>
    <a href="create_appeal.php" class="create-appeal-button">Создать новое обращение</a>
    <?php if ($_SESSION['login'] == 'admin'): ?>
        <a href="admin.php" class="admin-button">Администрирование</a>
    <?php endif; ?>
    <a href="logout.php" class="logout-button">Выйти</a>
    <table>
        <tr>
            <th>Дата</th>
            <th>№ Авто</th>
            <th>Статус</th>
            <th>Описание</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['date_created'] ?></td>
            <td><?= $row['car_number'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['description'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>