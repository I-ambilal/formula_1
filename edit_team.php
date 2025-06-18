<?php
include 'config.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM f1_teams WHERE id = $id");
$team = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Team</title>
<link rel="stylesheet" href="f1_style.css?v=2">
</head>
<body>

<h2>Edit F1 Team</h2>
<a href="team_dashboard.php" >← Back</a>

<form method="post" enctype="multipart/form-data">
  <input type="text" placeholder="Team Name" name="full_team_name" value="<?= $team['full_team_name'] ?>">
  <input type="text" placeholder="Base" name="base" value="<?= $team['base'] ?>">
  <input type="text" placeholder="Team Chief" name="team_chief" value="<?= $team['team_chief'] ?>">
  <input type="text" placeholder="Technical Chief" name="technical_chief" value="<?= $team['technical_chief'] ?>">
  <input type="text" placeholder="Chassis" name="chassis" value="<?= $team['chassis'] ?>">
  <input type="text" placeholder="Power Unit" name="power_unit" value="<?= $team['power_unit'] ?>">
  <input type="number" placeholder="First Entry (Year)" name="first_team_entry" value="<?= $team['first_team_entry'] ?>">
  <input type="number" placeholder="Championships" name="world_championships" value="<?= $team['world_championships'] ?>">
  <input type="text" placeholder="Highest Race Finish" name="highest_race_finish" value="<?= $team['highest_race_finish'] ?>">
  <input type="number" placeholder="Pole Positions" name="pole_positions" value="<?= $team['pole_positions'] ?>">
  <input type="number" placeholder="Fastest Laps" name="fastest_laps" value="<?= $team['fastest_laps'] ?>">
  <label for="ranking">Ranking</label>
  <input type="number" placeholder="Ranking" name="ranking" value="<?= $team['ranking'] ?>" required>

  <label>Current Image:</label><br>
  <img src="<?= $team['team_image'] ?>" alt="Team Image" style="width:200px;"><br><br>

  <input type="file" name="team_image" accept="image/*">
  <button type="submit">Update Team</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $new_ranking = (int)$_POST['ranking'];

  $stmt = $conn->prepare("SELECT ranking, team_image FROM f1_teams WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($current_ranking, $current_image);
  $stmt->fetch();
  $stmt->close();

  $imagePath = $current_image;
  if (!empty($_FILES['team_image']['name'])) {
    $target_dir = "uploads/";
    $imagePath = $target_dir . basename($_FILES["team_image"]["name"]);
    move_uploaded_file($_FILES["team_image"]["tmp_name"], $imagePath);
  }

  $conn->begin_transaction();

  try {
    $stmt = $conn->prepare("UPDATE f1_teams SET ranking = -999 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    if ($new_ranking < $current_ranking) {
      $stmt = $conn->prepare("UPDATE f1_teams SET ranking = ranking + 1 WHERE ranking >= ? AND ranking < ?");
      $stmt->bind_param("ii", $new_ranking, $current_ranking);
    } elseif ($new_ranking > $current_ranking) {
      $stmt = $conn->prepare("UPDATE f1_teams SET ranking = ranking - 1 WHERE ranking <= ? AND ranking > ?");
      $stmt->bind_param("ii", $new_ranking, $current_ranking);
    }

    if ($new_ranking != $current_ranking) {
      $stmt->execute();
      $stmt->close();
    }

    $stmt = $conn->prepare("UPDATE f1_teams SET 
      full_team_name=?, base=?, team_chief=?, technical_chief=?, chassis=?, power_unit=?, 
      first_team_entry=?, world_championships=?, highest_race_finish=?, 
      pole_positions=?, fastest_laps=?, ranking=?, team_image=? 
      WHERE id=?");

    $stmt->bind_param("ssssssiiisiisi",
      $_POST['full_team_name'], $_POST['base'], $_POST['team_chief'],
      $_POST['technical_chief'], $_POST['chassis'], $_POST['power_unit'],
      $_POST['first_team_entry'], $_POST['world_championships'], $_POST['highest_race_finish'],
      $_POST['pole_positions'], $_POST['fastest_laps'], $new_ranking, $imagePath, $id
    );

    $stmt->execute();
    $stmt->close();

    $conn->commit();
    header("Location: team_dashboard.php");
    exit;
  } catch (Exception $e) {
    $conn->rollback();
    echo "<p style='color:red;'>Update failed: " . $e->getMessage() . "</p>";
  }
}
?>

</body>
</html>
