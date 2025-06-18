<?php
session_start();
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$success = $error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'] ?? '';
    $last_name  = $_POST['last_name'] ?? '';
    $gender     = $_POST['gender'] ?? '';
    $age        = intval($_POST['age']) ?? 0;

    $stmt = $conn->prepare("UPDATE usersInfo SET first_name = ?, last_name = ?, Gender = ?, Age = ? WHERE id = ?");
    $stmt->bind_param("sssii", $first_name, $last_name, $gender, $age, $userId);

    if ($stmt->execute()) {
        $success = "Profile updated successfully.";
    } else {
        $error = "Error updating profile.";
    }
}

// Fetch user data
$stmt = $conn->prepare("SELECT first_name, last_name, Gender, Age, Email FROM usersInfo WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="f1_style.css?v=2">

  <style>
    body {
      font-family: Arial, sans-serif;
      background:rgb(0, 0, 0);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .profile-box {
      background: #fff;
      color: #000;
      padding: 30px;
      border-radius: 12px;
      width: 400px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.4);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 12px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .btn {
      margin-top: 20px;
      padding: 12px;
      background-color: black;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      width: 100%;
      cursor: pointer;
    }
    .msg {
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
    }
    .success { color: green; }
    .error { color: red; }
  </style>
</head>
<body>
  <div class="profile-box">
    <h2>Edit Profile</h2>

    <?php if ($success): ?><p class="msg success"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p class="msg error"><?= $error ?></p><?php endif; ?>

    <form method="POST">
      <label>First Name</label>
      <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

      <label>Last Name</label>
      <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

      <label>Gender</label>
      <select name="gender" required>
        <option value="">Select</option>
        <option value="Male" <?= $user['Gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $user['Gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= $user['Gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
      </select>

      <label>Age</label>
      <input type="number" name="age" value="<?= htmlspecialchars($user['Age']) ?>" required>

      <label>Email</label>
      <input type="email" value="<?= htmlspecialchars($user['Email']) ?>" disabled>

      <button class="btn" type="submit">Update Profile</button>
    </form>
  </div>
</body>
</html>
