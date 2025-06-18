<?php
include 'config.php';
session_start();
$loggedIn = isset($_SESSION['user_id']);
$username = $loggedIn ? $_SESSION['first_name'] : '';
$email = $loggedIn ? $_SESSION['email'] : '';

$recent_races = $conn->query(" SELECT * FROM usersinfo  ");; 


?>
 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Navbar with Dropdown</title>
  <style>
    * {
      margin: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #1a1a1a;
      color: #000;
      padding: 20px;
    }

    .container {
      max-width: 100%;
      margin: auto;
    }

    header {
      display: flex;
      justify-content: space-between;
      background-color: black;
      align-items: center;
      margin-bottom: 15px;
      color: #000000;
      padding: 15px;
      border-radius: 10px;
      position: relative;
    }

    .nav-brand {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 1.5rem;
      font-weight: bold;
      color: #fff;
    }

    .nav-brand i {
      color: #dc2626;
      font-size: 2rem;
    }

    .brand-elite {
      color: rgb(255, 0, 0);
    }

    nav {
      color:white;
      display: flex;
      align-items: center;
    }

    nav a {
      margin-left: 24px;
      text-decoration: none;
      color:white;
      font-size: 14px;
      position: relative;
    }

    .dropdown {
      margin-left:5px;
      position: relative;
      cursor: pointer;
    }
    .dropdown-content {

      display: none;
      position: absolute;
      background-color:rgb(0, 0, 0);
      min-width: 120px;

      padding:5px;
        right: 0;
  left: auto;
  max-width: 200px;
  overflow-wrap: break-word;

      border-radius: 8px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.3);
      z-index: 100;
    }

    .dropdown-content a {
  right: 0;
  left: auto;


      display: block;
      padding: 10px ;
      text-decoration: none;
      color: white;
      font-size: 14px;
    }

    .dropdown-content a:hover {
                        color:rgb(255, 0, 0);
    }

    a:hover {
                        color:rgb(255, 0, 0);
    }
    .dropdown:hover .dropdown-content {
      display: block;
    }


    span {
      color: while;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <header>
      <div class="nav-brand">
        <i class="fas fa-flag"></i>
        <span>F1 <span class="brand-elite">Elite</span></span>
      </div>

      <nav>
        <a href="#home">Home</a>
        <a href="#teams">Teams</a>
        <a href="#drivers">Drivers</a>
        <a href="#races">Races</a>

        <div class="dropdown">
          <a href="#">Admin</a>
          <div class="dropdown-content">
            <a href="team_dashboard.php">Teams</a>
            <a href="driver_dashboard.php">Drivers</a>
            <a href="race_dashboard.php">Races</a>
          </div>
        </div>
        <div class="dropdown">
          <a href="edit_profile.php">Profile</a>
          <div class="dropdown-content">
           
            <div class="user-info">
  <div class="username"><?= htmlspecialchars($username ?: 'Guest') ?></div>
  <div class="email"><?= htmlspecialchars($email ?: 'Not logged in') ?></div>
</div>
            <a href="Login/logout.php">Logout</a>

           
          </div>
        </div>

      </nav>
    </header>
  </div>
</body>

  <script>
    const profile = document.getElementById('dropdown');
    const dropdown = document.getElementById('dropdown-content');
    if (profile && dropdown) {
      profile.addEventListener('click', () => {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      });
    }
  </script>
</html>
