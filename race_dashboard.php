<?php
include 'config.php';

$result = $conn->query("SELECT * FROM races ORDER BY race_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>F1 Races Dashboard</title>
<link rel="stylesheet" href="f1_style.css?v=2">
  
</head>
<body>

<h2>Races Dashboard</h2>
<a class="btn" href="home_pg.php">Back To Home </a>

<a href="add_race.php">+ Add New Race</a>

<table>
  <tr>
    <th>Race Name</th>
    <th>Location</th>
    <th>Date</th>
    <th>Flag</th>
    <th>Actions</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['location']) ?></td>
      <td><?= htmlspecialchars($row['race_date']) ?></td>
      <td>
        <?php if (!empty($row['race_flag'])): ?>
          <img src="<?= htmlspecialchars($row['race_flag']) ?>" alt="Flag" class="flag">
        <?php else: ?>
          N/A
        <?php endif; ?>
      </td>
      <td>
        <a href="edit_race.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Delete this race?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<?php
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM races WHERE id=$id");
  header("Location: race_dashboard.php");
  exit;
}
?>

</body>
</html>
