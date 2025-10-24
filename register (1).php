<?php
include('data.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<div style='
          background:#d4edda;
          color:#155724;
          border:1px solid #c3e6cb;
          padding:15px;
          margin:50px auto;
          width:fit-content;
          border-radius:8px;
          font-family:Poppins,sans-serif;
          text-align:center;
        '>
          ✅ Registration successful!<br>
          <a href='login.html' style='color:#007bff;text-decoration:none;'>Click here to log in</a>
        </div>";
        exit;
    } else {
        echo "<div style='
          background:#f8d7da;
          color:#721c24;
          border:1px solid #f5c6cb;
          padding:15px;
          margin:50px auto;
          width:fit-content;
          border-radius:8px;
          font-family:Poppins,sans-serif;
          text-align:center;
        '>
          ❌ Error: " . $stmt->error . "
        </div>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register - MyWeb</title>
  <style>
    * {
      margin: 0; padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #00aaff, #004466);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: #1e1e2f;
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .logo {
      color: #00aaff;
      font-size: 24px;
      font-weight: 700;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      transition: 0.3s;
    }

    .nav-links a:hover {
      color: #00aaff;
    }

    .register-section {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px 20px;
    }

    .register-card {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      width: 100%;
      max-width: 420px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      animation: fadeUp 0.7s ease;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .register-card h2 {
      color: #004466;
      margin-bottom: 10px;
    }

    .register-card p {
      color: #666;
      margin-bottom: 25px;
    }

    .input-group {
      position: relative;
      margin-bottom: 25px;
      text-align: left;
    }

    .input-group input {
      width: 100%;
      padding: 12px 10px;
      border: 2px solid #ccc;
      border-radius: 8px;
      outline: none;
      font-size: 15px;
      transition: 0.3s;
    }

    .input-group label {
      position: absolute;
      top: 12px;
      left: 15px;
      color: #888;
      pointer-events: none;
      transition: 0.3s;
    }

    .input-group input:focus {
      border-color: #00aaff;
    }

    .input-group input:focus + label,
    .input-group input:valid + label {
      top: -10px;
      left: 10px;
      background: white;
      font-size: 12px;
      color: #00aaff;
      padding: 0 5px;
    }

    .btn-register {
      width: 100%;
      background: #00aaff;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-register:hover {
      background: #0088cc;
      transform: scale(1.03);
    }

    .links {
      margin-top: 20px;
      color: #004466;
    }

    .links a {
      color: #00aaff;
      text-decoration: none;
      transition: 0.3s;
    }

    .links a:hover {
      text-decoration: underline;
    }

    footer {
      background: #1e1e2f;
      color: white;
      text-align: center;
      padding: 15px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <header>
    <h2 class="logo">MyWeb</h2>
    <ul class="nav-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="login.html">Login</a></li>
    </ul>
  </header>

  <section class="register-section">
    <div class="register-card">
      <h2>Join MyWeb Today 🚀</h2>
      <p>Create your free account and get started instantly.</p>

      <form action="register.php" method="POST">
        <div class="input-group">
          <input type="text" name="username" id="username" required />
          <label for="username">Username</label>
        </div>

        <div class="input-group">
          <input type="email" name="email" id="email" required />
          <label for="email">Email</label>
        </div>

        <div class="input-group">
          <input type="password" name="password" id="password" required />
          <label for="password">Password</label>
        </div>

        <button type="submit" class="btn-register">Sign Up</button>
      </form>

      <p class="links">
        Already have an account? <a href="login.html">Login</a>
      </p>
    </div>
  </section>

  <footer>
    <p>© 2025 MyWeb Portal | Designed for Students by Students</p>
  </footer>
</body>
</html>
