<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'] ?? '';
    $last_name  = $_POST['last_name'] ?? '';
    $gender     = $_POST['gender'] ?? '';
    $age        = intval($_POST['age']) ?? 0;
    $email      = $_POST['email'] ?? '';
    $password   = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT); // secure hash

    $stmt = $conn->prepare("INSERT INTO usersInfo (first_name, last_name, Gender, Age, Email, Password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $first_name, $last_name, $gender, $age, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Signup Page</title>
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
      background:rgb(0, 0, 0);
      font-family: 'Inter', sans-serif;
    }
    .login-box {
      width: 1000px;
      min-height: 500px;
      display: flex;
      border-radius: 16px;
      overflow: hidden;
      background-color: oklch(70.9% 0.01 56.259);
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
    form {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    label {
      font-weight: bold;
    }
    input, select {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .btn {
      margin-bottom: 12px;
      margin-top: 12px;
      padding: 12px;
      background: black;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
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
    .card {
      min-height: 500px;
      flex: 1;
      position: relative;
    }
    .card img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    ::-webkit-scrollbar { width: 0; }
    .formTitle {
      margin-left: 40%;
      margin-bottom: 15px;
      margin-top: 5px;
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
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-form">
      <h2 class="formTitle">Sign Up</h2>

      <form method="POST">
        <label>First Name</label>
        <input type="text" name="first_name" required>
        <label>Last Name</label>
        <input type="text" name="last_name" required>
        <label>Gender</label>
        <select name="gender" required>
          <option value="">Select Gender</option>
          <option>Female</option>
          <option>Male</option>
          <option>Other</option>
        </select>
        <label>Age</label>
        <input type="number" name="age" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        
        <button class="btn" type="submit">Create Account</button>
        <div class="toggle-form">
       <a href="login.php">Already have an account?</a>
    </div>
      </form>
    </div>

    <div class="card">
<img id="cardSlideshow" src="box_images/bg-1.jpeg" alt="Slideshow">
    </div>
  </div>


  
</body>
</html>
