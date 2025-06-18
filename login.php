<?php
include 'config.php';
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['login_email'] ?? '';
    $password = $_POST['login_password'] ?? '';

    $stmt = $conn->prepare("SELECT id, first_name, Email, Password FROM usersInfo WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userId, $firstName, $emailFromDb, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['first_name'] = $firstName;
            $_SESSION['email'] = $emailFromDb;
            header("Location: home_pg.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: black;
      font-family: 'Inter', sans-serif;
    }
    .login-box {
      width: 1000px;
      min-height: 500px;
      display: flex;
      border-radius: 16px;
      overflow: hidden;
      background-color: #f2f2f2;
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
      position: relative;
    }
    .back-btn {
      position: absolute;
      top: 12px;
      left: 12px;
      background: #fff;
      padding: 8px 12px;
      border-radius: 8px;
      font-size: 14px;
      text-decoration: none;
      color: #000;
      font-weight: bold;
      z-index: 10;
    }
    .login-form {
      flex: 1;
      padding: 24px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: #fff;
      color: #000;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    label {
      font-weight: bold;
    }
    input {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .btn {
      margin-top: 12px;
      margin-bottom: 20px;
      padding: 12px;
      background: black;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }
    .toggle-form {
      text-align: center;
      font-size: 14px;
    }
    .toggle-form a {
      color: red;
      cursor: pointer;
      text-decoration: underline;
    }
    .card {
      flex: 1;
      position: relative;
    }
    .card img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: opacity 0.8s ease-in-out;
    }
    .formTitle {
      text-align: center;
      margin-bottom: 15px;
    }
    .error-msg {
      color: red;
      margin: 10px 0;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <a href="home_pg.php" class="back-btn">← Back</a>

    <div class="login-form">
      <h2 class="formTitle">Login</h2>

      <?php if (!empty($error)): ?>
        <p class="error-msg"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="POST">
        <label>Email</label>
        <input type="email" name="login_email" required>

        <label>Password</label>
        <input type="password" name="login_password" required>

        <button class="btn" type="submit">Login</button>
      </form>

      <div class="toggle-form">
        <span>Don't have an account? <a href="signup.php">Sign up</a></span>
      </div>
    </div>

    <div class="card">
      <img id="cardSlideshow" src="box_images/bg-1.jpeg" alt="Slideshow">
    </div>
  </div>
</body>
</html>
