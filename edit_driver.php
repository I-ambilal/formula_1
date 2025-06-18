<?php
include 'config.php';

if (!isset($_GET['rank'])) {
    die("Driver rank not specified.");
}

$original_rank = (int)$_GET['rank'];

$stmt = $conn->prepare("SELECT * FROM drivers WHERE driver_rank = ?");
$stmt->bind_param("i", $original_rank);
$stmt->execute();
$result = $stmt->get_result();
$driver = $result->fetch_assoc();

if (!$driver) {
    die("Driver not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newImagePath = $driver['driver_image'];

    if (!empty($_FILES["driver_image"]["name"])) {
        if ($newImagePath && file_exists($newImagePath)) {
            unlink($newImagePath);
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["driver_image"]["name"]);
        move_uploaded_file($_FILES["driver_image"]["tmp_name"], $target_file);
        $newImagePath = $target_file;
    }

    $new_rank = (int)$_POST['driver_rank'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("UPDATE drivers SET driver_rank = -1 WHERE driver_rank = ?");
        $stmt->bind_param("i", $original_rank);
        $stmt->execute();
        $stmt->close();

        if ($new_rank < $original_rank) {
            $stmt = $conn->prepare("UPDATE drivers SET driver_rank = driver_rank + 1 WHERE driver_rank >= ? AND driver_rank < ?");
            $stmt->bind_param("ii", $new_rank, $original_rank);
        } elseif ($new_rank > $original_rank) {
            $stmt = $conn->prepare("UPDATE drivers SET driver_rank = driver_rank - 1 WHERE driver_rank <= ? AND driver_rank > ?");
            $stmt->bind_param("ii", $new_rank, $original_rank);
        }

        if ($new_rank !== $original_rank) {
            $stmt->execute();
            $stmt->close();
        }

        $stmt = $conn->prepare("UPDATE drivers SET 
            driver_rank = ?, name = ?, team = ?, country = ?, podiums = ?, points = ?, 
            grands_prix_entered = ?, world_championships = ?, highest_race_finish = ?, 
            highest_grid_position = ?, date_of_birth = ?, place_of_birth = ?, driver_image = ?
            WHERE driver_rank = -1");

        $stmt->bind_param("isssiiiiisiss", 
            $new_rank, $_POST['name'], $_POST['team'], $_POST['country'],
            $_POST['podiums'], $_POST['points'], $_POST['grands_prix_entered'],
            $_POST['world_championships'], $_POST['highest_race_finish'],
            $_POST['highest_grid_position'], $_POST['date_of_birth'],
            $_POST['place_of_birth'], $newImagePath
        );

        $stmt->execute();
        $stmt->close();

        $conn->commit();
        header("Location: driver_dashboard.php");
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "<p style='color:red;'>Update failed: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Driver</title>
<link rel="stylesheet" href="f1_style.css?v=2">
</head>
<body>

<h2>Edit Driver</h2>
<a href="driver_dashboard.php" >← Back</a>


<form method="post" enctype="multipart/form-data">
    <label>Driver Ranking:</label>
    <input type="number" name="driver_rank" value="<?= $driver['driver_rank'] ?>" >

    <input type="text" name="name" value="<?= htmlspecialchars($driver['name']) ?>" >
    <input type="text" name="team" value="<?= htmlspecialchars($driver['team']) ?>" >
    <input type="text" name="country" value="<?= htmlspecialchars($driver['country']) ?>" >
    <input type="number" name="podiums" value="<?= $driver['podiums'] ?>" >
    <input type="number" name="points" value="<?= $driver['points'] ?>" >
    <input type="number" name="grands_prix_entered" value="<?= $driver['grands_prix_entered'] ?>" >
    <input type="number" name="world_championships" value="<?= $driver['world_championships'] ?>" >
    <input type="text" name="highest_race_finish" value="<?= htmlspecialchars($driver['highest_race_finish']) ?>" >
    <input type="number" name="highest_grid_position" value="<?= $driver['highest_grid_position'] ?>" >
    <input type="date" name="date_of_birth" value="<?= $driver['date_of_birth'] ?>" >
    <input type="text" name="place_of_birth" value="<?= htmlspecialchars($driver['place_of_birth']) ?>" >

    <label>Driver Image:</label>
    <input type="file" name="driver_image" accept="image/*">

    <button type="submit">Update Driver</button>
</form>

</body>
</html>
