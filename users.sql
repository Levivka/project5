CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL
);

CREATE TABLE appeals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    car_number VARCHAR(20) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('в работе', 'выполнено', 'отклонено') DEFAULT 'в работе',
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);