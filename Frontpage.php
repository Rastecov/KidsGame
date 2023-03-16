<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
      }
      h1 {
        text-align: center;
        margin-top: 50px;
        margin-bottom: 30px;
      }
      form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 5px;
      }
      label {
        display: block;
        margin-bottom: 5px;
        font-size: 16px;
        font-weight: bold;
      }
      input[type="text"],
      input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
        font-size: 16px;
      }
      input[type="submit"] {
        background-color: #2ecc71;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
      }
      input[type="submit"]:hover {
        background-color: #27ae60;
      }
      .btn-secondary {
        background-color: #3498db;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
      }
      .btn-secondary:hover {
        background-color: #2980b9;
      }
      .fa-lock {
        margin-right: 10px;
      }
    </style>
  </head>
  <body>
    <h1>Login Form</h1>
    <form method="post" action="login.php">
      <label for="username"><i class="fas fa-user"></i>Username:</label>
      <input type="text" id="username" name="username" placeholder="Enter your username"><br>
      <label for="password"><i class="fas fa-lock"></i>Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password"><br>
      <input type="submit" name="connect" value="Connect">
    </form>
    <form method="get" action="signup.php">
      <button type="submit" class="btn-secondary"><i class="fas fa-user-plus"></i>Sign-Up</button>
    </form>
  </body>
</html>
