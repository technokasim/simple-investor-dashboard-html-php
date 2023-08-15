<!DOCTYPE html>
<html>
<head>
    <title>Login Page | Investo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        
        .login-container h2 {
            margin: 0;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .login-form label {
            display: block;
            margin-bottom: 5px;
        }
        
        .login-form input {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        .login-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .lb{
            width: 98%!important;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" method="post" action="fetch/login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <input type="submit" value="Login" class="lb">
        </form>
    </div>
</body>
</html>
