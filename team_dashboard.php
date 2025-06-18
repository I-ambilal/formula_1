<?php
include 'config.php';
// include 'navbar.php';

$result = $conn->query("SELECT * FROM f1_teams ORDER BY ranking ASC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>F1 Teams Dashboard</title>
<link rel="stylesheet" href="f1_style.css?v=2">
  
</head>
<body>

<h2>Teams Dashboard</h2>
<a class="btn" href="home_pg.php">Back To Home </a>

<a href="add_team.php">+ Add New Team</a>

<table>
  <tr>
    <th>Ranking</th><th>Team Name</th><th>Base</th><th>Team Chief</th><th>Technical Chief</th><th>Chassis</th><th>Power Unit</th><th>First_Team_Entry</th><th>World Championships</th><th>Highest Race Finish</th><th>Pole Positions</th><th>Fastest Laps</th><th>Edit/Delete</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['ranking'] ?></td>
      <td><?= $row['full_team_name'] ?></td>
      <td><?= $row['base'] ?></td>
      <td><?= $row['team_chief'] ?></td>
      <td><?= $row['technical_chief'] ?></td>
      <td><?= $row['chassis'] ?></td>
      <td><?= $row['power_unit'] ?></td>
      <td><?= $row['first_team_entry'] ?></td>
      <td><?= $row['world_championships'] ?></td>
      <td><?= $row['highest_race_finish'] ?></td>
      <td><?= $row['pole_positions'] ?></td>
      <td><?= $row['fastest_laps'] ?></td>

      <td>
        <a href="edit_team.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Delete this team?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<?php
// Delete logic
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM f1_teams WHERE id=$id");

}
?>

</body>
</html>
