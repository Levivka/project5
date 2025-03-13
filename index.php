<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="main.css?" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <html lang="en">
        <title>Вход</title>
    </head>
    
    <body>
    <img src="Frame.svg" style="position: absolute; left: 50px; top: 50px">   

        <div class="container">
            <h2>Вход</h2>
            
            <form id="signupForm" method="post" action="site.php">
                <div class="form-group">
                    <label for="username">Логин</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" required>
                    <span id="passwordError" class="error"></span>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>
                
                <button type="submit" value="">Войти</button>
                <div style="text-align:center">
                    <p class="message">
                        <a href="in.php">Зарегистрироваться</a>
                        <style>
                            a {
                                text-align: center;
                                font-size: 80%;
                                text-decoration: none;
                                color: black;
                                width: 400px;
                            }
                        </style>
                    </p>
                
                </div>
            </form>
        </div>
        <!-- <script>
            document.getElementById('signupForm').addEventListener('submit', function (event) {
                event.preventDefault();
    
                let username = document.getElementById('username').value;
                let email = document.getElementById('email').value;
                let password = document.getElementById('password').value;
                let confirmPassword = document.getElementById('confirmPassword').value;
                let message = document.getElementById('message');
                let passwordError = document.getElementById('passwordError');
                let confirmPasswordError = document.getElementById('confirmPasswordError');
    
                let passwordValid = validatePassword(password);
                if (!passwordValid) {
                    passwordError.textContent = 'Пароль не соответствует требованиям.';
                    return;
                } else {
                    passwordError.textContent = '';
                }
    
                if (password !== confirmPassword) {
                    confirmPasswordError.textContent = 'Пароли не совпадают!';
                    return;
                } else {
                    confirmPasswordError.textContent = '';
                }
    
                // Here you can add code to send the form data to the server
    
                message.style.color = 'green';
                message.textContent = 'Регистрация прошла успешно!';
            });
    
            document.getElementById('password').addEventListener('focus', function () {
                document.getElementById('passwordHint').style.display = 'block';
            });
    
            document.getElementById('password').addEventListener('blur', function () {
                document.getElementById('passwordHint').style.display = 'none';
            });
    
            document.getElementById('password').addEventListener('input', function () {
                let password = this.value;
                let passwordStrength = document.getElementById('passwordStrength');
                let strength = getPasswordStrength(password);
    
                passwordStrength.innerHTML = ''; // Clear previous strength bars
                if (strength) {
                    let strengthBar = document.createElement('div');
                    strengthBar.className = strength;
                    passwordStrength.appendChild(strengthBar);
                }
            });
    
            function validatePassword(password) {
                let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                return regex.test(password);
            }
    
            function getPasswordStrength(password) {
                if (password.length < 8) {
                    return 'weak';
                }
                if (password.match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/)) {
                    return 'strong';
                }
                return 'medium';
            }
        </script> -->
        
    </body>
    
    </html>
    