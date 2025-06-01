<?php
include("db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Customer information
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Appointment information
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];

    // Save customer info to 'customers' table
    $add_customer = "INSERT INTO customers (first_name, last_name, phone, email) VALUES ('$first_name', '$last_name', '$phone', '$email')";
    if ($connection->query($add_customer) === TRUE) {
        $customer_id = $connection->insert_id; // Get inserted customer ID

        // Save appointment to 'appointments' table
        $add_appointment = "INSERT INTO appointments (customer_name, date, time, service) VALUES ('$first_name $last_name', '$date', '$time', '$service')";
        if ($connection->query($add_appointment) === TRUE) {
            echo "<div class='alert alert-success'>Your appointment has been successfully created!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $connection->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: " . $connection->error . "</div>";
    }
}

// Get list of services from the database
$service_query = "SELECT * FROM services";
$service_result = $connection->query($service_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- AdminLTE and FontAwesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
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
            color: white;
            max-width: 600px;
            margin: 50px auto 80px auto;
            box-shadow: 0 0 35px rgba(255, 255, 255, 0.25);
            position: relative;
            z-index: 10;
            animation: fadeInUp 1.2s ease forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            color: #5dade2;
            font-weight: bold;
            margin-bottom: 25px;
            text-align: center;
            letter-spacing: 1px;
            text-shadow: 0 0 8px #f8cdda55;
        }
        .form-group label {
            font-weight: bold;
            color: #f0f0f0;
            letter-spacing: 0.02em;
        }
        .form-control {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px #2c3e5055;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #5dade2;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 22px;
            font-size: 1.08rem;
            box-shadow: 0 4px 12px #5dade2aa;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #3498db;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 22px;
            font-size: 1.08rem;
            margin-left: 5px;
            box-shadow: 0 4px 10px #6c757d99;
            transition: background-color 0.3s;
            color: white !important;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .alert {
            margin-top: 15px;
            font-weight: bold;
            text-align: center;
            border-radius: 10px;
        }
        .navbar {
            background-color: rgba(0,0,0,0.7) !important;
            box-shadow: 0 0 20px #3498dbbb;
            font-weight: 700;
            font-size: 20px;
            letter-spacing: 0.05em;
        }
        .navbar-brand {
            color: #5dade2 !important;
            text-shadow: 0 0 12px #3498db;
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
        @media (max-width: 600px) {
            .content-wrapper {
                padding: 12px;
                max-width: 98vw;
            }
            h2 {
                font-size: 1.2rem;
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

    <!-- Content -->
    <div class="container">
        <div class="content-wrapper">
            <h2>Book Appointment</h2>
            <form method="POST">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="time" name="time" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Service</label>
                    <select name="service" class="form-control" required>
                        <option value="">Select Service</option>
                        <?php while ($service = $service_result->fetch_assoc()): ?>
                            <option value="<?= $service['name'] ?>"><?= $service['name'] ?> - <?= $service['price'] ?> TL</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-calendar-check"></i> Book Appointment</button>
                    <a href="login_selection.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Home</a>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Particle JS -->
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

<!-- JS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>