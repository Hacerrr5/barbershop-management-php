<?php include("db_config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Appointment List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Google Font: Outfit -->
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Outfit', sans-serif;
      background: linear-gradient(-45deg, #1d2b64, #f8cdda, #2c3e50, #3498db);
      background-size: 400% 400%;
      animation: gradientMove 15s ease infinite;
      color: white;
      overflow-x: hidden;
      position: relative;
      min-height: 100vh;
    }
    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .content-wrapper {
      background: rgba(0, 0, 0, 0.65);
      backdrop-filter: blur(12px);
      padding: 30px;
      border-radius: 25px;
      margin: 50px auto 80px auto;
      width: 90%;
      max-width: 1100px;
      box-shadow: 0 0 35px rgba(255, 255, 255, 0.25);
      position: relative;
      z-index: 10;
      animation: fadeInUp 1.2s ease forwards;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    nav.main-header.navbar {
      background-color: rgba(0,0,0,0.7) !important;
      box-shadow: 0 0 20px #3498dbbb;
      font-weight: 700;
      font-size: 20px;
      letter-spacing: 0.05em;
    }
    nav.main-header.navbar .navbar-brand {
      color: #5dade2;
      text-shadow: 0 0 12px #3498db;
    }
    aside.main-sidebar {
      background: linear-gradient(180deg, #0a0a0a 0%, #1a1a1a 100%);
      box-shadow: 3px 0 15px #2c3e5077;
      font-weight: 600;
    }
    aside.main-sidebar .brand-link {
      background-color: #151515;
      font-size: 18px;
      color: #5dade2;
      text-shadow: 0 0 10px #2980b9;
    }
    aside.main-sidebar .nav-sidebar .nav-link {
      font-size: 17px;
      color: #bdc3c7;
      transition: 0.25s ease;
    }
    aside.main-sidebar .nav-sidebar .nav-link.active,
    aside.main-sidebar .nav-sidebar .nav-link:hover {
      background-color: #2980b9;
      color: white;
      box-shadow: 0 0 12px #3498db;
    }
    aside.main-sidebar .nav-sidebar .nav-icon {
      color: #5dade2;
    }
    .nav-item a {
      font-weight: 600;
      color: white !important;
      font-size: 18px;
      transition: 0.3s ease;
      letter-spacing: 0.04em;
    }
    .nav-item a:hover {
      color: #f8cdda !important;
      text-shadow: 0 0 12px #f8cdda;
    }
    .nav-item a.active {
      background-color: transparent !important;
    }
    .box-header {
      background: rgba(255, 255, 255, 0.12);
      border-radius: 18px;
      text-align: center;
      padding: 18px 25px;
      margin-bottom: 30px;
      box-shadow: 0 0 15px rgba(255,255,255,0.18);
    }
    .box-header h3 {
      margin: 0;
      font-size: 32px;
      font-weight: 700;
      color: #f0f0f0;
      letter-spacing: 1.2px;
      text-shadow: 0 0 8px #5dade2;
    }
    table.table {
      background-color: rgba(255,255,255,0.95);
      color: #222;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.12);
      font-size: 16px;
      font-weight: 500;
    }
    table.table thead th {
      background-color: #2980b9;
      color: white;
      font-weight: 700;
      border: none !important;
      text-align: center;
      padding: 14px 10px;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      box-shadow: inset 0 -3px 5px rgba(0,0,0,0.15);
    }
    table.table tbody td {
      text-align: center;
      padding: 14px 10px;
      border-top: 1px solid #ddd;
      vertical-align: middle;
      background: rgba(255,255,255,0.92);
      color: #222;
    }
    table.table tbody tr:hover {
      background: #eaf4ff;
      color: #1565c0;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.25s ease;
    }
    .btn-primary {
      background-color: #5dade2;
      border-color: #5dade2;
      font-weight: 600;
      box-shadow: 0 4px 8px #5dade2aa;
      transition: background-color 0.3s ease;
      color: white !important;
    }
    .btn-primary:hover {
      background-color: #3498db;
      border-color: #2980b9;
      box-shadow: 0 6px 12px #2980b9cc;
    }
    .btn-warning {
      background-color: #f1c40f;
      border-color: #f1c40f;
      color: black !important;
      font-weight: 600;
      box-shadow: 0 4px 8px #f1c40faa;
      transition: background-color 0.3s ease;
    }
    .btn-warning:hover {
      background-color: #d4ac0d;
      border-color: #b7950b;
      box-shadow: 0 6px 12px #b7950bcc;
      color: #fff !important;
    }
    .btn-danger {
      background-color: #e74c3c;
      border-color: #e74c3c;
      font-weight: 600;
      box-shadow: 0 4px 8px #e74c3caa;
      transition: background-color 0.3s ease;
    }
    .btn-danger:hover {
      background-color: #c0392b;
      border-color: #a93226;
      box-shadow: 0 6px 12px #a93226cc;
    }
    .ortalama {
      color: #fff;
      margin-top: 15px;
      font-weight: 600;
      text-align: center;
      background: rgba(52,152,219,0.5);
      border-radius: 8px;
      letter-spacing: 0.04em;
      font-size: 1.05em;
      box-shadow: 0 2px 8px #5dade288;
    }
    #particle-container {
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      pointer-events: none;
      z-index: 5;
      overflow: hidden;
    }
    .particle {
      position: absolute;
      background: rgba(255, 255, 255, 0.85);
      border-radius: 50%;
      filter: drop-shadow(0 0 3px rgba(255,255,255,0.8));
      opacity: 0.8;
      animation: floatUp 10s linear infinite;
      mix-blend-mode: screen;
    }
    @keyframes floatUp {
      0% {
        transform: translateY(100vh) scale(1);
        opacity: 0.8;
      }
      100% {
        transform: translateY(-20vh) scale(0.5);
        opacity: 0;
      }
    }
    @media (max-width: 480px) {
      .content-wrapper {
        padding: 12px;
      }
      .box-header h3 {
        font-size: 1.2rem;
      }
      table.table {
        font-size: 13px;
      }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div id="particle-container"></div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <span class="navbar-brand">Salon Management Panel</span>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">AdminLTE Salon</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
          <li class="nav-item"><a href="customer_list.php" class="nav-link"><i class="nav-icon fas fa-users"></i><p>Customers</p></a></li>
          <li class="nav-item"><a href="appointment_list.php" class="nav-link"><i class="nav-icon fas fa-calendar-alt"></i><p>Appointments</p></a></li>
          <li class="nav-item"><a href="service_list.php" class="nav-link"><i class="nav-icon fas fa-cogs"></i><p>Services</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content -->
  <div class="content-wrapper">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Appointment List</h3>
      </div>
      <div class="box-body">
        <a href="add_appointment.php" class="btn btn-primary mb-3">Add New Appointment</a>

        <table class="table table-bordered table-striped text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Customer Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Service</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM appointments";
            $result = $connection->query($query);
            $count = 0;
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['time']}</td>
                    <td>{$row['service']}</td>
                    <td>
                      <a href='update_appointment.php?id={$row['id']}' class='btn btn-sm btn-warning'>Update</a>
                      <a href='delete_appointment.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this appointment?');\">Delete</a>
                    </td>
                </tr>";
                $count++;
            }

            if ($count > 0) {
              echo "<tr><td colspan='6' class='ortalama'>Total Appointments: $count</td></tr>";
            } else {
              echo "<tr><td colspan='6' class='text-center text-white'>No appointments have been added yet.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Particles JS -->
<script>
  const particleContainer = document.getElementById('particle-container');
  function randomRange(min, max) {
    return Math.random() * (max - min) + min;
  }
  function createParticle() {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    const size = randomRange(6, 14);
    particle.style.width = size + 'px';
    particle.style.height = size + 'px';
    particle.style.left = randomRange(0, window.innerWidth) + 'px';
    const duration = randomRange(8000, 14000);
    particle.style.animationDuration = duration + 'ms';
    particle.style.filter = `drop-shadow(0 0 ${size/3}px rgba(255,255,255,0.9))`;
    particleContainer.appendChild(particle);
    particle.addEventListener('animationiteration', () => {
      particle.style.left = randomRange(0, window.innerWidth) + 'px';
      particle.style.animationDuration = randomRange(8000, 14000) + 'ms';
    });
  }
  for(let i=0; i<50; i++) {
    createParticle();
  }
  window.addEventListener('resize', () => {
    document.querySelectorAll('.particle').forEach(p => {
      p.style.left = randomRange(0, window.innerWidth) + 'px';
    });
  });
</script>

<!-- AdminLTE JS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>