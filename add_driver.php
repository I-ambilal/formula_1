<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageName = $_FILES['driver_image']['name'];
    $imageTmp = $_FILES['driver_image']['tmp_name'];
    $uploadDir = "uploads/";
    $imagePath = $uploadDir . basename($imageName);

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($imageTmp, $imagePath)) {
        $stmt = $conn->prepare("INSERT INTO drivers (
            driver_rank, name, team, country, podiums, points,
            grands_prix_entered, world_championships,
            highest_race_finish, highest_grid_position,
            date_of_birth, place_of_birth, driver_image
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("isssiiiiisiss",
            $_POST['driver_rank'],
            $_POST['name'],
            $_POST['team'],
            $_POST['country'],
            $_POST['podiums'],
            $_POST['points'],
            $_POST['grands_prix_entered'],
            $_POST['world_championships'],
            $_POST['highest_race_finish'],
            $_POST['highest_grid_position'],
            $_POST['date_of_birth'],
            $_POST['place_of_birth'],
            $imagePath
        );

        $stmt->execute();
        header("Location: driver_dashboard.php");
        exit;
    } else {
        echo "<p style='color:red;'>Failed to upload image.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Driver</title>
<link rel="stylesheet" href="f1_style.css?v=2">

</head>
<body>
<h2>Add New Driver</h2>
<a href="driver_dashboard.php" >← Back</a>

<form method="post" enctype="multipart/form-data">
  <input type="number" name="driver_rank" placeholder="Rank" required>
  <input type="text" name="name" placeholder="Name" required>
  <input type="text" name="team" placeholder="Team" required>
  <input type="text" name="country" placeholder="Country" required>
  <input type="number" name="podiums" placeholder="Podiums" required>
  <input type="number" name="points" placeholder="Points" required>
  <input type="number" name="grands_prix_entered" placeholder="GPs Entered" required>
  <input type="number" name="world_championships" placeholder="Championships" required>
  <input type="text" name="highest_race_finish" placeholder="Highest Race Finish" required>
  <input type="number" name="highest_grid_position" placeholder="Highest Grid Position" required>
  <input type="date" name="date_of_birth" required>
  <input type="text" name="place_of_birth" placeholder="Place of Birth" required>
  <input type="file" name="driver_image" accept="image/*" required>
  <button type="submit">Save</button>
</form>
</body>
</html>
