<?php
include("db_config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $id = $_POST['id'];
    $name = $connection->real_escape_string($_POST['name']);
    $price = $connection->real_escape_string($_POST['price']);

    // Update in database
    $query = "UPDATE services SET name='$name', price='$price' WHERE id=$id";
    if ($connection->query($query)) {
        header("Location: service_list.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>❌ Error while updating service: " . $connection->error . "</div>";
    }
}

// Fetch current service info
$id = $_GET['id'];
$query = "SELECT * FROM services WHERE id=$id";
$result = $connection->query($query);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Update Service</title>
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

    h2, .box-title {
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
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
    }
    .form-control:focus {
      box-shadow: inset 0 0 12px #f8cdda;
      outline: none;
      background-color: rgba(255,255,255,0.2);
      color: white;
    }

    .btn-success {
      background-color: #5dade2;
      border: none;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 15px;
      box-shadow: 0 0 15px #5dade2cc;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }
    .btn-success:hover {
      background-color: #3498db;
      box-shadow: 0 0 20px #3498dbcc;
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
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      text-align: center;
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
  </style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <div class="content-wrapper">
      <h2>Update Service</h2>

      <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" />
        <div class="form-group">
          <label for="name">Service Name</label>
          <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required />
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($row['price']); ?>" required min="0" step="0.01" />
        </div>
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
          <a href="service_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
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