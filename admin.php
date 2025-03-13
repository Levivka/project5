<?php
session_start();
require 'db.php'; // Подключение к базе данных

// Проверяем, является ли пользователь администратором
if (!isset($_SESSION['user_id']) || $_SESSION['login'] != 'admin') {
    header("Location: login.php"); // Перенаправляем на страницу входа, если это не администратор
    exit();
}

// Обновление статуса заявки
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appeal_id = $_POST['appeal_id'];
    $status = $_POST['status'];

    $sql = "UPDATE appeals SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $appeal_id);

    if ($stmt->execute()) {
        echo "<div class='success'>Статус обновлен!</div>";
    } else {
        echo "<div class='error'>Ошибка при обновлении статуса.</div>";
    }
}

// Получаем все заявки
$sql = "SELECT * FROM appeals";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет администратора</title>
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
        .logout-button, .admin-button {
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
        .logout-button:hover, .admin-button:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }
        .success {
            color: #28a745;
            margin-bottom: 15px;
            text-align: center;
        }
        .error {
            color: #ff0000;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Личный кабинет администратора</h1>
    <a href="dashboard.php" class="admin-button">Назад в личный кабинет</a>
    <a href="logout.php" class="logout-button">Выйти</a>
    <table>
        <tr>
            <th>Дата</th>
            <th>№ Авто</th>
            <th>Статус</th>
            <th>Описание</th>
            <th>Действие</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['date_created'] ?></td>
            <td><?= $row['car_number'] ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="appeal_id" value="<?= $row['id'] ?>">
                    <select name="status">
                        <option value="в работе" <?= $row['status'] == 'в работе' ? 'selected' : '' ?>>В работе</option>
                        <option value="выполнено" <?= $row['status'] == 'выполнено' ? 'selected' : '' ?>>Выполнено</option>
                        <option value="отклонено" <?= $row['status'] == 'отклонено' ? 'selected' : '' ?>>Отклонено</option>
                    </select>
                    <button type="submit">Сохранить</button>
                </form>
            </td>
            <td><?= $row['description'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>