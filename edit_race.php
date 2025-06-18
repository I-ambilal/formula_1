<?php
include 'config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM races WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$race = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $location = $_POST['location'];
  $date = $_POST['race_date'];
  $flag = $_POST['race_flag'];

  $stmt = $conn->prepare("UPDATE races SET name=?, location=?, race_date=?, race_flag=? WHERE id=?");
  $stmt->bind_param("ssssi", $name, $location, $date, $flag, $id);
  $stmt->execute();

  header("Location: race_dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Race</title>
<link rel="stylesheet" href="f1_style.css?v=2">
</head>
<body>
  <h2>Edit Race</h2>
  <a href="race_dashboard.php" >← Back</a>

  <form method="POST">
    <label>Race Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($race['name']) ?>" required><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" value="<?= htmlspecialchars($race['location']) ?>" required><br><br>

    <label>Date:</label><br>
    <input type="date" name="race_date" value="<?= $race['race_date'] ?>" required><br><br>

    <label>Flag Image URL:</label><br>
    <input type="text" name="race_flag" value="<?= htmlspecialchars($race['race_flag']) ?>"><br><br>

    <button type="submit">Update Race</button>
  </form>
</body>
</html>
