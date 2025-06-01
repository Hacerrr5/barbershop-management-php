<?php
include("db_config.php");
$deleteMessage = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM appointments WHERE id = $id";

    if ($connection->query($sql) === TRUE) {
        $deleteMessage = "✅ Appointment deleted successfully.";
        header("refresh:2;url=appointment_list.php"); // Redirect after 2 seconds
    } else {
        $deleteMessage = "❌ Error occurred: " . $connection->error;
    }
} else {
    $deleteMessage = "⚠️ Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Delete Appointment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Outfit', sans-serif;
      background-image: url('https://i.pinimg.com/originals/e7/8b/b3/e78bb38e26f8f2d43a7f7b51279d93e7.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      animation: gradientMove 20s ease infinite;
    }
    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .message-box {
      background: rgba(0, 0, 0, 0.75);
      padding: 30px;
      border-radius: 20px;
      max-width: 480px;
      width: 90%;
      text-align: center;
      box-shadow: 0 0 25px #00ffffaa;
      animation: fadeIn 1s ease forwards;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(15px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .message-box h2 {
      font-weight: 700;
      color: #00ffff;
      font-size: 2rem;
      margin-bottom: 15px;
      letter-spacing: 1.2px;
      text-shadow: 0 0 8px #00ffffbb;
    }

    .message-box p {
      font-size: 1.15rem;
      margin-bottom: 15px;
      color: #e0e0e0;
    }

    .spinner-border {
      width: 3rem;
      height: 3rem;
      border-width: 0.25em;
      border-top-color: #00ffff;
      animation: spin 1s linear infinite;
      margin: 0 auto;
      border-radius: 50%;
      border-style: solid;
      border-color: rgba(0,255,255,0.2);
      border-top-color: #00ffff;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="message-box">
    <h2>Operation Result</h2>
    <p><?php echo $deleteMessage; ?></p>
    <p>Please wait, you are being redirected...</p>
    <div class="spinner-border" role="status" aria-label="Loading"></div>
  </div>

  <!-- AdminLTE JS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>