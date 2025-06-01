<?php
include("db_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Service List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Font and AdminLTE CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
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
      display: none;
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
    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 25px;
    }
    .service-card {
      background: rgba(255,255,255,0.97);
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(142, 68, 173, 0.3);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      color: #222;
      border: 2px solid #3498db33;
    }
    .service-card:hover {
      transform: translateY(-8px) scale(1.015);
      box-shadow: 0 12px 25px rgba(52,152,219,0.5);
      border-color: #5dade2cc;
    }
    .service-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-bottom: 3px solid #5dade2;
      background: #eee;
    }
    .service-content {
      padding: 15px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .service-name {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: #1565c0;
      text-align: center;
      letter-spacing: 0.04em;
      text-shadow: 0 0 8px #f8cdda55;
    }
    .service-price {
      font-size: 1.1rem;
      font-weight: 500;
      color: #6b6b6b;
      margin-bottom: 15px;
      text-align: center;
    }
    .btn-group {
      display: flex;
      justify-content: center;
      gap: 15px;
    }
    .btn {
      font-weight: 600;
      border-radius: 8px;
      padding: 8px 14px;
      font-size: 0.96rem;
      transition: background-color 0.3s ease, box-shadow 0.25s;
      border: none;
      cursor: pointer;
      text-decoration: none;
      color: white !important;
      user-select: none;
      box-shadow: 0 2px 6px #5dade277;
    }
    .btn-warning {
      background-color: #f1c40f;
      color: #222 !important;
      box-shadow: 0 4px 8px #f1c40faa;
    }
    .btn-warning:hover {
      background-color: #d4ac0d;
      box-shadow: 0 6px 12px #b7950bcc;
      color: #fff !important;
    }
    .btn-danger {
      background-color: #e74c3c;
      box-shadow: 0 4px 8px #e74c3caa;
    }
    .btn-danger:hover {
      background-color: #c0392b;
      box-shadow: 0 6px 12px #a93226cc;
    }
    .btn-primary {
      background-color: #5dade2;
      border-color: #5dade2;
      color: white !important;
      box-shadow: 0 4px 8px #5dade2aa;
    }
    .btn-primary:hover {
      background-color: #3498db;
      border-color: #2980b9;
      box-shadow: 0 6px 12px #2980b9cc;
    }
    .add-new-btn {
      display: block;
      margin: 0 auto 30px auto;
      width: 220px;
      text-align: center;
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
      .service-card img {
        height: 120px;
      }
      .service-name {
        font-size: 1.1rem;
      }
      .service-price {
        font-size: 1rem;
      }
      .content-wrapper {
        padding: 12px;
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

  <div class="content-wrapper">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Service List</h3>
      </div>
      <a href="add_service.php" class="btn btn-primary add-new-btn">Add New Service</a>

      <div class="services-grid">
        <?php
          $images = [
            "blow dry" => "https://st4.depositphotos.com/20363444/40961/i/450/depositphotos_409612684-stock-photo-young-woman-colorful-hair-blowing.jpg",
            "haircut" => "https://st.depositphotos.com/1743476/1276/i/450/depositphotos_12764853-stock-photo-hairdressing.jpg",
            "highlights" => "https://cdn.create.vista.com/api/media/small/769826136/stock-video-hair-stylist-doing-highlights-foil-beauty-salon-woman-dye-hair?videoStaticPreview=true&token=",
            "bridal updo" => "https://www.shutterstock.com/image-photo/hairdresser-makes-elegant-hairstyle-styling-260nw-1570230466.jpg",
            "bridal makeup" => "https://st2.depositphotos.com/4520505/6952/i/450/depositphotos_69522947-stock-photo-portrait-of-a-beautiful-bride.jpg",
            "manicure" => "https://www.shutterstock.com/image-photo/female-hand-long-coffinshaped-nails-260nw-2581028077.jpg",
            "hair wash" => "https://st2.depositphotos.com/1017986/7820/i/450/depositphotos_78204824-stock-photo-happy-young-woman-at-hair.jpg",
            "hair coloring" => "https://www.shutterstock.com/image-photo/hair-extensions-different-shades-closeup-260nw-2525116263.jpg",
            "eyebrow shaping" => "https://www.shutterstock.com/image-photo/eyebrow-tinting-correction-macro-photo-260nw-2585912511.jpg",
            "mustache removal" => "https://www.shutterstock.com/image-photo/hairdresser-combing-womans-hair-salon-260nw-2361563371.jpg",
            "skin care" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWY_V4rtf0QageJ1UZvuYhXNuJjgfC-bfQVA&s",
            "ombre" => "https://www.shutterstock.com/image-photo/hairstyle-ombre-color-highlight-hair-260nw-1546877792.jpg",
          ];
          $query = "SELECT * FROM services";
          $result = $connection->query($query);
          while ($row = $result->fetch_assoc()) {
            $name = strtolower(trim($row['name']));
            $img_url = isset($images[$name]) ? $images[$name] : "https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=600&q=80";
            echo "
              <div class='service-card'>
                <img src='{$img_url}' alt='{$row['name']}' />
                <div class='service-content'>
                  <div class='service-name'>{$row['name']}</div>
                  <div class='service-price'>{$row['price']} ₺</div>
                  <div class='btn-group'>
                    <a href='update_service.php?id={$row['id']}' class='btn btn-warning'>Update</a>
                    <a href='delete_service.php?id={$row['id']}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this service?');\">Delete</a>
                  </div>
                </div>
              </div>
            ";
          }
        ?>
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