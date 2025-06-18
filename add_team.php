<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Add F1 Team</title>
<link rel="stylesheet" href="f1_style.css?v=2">
 
</head>
<body>

<h2>Add New F1 Team</h2>
<a class="btn"  href="team_dashboard.php" >← Back</a>

<form method="post">
  <input type="text" name="full_team_name" placeholder="Team Name" required>
  <input type="text" name="base" placeholder="Base" required>
  <input type="text" name="team_chief" placeholder="Team Chief" required>
  <input type="text" name="technical_chief" placeholder="Technical Chief">
  <input type="text" name="chassis" placeholder="Chassis">
  <input type="text" name="power_unit" placeholder="Power Unit">
  <input type="number" name="first_team_entry" placeholder="First Entry (Year)">
  <input type="number" name="world_championships" placeholder="Championships">
  <input type="text" name="highest_race_finish" placeholder="Highest Race Finish">
  <input type="number" name="pole_positions" placeholder="Pole Positions">
  <input type="number" name="fastest_laps" placeholder="Fastest Laps">
  <input type="number" name="ranking" placeholder="Ranking" required>
  <input type="file" name="team_image" accept="image/*" required>
  

  <button type="submit">Add Team</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $imagePath = '';

  if (!empty($_FILES['team_image']['name'])) {
    $target_dir = "uploads/";
    $imagePath = $target_dir . basename($_FILES["team_image"]["name"]);
    move_uploaded_file($_FILES["team_image"]["tmp_name"], $imagePath);
  }

  $stmt = $conn->prepare("INSERT INTO f1_teams 
    (full_team_name, base, team_chief, technical_chief, chassis, power_unit, 
     first_team_entry, world_championships, highest_race_finish, pole_positions, fastest_laps, ranking, team_image)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt->bind_param("ssssssiiisiis", 
    $_POST['full_team_name'], $_POST['base'], $_POST['team_chief'],
    $_POST['technical_chief'], $_POST['chassis'], $_POST['power_unit'],
    $_POST['first_team_entry'], $_POST['world_championships'], $_POST['highest_race_finish'],
    $_POST['pole_positions'], $_POST['fastest_laps'], $_POST['ranking'], $imagePath
  );

  $stmt->execute();
  header("Location: team_dashboard.php");
  exit;
}

?>

</body>
</html>
