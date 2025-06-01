<?php
session_start();
// Simple protection: allow access only to logged-in admins
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Universal database connection (replace with your own credentials or use environment variables)
$pdo = new PDO("mysql:host=localhost;dbname=YOUR_DATABASE_NAME;charset=utf8", "YOUR_DATABASE_USER", "YOUR_DATABASE_PASSWORD");

// Handle user add/update
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if ($username && $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        // Check if user already exists
        $stmt = $pdo->prepare("SELECT id FROM admins WHERE username=?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            // Update password
            $stmt = $pdo->prepare("UPDATE admins SET password=? WHERE username=?");
            $stmt->execute([$hashed, $username]);
            $message = "User password has been updated!";
        } else {
            // Add new user
            $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed]);
            $message = "New admin user has been added successfully!";
        }
    } else {
        $message = "Username and password cannot be empty!";
    }
}

// List existing users
$users = $pdo->query("SELECT username FROM admins ORDER BY username ASC")->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin User Management</title>
    <style>
        body { font-family: Arial, sans-serif; background: #181828; color: #fff; }
        .panel { margin: 50px auto; background: #232346; padding: 36px 50px; border-radius: 12px; width: 400px; box-shadow: 0 0 22px #ff00ff44; }
        h2 { color: #ff99ff; }
        .message { background: #222; color: #fff; padding: 12px; margin-bottom: 16px; border-radius: 8px; box-shadow: 0 0 8px #ff00ff33; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 5px; }
        input[type=text], input[type=password] {
            width: 100%; padding: 10px; border: none; border-radius: 6px; margin-bottom: 8px; background: #303050; color: #fff;
        }
        button {
            padding: 12px 24px; background: linear-gradient(45deg, #ff00ff, #ff99ff);
            border: none; border-radius: 8px; color: #fff; font-weight: bold; cursor: pointer;
            box-shadow: 0 0 12px #ff00ff77;
        }
        ul { margin: 18px 0 0 0; padding: 0; }
        li { list-style: none; padding: 4px 0; }
    </style>
</head>
<body>
    <div class="panel">
        <h2>Admin User Management</h2>
        <?php if($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required autocomplete="off">
            </div>
            <button type="submit">Save</button>
        </form>
        <h3>Current Admin Users</h3>
        <ul>
            <?php foreach($users as $u): ?>
                <li><?= htmlspecialchars($u) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>