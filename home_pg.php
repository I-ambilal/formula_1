<?php
include 'config.php';
include 'navbar.php';

$teams = $conn->query("SELECT * FROM f1_teams ORDER BY ranking");

$drivers = $conn->query("SELECT * FROM drivers ORDER BY driver_rank");


$recent_races = $conn->query(" SELECT * FROM races WHERE race_date ORDER BY race_date ");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>F1 Elite - Premium Formula 1 Experience</title>
  <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #0d0d0d;
  color: #f1f1f1;
  
}

a {
  color: inherit;
  text-decoration: none;
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: auto;
}


.hero {
  height: 89vh;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  text-align: center;
  margin-bottom: 10px;
  
}
.hero-background {
    border-radius: 10px;

    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.2), rgba(0, 0, 0, 1), rgba(59, 130, 246, 0.2));
}

.hero-background::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 25px 25px, rgba(255, 255, 255, 0.02) 2%, transparent 50%),
        radial-gradient(circle at 75px 75px, rgba(255, 255, 255, 0.02) 2%, transparent 50%);
    background-size: 100px 100px;
}

.hero-background {
  background-color: rgba(0, 0, 0, 0.6);
  position: absolute;
  inset: 0;
}

.hero-content {
  position: relative;
  z-index: 1;
  color: #fff;
}

.hero-icon {
  font-size: 4rem;
  color:rgb(199, 169, 169);
}

.hero-title {
        color:red;

  font-size: 3.5rem;
  margin-top: 10px;
}

.hero-subtitle {
  font-size: 1.3rem;
  margin-top: 10px;
}

.hero-stats {
  margin-top: 20px;
   margin-bottom: 30px;
  display: flex;
  justify-content: center;
  gap: 30px;
}

.stat {
  display: flex;
  flex-direction: column;
  align-items: center;
}
 
.stat i {
  font-size: 1.8rem;
  color: #ff0000;
}

.teams-section, .drivers-section, .races-section {
      border-radius: 10px;
      margin-bottom: 10px;

  padding: 60px 0;
  background-color: #111;
}

.section-title {
  text-align: center;
  font-size: 2rem;
  color: #ff0000;
  margin-bottom: 10px;
}

.section-subtitle {
  text-align: center;
  margin-bottom: 40px;
  color: #aaa;
}

.teams-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
  gap: 20px;
}
.drivers-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
}

.team-card {
  min-height: 50%;
  background: #1a1a1a;
  border: 1px solid #333;
  padding: 20px;
  border-radius: 10px;
  transition: 0.3s;
}
.driver-card {
  
  background: #1a1a1a;
  border: 1px solid #333;
  padding: 20px;
  border-radius: 10px;
  transition: 0.3s;
}

.team-card:hover, .driver-card:hover {
  border-color: #ff0000;
  transform: translateY(-5px);
}

.driver-card img {
  min-height: 400px;
  position:  center;
  border-radius: 10px;
  margin-bottom: 20px;
}

.races-section {
  padding: 40px 20px;
  color: white;
}

.section-title {
  text-align: center;
  margin-bottom: 30px;
  font-size: 2rem;
  color: red;
}

