<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Type Selection</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      user-select: none;
    }

    #bg-slider {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      z-index: -1;
    }
    #bg-slider img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      animation: fadeSlider 15s infinite;
      animation-timing-function: ease-in-out;
    }
    #bg-slider img:nth-child(1) { animation-delay: 0s; }
    #bg-slider img:nth-child(2) { animation-delay: 3s; }
    #bg-slider img:nth-child(3) { animation-delay: 6s; }
    #bg-slider img:nth-child(4) { animation-delay: 9s; }
    #bg-slider img:nth-child(5) { animation-delay: 12s; }

    @keyframes fadeSlider {
      0% { opacity: 0; }
      10% { opacity: 1; }
      30% { opacity: 1; }
      40% { opacity: 0; }
      100% { opacity: 0; }
    }

    h1 {
      font-size: 3.5rem;
      margin-bottom: 50px;
      position: relative;
      text-align: center;
      text-shadow:
         0 0 10px rgba(255, 255, 255, 0.8),
         0 0 20px rgba(255, 0, 255, 0.6),
         0 0 30px rgba(255, 0, 255, 0.8),
         0 0 40px rgba(255, 0, 255, 1);
      animation: glowText 3s ease-in-out infinite alternate;
      z-index: 1;
    }

    @keyframes glowText {
      from {
        text-shadow:
         0 0 5px rgba(255, 255, 255, 0.6),
         0 0 10px rgba(255, 0, 255, 0.4),
         0 0 15px rgba(255, 0, 255, 0.6),
         0 0 20px rgba(255, 0, 255, 0.8);
      }
      to {
        text-shadow:
         0 0 15px rgba(255, 255, 255, 1),
         0 0 30px rgba(255, 0, 255, 1),
         0 0 45px rgba(255, 0, 255, 1),
         0 0 60px rgba(255, 0, 255, 1);
      }
    }

    .btn-style {
      padding: 18px 45px;
      font-size: 20px;
      background: linear-gradient(45deg, #ff00ff, #ff99ff);
      border: none;
      border-radius: 30px;
      margin: 12px;
      cursor: pointer;
      box-shadow:
        0 0 10px #ff00ff88,
        0 0 20px #ff00ffaa,
        0 0 30px #ff00ffcc;
      color: white;
      font-weight: 600;
      transition: all 0.35s ease;
      letter-spacing: 1px;
      user-select: none;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    .btn-style::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(60deg, transparent, #ff00ff99, transparent);
      transform: rotate(25deg);
      transition: all 0.5s ease;
      opacity: 0;
    }

    .btn-style:hover::before {
      opacity: 1;
      top: -20%;
      left: -20%;
      transition: all 0.5s ease;
    }

    .btn-style:hover {
      box-shadow:
        0 0 20px #ff00ffcc,
        0 0 40px #ff00ffee,
        0 0 60px #ff00ff;
      transform: scale(1.1);
    }

    #ticker-container {
      position: fixed;
      bottom: 20px;
      width: 100%;
      overflow: hidden;
      pointer-events: none;
      z-index: 10;
    }

    #ticker {
      display: inline-block;
      white-space: nowrap;
      font-size: 1.3rem;
      color: white;
      font-weight: 600;
      padding-left: 100%;
      animation: tickerMove 25s linear infinite;
      text-shadow:
         0 0 3px #fff,
         0 0 5px #fff;
      user-select: none;
      font-family: 'Poppins', sans-serif;
    }

    @keyframes tickerMove {
      0% {
        transform: translateX(0%);
      }
      100% {
        transform: translateX(-100%);
      }
    }
  </style>
</head>
<body>

  <div id="bg-slider">
    <img src="https://www.shutterstock.com/image-photo/balayage-hair-airtouch-styling-blonde-600nw-2535796951.jpg" alt="Salon 1" />
    <img src="https://www.shutterstock.com/image-photo/professional-beautician-applying-makeup-on-260nw-2452283547.jpg" alt="Salon 2" />
    <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1920&q=80" alt="Salon 3" />
    <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&w=1920&q=80" alt="Salon 4" />
    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=1920&q=80" alt="Salon 5" />
  </div>

  <h1>Select Login Type</h1>

  <button class="btn-style" onclick="adminLogin()">Admin Login</button>
  <button class="btn-style" onclick="customerLogin()">Customer Login</button>

  <div id="ticker-container">
    <div id="ticker">
      Discover the latest trends in the world of beauty salons, revolutionary styles for your hair, and professional touches to enhance your look! The best care and most stylish appearance start here...
    </div>
  </div>

  <script>
  function adminLogin() {
    window.location.href = "admin_login.php";
  }
  function customerLogin() {
    window.location.href = "customer_login.php";
  }
  </script>
</body>
</html>