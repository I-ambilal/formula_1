<?php
include 'config.php';



$result = $conn->query("SELECT * FROM drivers ORDER BY driver_rank ASC");

if (isset($_GET['delete'])) {
    $rank = $_GET['delete'];
    $imgQuery = $conn->query("SELECT driver_image FROM drivers WHERE driver_rank = $rank");
    $imgRow = $imgQuery->fetch_assoc();
    if ($imgRow && file_exists($imgRow['driver_image'])) {
        unlink($imgRow['driver_image']);
    }

    $conn->query("DELETE FROM drivers WHERE driver_rank = $rank");
    header("Location: driver_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>F1 Drivers Dashboard</title>
<link rel="stylesheet" href="f1_style.css?v=2">
</head>
<body>

<h2>F1 Drivers Dashboard</h2>
<a href="home_pg.php">Back To Home </a>
<a href="add_driver.php">+ Add New Driver</a>

<table>
  <tr>
    <th>Rank</th><th>Name</th><th>Team</th><th>Country</th><th>Podiums</th><th>Points</th>
    <th>GPs</th><th>Championships</th><th>Highest Finish</th><th>Grid Pos</th>
    <th>DOB</th><th>Birth Place</th><th>Edit/Delete</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['driver_rank'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['team'] ?></td>
      <td><?= $row['country'] ?></td>
      <td><?= $row['podiums'] ?></td>
      <td><?= $row['points'] ?></td>
      <td><?= $row['grands_prix_entered'] ?></td>
      <td><?= $row['world_championships'] ?></td>
      <td><?= $row['highest_race_finish'] ?></td>
      <td><?= $row['highest_grid_position'] ?></td>
      <td><?= $row['date_of_birth'] ?></td>
      <td><?= $row['place_of_birth'] ?></td>
      
      <td>
        <a href="edit_driver.php?rank=<?= $row['driver_rank'] ?>">Edit</a>
        <a href="?delete=<?= $row['driver_rank'] ?>" class="delete" onclick="return confirm('Delete this driver?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