.races-container {
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.races-column {
  flex: 1 1 300px;
  border-radius: 10px;
  padding: 20px;
}

.races-column h3 {
  color: #fff;
  margin-bottom: 15px;
}

.race-card {
  min-height: 50%;
  background: #1a1a1a;
  border: 1px solid #333;
  padding: 20px;
  border-radius: 10px;
  transition: 0.3s;
}

.race-flag {
  width: 32px;
  height: 20px;
  object-fit: cover;
  border: 1px solid #555;
  border-radius: 4px;
}

.footer {
  background-color: #1a1a1a;
  text-align: center;
  padding: 20px;
  border-top: 2px solid #ff0000;
}

.footer-content {
  display: flex;
  justify-content: center;
  gap: 10px;
  font-size: 1.2rem;
  color: #fff;
}

.footer p {
  margin-top: 10px;
  font-size: 0.9rem;
  color: #aaa;
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  .hero-stats {
    flex-direction: column;
    gap: 10px;
  }
  .nav-menu {
    flex-direction: column;
    gap: 10px;
  }
}


.cta-button {
            background-color:rgb(255, 0, 0);
            color: #1c1c1c;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            transform: translateY(50px);
            animation: fadeInUp 1s forwards 1.5s;
        }

        .cta-button:hover {
            background-color:rgb(0, 0, 0);
                        color:rgb(255, 0, 0);
                                    transition: background-color 0.3s ease;


        }
</style>
</head>
<body>


<section id="home" class="hero">
  <div class="hero-background"></div>
  <div class="hero-content">
    <i class="fas fa-flag hero-icon"></i>
    <h1 class="hero-title">F1 ELITE</h1>
    <p class="hero-subtitle">Experience the pinnacle of motorsport</p>
    <div class="hero-stats">
      <div class="stat"><i class="fas fa-bolt"></i><span>350+ KM/H</span></div>
      <div class="stat"><i class="fas fa-trophy"></i><span>20 RACES</span></div>
      <div class="stat"><i class="fas fa-flag"></i><span>10 TEAMS</span></div>
    </div>
    <a class="cta-button"  href="signup.php">JOIN US</a> 
    <a class="cta-button"  href="login.php">LOGIN</a>
    </div>
</section>

<section id="teams" class="teams-section">
  <div class="container">
    <h2 class="section-title">Championship Teams</h2>
    <p class="section-subtitle">Discover the elite teams competing for the ultimate prize</p>
    <div id="teams-grid" class="teams-grid">
      <?php while($team = $teams->fetch_assoc()): ?>
        <div class="team-card">
<img src="<?= $team['team_image'] ?>" alt="Team Image" style="width:500px;">

          <h3><?= htmlspecialchars($team['full_team_name']) ?></h3>
          <p>Base: <?= htmlspecialchars($team['base']) ?></p>
          <p>Chassis: <?= htmlspecialchars($team['chassis']) ?></p>
          <p>World Championships: <?= $team['world_championships'] ?></p>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<section id="drivers" class="drivers-section">
  <div class="container">
    <h2 class="section-title">Elite Drivers</h2>
    <p class="section-subtitle">Meet the drivers racing at the edge of speed</p>
    <div class="drivers-grid">
      <?php while($driver = $drivers->fetch_assoc()): ?>
        <div class="driver-card">
          <img src="<?= htmlspecialchars($driver['driver_image']) ?>" alt="<?= $driver['name'] ?>" style="width:100%; max-height:200px; object-fit:cover;">
          <h3>#<?= $driver['driver_rank'] ?> <?= htmlspecialchars($driver['name']) ?></h3>
          <p>Team: <?= htmlspecialchars($driver['team']) ?></p>
          <p>Podiums: <?= $driver['podiums'] ?> | Points: <?= $driver['points'] ?></p>
          <p>DOB: <?= $driver['date_of_birth'] ?></p>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<section id="races" class="races-section">
  <div class="container">
    <h2 class="section-title">Race Calendar</h2>
    <div class="races-container">
     
      <div class="drivers-grid">
       
        <?php while($race = $recent_races->fetch_assoc()): ?>
          <div class="race-card">
            <?php if (!empty($race['race_flag'])): ?>
              <img src="<?= htmlspecialchars($race['race_flag']) ?>" alt="Flag" class="race-flag">
            <?php endif; ?>
            <strong><?= htmlspecialchars($race['name']) ?></strong><br>
            <?= htmlspecialchars($race['location']) ?><br>
            <?= date("F j, Y", strtotime($race['race_date'])) ?>
          </div>
        <?php endwhile; ?>
      </div>

</section>


<footer class="footer">
  <div class="container">
    <div class="footer-content">
      <i class="fas fa-flag"></i>
      <span>F1 Elite</span>
    </div>
    <p>&copy; 2024 F1 Elite. Premium Formula 1 Experience.</p>
  </div>
</footer>

</body>
</html>
