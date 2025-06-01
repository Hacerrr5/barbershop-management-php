<?php
include("db_config.php");

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$id = $connection->real_escape_string($_GET['id']);
$query = "SELECT * FROM appointments WHERE id = $id";
$result = $connection->query($query);

if ($result->num_rows == 0) {
    echo "Appointment not found.";
    exit();
}

$appointment = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $customer_name = $connection->real_escape_string($_POST['customer_name']);
    $date = $connection->real_escape_string($_POST['date']);
    $time = $connection->real_escape_string($_POST['time']);
    $service = $connection->real_escape_string($_POST['service']);

    $sql = "UPDATE appointments SET customer_name='$customer_name', date='$date', time='$time', service='$service' WHERE id=$id";
    if ($connection->query($sql) === TRUE) {
        header("Location: appointment_list.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>❌ Error: " . $connection->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Update Appointment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Outfit', sans-serif;
      background: linear-gradient(-45deg, #1d2b64, #f8cdda, #2c3e50, #3498db);
      background-size: 400% 400%;
      animation: gradientMove 15s ease infinite;
      color: white;
    }
    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .content-wrapper {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      padding: 30px;
      border-radius: 20px;
      max-width: 600px;
      margin: 50px auto;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
      animation: fadeIn 1.2s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      color: #f8cdda;
      font-weight: 700;
      margin-bottom: 25px;
      text-align: center;
      text-shadow: 0 0 8px #f8cdda99;
    }

    .form-group label {
      font-weight: 600;
      color: #f8cdda;
      display: block;
      margin-bottom: 6px;
      text-shadow: 0 0 6px #2c3e5099;
    }

    .form-control {
      border-radius: 10px;
      border: none;
      padding: 10px 15px;
      font-size: 16px;
      box-shadow: inset 0 0 8px #3498db99;
      transition: box-shadow 0.3s ease;
      background-color: transparent;
      color: white;
    }
    .form-control:focus {
      box-shadow: inset 0 0 12px #f8cdda;
      outline: none;
      background-color: rgba(255,255,255,0.1);
      color: white;
    }

    .btn-success, .btn-primary {
      background-color: #5dade2;
      border: none;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 15px;
      box-shadow: 0 0 15px #5dade2cc;
      transition: background-color 0.3s ease;
      color: white;
    }
    .btn-success:hover, .btn-primary:hover {
      background-color: #3498db;
      box-shadow: 0 0 20px #3498dbcc;
      color: white;
    }

    .btn-secondary {
      background-color: rgba(255, 255, 255, 0.2);
      border: none;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 15px;
      color: white;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
      transition: background-color 0.3s ease;
      margin-left: 10px;
      text-decoration: none;
      display: inline-block;
    }
    .btn-secondary:hover {
      background-color: rgba(255, 255, 255, 0.4);
      color: #3498db;
      box-shadow: 0 0 20px #3498dbcc;
    }

    .alert {
      margin-top: 15px;
      font-weight: 700;
      text-align: center;
      border-radius: 10px;
      padding: 12px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
    }
    .alert-success {
      background-color: #28a745cc;
      color: #e0f7e9;
    }
    .alert-danger {
      background-color: #e74c3ccc;
      color: #fbeaea;
    }

    .main-header.navbar {
      background-color: rgba(0, 0, 0, 0.6);
      box-shadow: 0 0 15px rgba(0,0,0,0.8);
    }
    .navbar-brand {
      font-weight: 700;
      color: white !important;
      font-size: 1.3rem;
      text-shadow: 0 0 5px #3498dbaa;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <span class="navbar-brand">Salon Management Panel</span>
    </nav>

    <!-- Content -->
    <div class="content-wrapper">
      <h2>Update Appointment</h2>

      <?php if (isset($error)) { echo "<div class='alert alert-danger'>❌ $error</div>"; } ?>

      <form method="POST" action="">
        <div class="form-group">
          <label>Customer Name</label>
          <input type="text" name="customer_name" class="form-control" value="<?= htmlspecialchars($appointment['customer_name']) ?>" required />
        </div>
        <div class="form-group">
          <label>Date</label>
          <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($appointment['date']) ?>" required />
        </div>
        <div class="form-group">
          <label>Time</label>
          <input type="time" name="time" class="form-control" value="<?= htmlspecialchars($appointment['time']) ?>" required />
        </div>
        <div class="form-group">
          <label>Service</label>
          <input type="text" name="service" class="form-control" value="<?= htmlspecialchars($appointment['service']) ?>" required />
        </div>
        <div class="text-center mt-4">
          <button type="submit" name="update" class="btn btn-success mr-2"><i class="fas fa-sync-alt"></i> Update</button>
          <a href="appointment_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
      </form>
    </div>
  </div>

  <!-- AdminLTE JS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>