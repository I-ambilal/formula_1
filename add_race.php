<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $location = $_POST['location'];
  $date = $_POST['race_date'];
  $flag = $_POST['race_flag'];

  $stmt = $conn->prepare("INSERT INTO races (name, location, race_date, race_flag) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $location, $date, $flag);
  $stmt->execute();

  header("Location: race_dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Race</title>
<link rel="stylesheet" href="f1_style.css?v=2">
</head>

<body>
  <h2>Add New Race</h2>
  <a href="race_dashboard.php" >← Back</a>

  <form method="POST">
    <label>Race Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" required><br><br>

    <label>Date:</label><br>
    <input type="date" name="race_date" required><br><br>

    <label>Flag Image URL:</label><br>
    <input type="text" name="race_flag" placeholder="images/flags/uk.png"><br><br>

    <button type="submit">Add Race</button>
  </form>
</body>
</html>
