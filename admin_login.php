<?php
session_start();

// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=YOUR_DATABASE_NAME;charset=utf8", "YOUR_DATABASE_USER", "YOUR_DATABASE_PASSWORD");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT password FROM admins WHERE username=?");
    $stmt->execute([$username]);
    $row = $stmt->fetch();

    // Use password_verify if hash is stored
    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: customer_list.php");
        exit;
    } else {
        $error = "Incorrect username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');
    html, body { height: 100%; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; overflow: hidden; background: #222; }
    #particles-js { position: fixed; width: 100vw; height: 100vh; top: 0; left: 0; z-index: 0; }
    .login-box {
      position: absolute;
      top: 52%; left: 50%; transform: translate(-50%, -50%);
      background: rgba(34, 41, 58, 0.97);
      padding: 44px 38px 32px 38px;
      border-radius: 19px;
      box-shadow: 0 0 36px #ff00ff80;
      color: #fff;
      min-width: 340px;
      z-index: 2;
      display: flex; flex-direction: column; align-items: center;
    }
    .login-box h2 {
      margin-bottom: 20px; font-size: 2.2rem; color: #ff99ff;
      text-shadow: 0 0 8px #fff, 0 0 16px #ff00ff99, 0 0 24px #ff00ffcc;
      animation: glowText 3s ease-in-out infinite alternate;
    }
    @keyframes glowText {
      from { text-shadow: 0 0 6px #fff, 0 0 12px #ff00ff66, 0 0 18px #ff00ff88; }
      to { text-shadow: 0 0 20px #fff, 0 0 38px #ff00ff, 0 0 60px #ff00ff; }
    }
    .form-group { width: 100%; margin-bottom: 16px; }
    .form-group label { color: #fff; font-weight: 600; margin-bottom: 6px; display: block; letter-spacing: 0.5px; }
    .form-control {
      width: 100%; padding: 11px 14px; font-size: 1.06rem; border: none;
      border-radius: 9px; background: #22293a; color: #fff; margin-top: 2px;
      box-shadow: 0 2px 8px #2c3e5055; outline: none; transition: box-shadow 0.25s;
    }
    .form-control:focus { box-shadow: 0 0 16px #ff00ff99; }
    .btn-style {
      padding: 13px 28px; font-size: 1.07rem;
      background: linear-gradient(45deg, #ff00ff, #ff99ff);
      border: none; border-radius: 19px; margin: 10px 0 0 0;
      cursor: pointer;
      box-shadow: 0 0 10px #ff00ff88, 0 0 20px #ff00ffaa, 0 0 30px #ff00ffcc;
      color: white; font-weight: 600; transition: all 0.35s ease;
      letter-spacing: 1px; user-select: none; position: relative; overflow: hidden; z-index: 1; width: 100%;
    }
    .btn-style::before {
      content: ""; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
      background: linear-gradient(60deg, transparent, #ff00ff99, transparent);
      transform: rotate(25deg); opacity: 0; transition: all 0.5s;
    }
    .btn-style:hover::before { opacity: 1; top: -20%; left: -20%; }
    .btn-style:hover {
      box-shadow: 0 0 20px #ff00ffcc, 0 0 40px #ff00ffee, 0 0 60px #ff00ff;
      transform: scale(1.055);
    }
    .error {
      background: #e74c3c; color: #fff; padding: 10px 0; border-radius: 10px;
      margin-bottom: 14px; width: 100%; text-align: center; box-shadow: 0 0 10px #e74c3c80;
    }
  </style>
</head>
<body>
  <div id="particles-js"></div>
  <div class="login-box">
    <h2>Admin Login</h2>
    <?php if(isset($error)): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" autocomplete="off">
      <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Username" required autocomplete="off" />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required autocomplete="off" />
      </div>
      <button type="submit" class="btn-style">Login</button>
    </form>
  </div>
  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": { "value": 90, "density": { "enable": true, "value_area": 900 } },
        "color": { "value": "#ff99ff" },
        "shape": { "type": "circle", "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 } },
        "opacity": { "value": 0.55, "random": true },
        "size": { "value": 4, "random": true },
        "line_linked": {
          "enable": true,
          "distance": 150,
          "color": "#ff99ff",
          "opacity": 0.25,
          "width": 1
        },
        "move": {
          "enable": true,
          "speed": 2,
          "direction": "none",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "bounce": false
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true },
        "modes": {
          "grab": { "distance": 400, "line_linked": { "opacity": 1 } },
          "bubble": { "distance": 200, "size": 6, "duration": 2, "opacity": 0.6, "speed": 3 },
          "repulse": { "distance": 100, "duration": 0.4 },
          "push": { "particles_nb": 4 },
          "remove": { "particles_nb": 2 }
        }
      },
      "retina_detect": true
    });
  </script>
</body>
</html>