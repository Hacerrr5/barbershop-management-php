<?php
include("db_config.php");

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM customers WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Customer not found.";
    exit();
}

$customer = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE customers SET first_name=?, last_name=?, phone=?, email=? WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $first_name, $last_name, $phone, $email, $id);
    if ($stmt->execute()) {
        header("Location: customer_list.php");
        exit();
    } else {
        $errorMessage = "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Customer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- AdminLTE + FontAwesome -->
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
    }

    .form-control:focus {
      box-shadow: inset 0 0 12px #f8cdda;
      outline: none;
      background-color: rgba(255,255,255,0.1);
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
      <h2>Update Customer Information</h2>

      <?php
        if (isset($errorMessage)) {
            echo "<div class='alert alert-danger'>{$errorMessage}</div>";
        }
      ?>

      <form method="POST">
        <div class="form-group">
          <label for="first_name">First Name:</label>
          <input type="text" id="first_name" name="first_name" class="form-control" value="<?= htmlspecialchars($customer['first_name']) ?>" required>
        </div>
        <div class="form-group">
          <label for="last_name">Last Name:</label>
          <input type="text" id="last_name" name="last_name" class="form-control" value="<?= htmlspecialchars($customer['last_name']) ?>" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone:</label>
          <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($customer['phone']) ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($customer['email']) ?>" required>
        </div>
        <div class="text-center mt-4">
          <button type="submit" name="update" class="btn btn-success mr-2"><i class="fas fa-save"></i> Update</button>
          <a href="customer_list.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
      </form>
    </div>
  </div>

  <!-- JS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>