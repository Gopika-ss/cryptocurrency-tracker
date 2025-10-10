<?php
include 'db_connect.php';
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password= $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        if ($stmt->execute()) {
            $success = "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            $error = "Something went wrong. Try again.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crypto Tracker - Register</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      background: url("crypto.jpeg") no-repeat center center/cover;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.6);
    }

    .login-container {
      position: relative;
      z-index: 1;
      background: rgba(20, 20, 20, 0.8);
      padding: 40px;
      border-radius: 20px;
      width: 350px;
      box-shadow: 0px 8px 20px rgba(0, 255, 170, 0.3),
                  0px 0px 25px rgba(0, 255, 170, 0.4);
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #00FFD1;
      text-shadow: 0px 0px 15px rgba(0, 255, 170, 0.8);
    }

    .input-group {
      margin-bottom: 20px;
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #ddd;
      font-size: 0.9rem;
    }

    input {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: none;
      outline: none;
      background: #1A1A1A;
      color: #fff;
      font-size: 1rem;
      border: 2px solid transparent;
      transition: all 0.3s ease-in-out;
    }

    input:focus {
      border: 2px solid #00FFD1;
      box-shadow: 0px 0px 12px rgba(0, 255, 170, 0.7);
    }
   .btn {
      width: 100%;
      background: linear-gradient(90deg, #00FFD1, #00FF85);
      color: #000;
      font-weight: bold;
      border: none;
      padding: 14px;
      border-radius: 30px;
      cursor: pointer;
      font-size: 1rem;
      transition: all 0.3s ease-in-out;
      box-shadow: 0px 4px 15px rgba(0, 255, 170, 0.5);
    }

    .btn:hover {
      background: linear-gradient(90deg, #00FF85, #00FFD1);
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0px 6px 25px rgba(0, 255, 170, 0.9);
    }

    .extra-links {
      margin-top: 15px;
    }

    .extra-links a {
      color: #00FFD1;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .extra-links a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1>Register</h1>
    <form method="POST" id="registerForm">
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Create a password" required>
      </div>
      <button type="submit" class="btn">Register</button>
      <div class="extra-links">
        <a href="login.php">Already have an account?</a>
      </div>
      <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
      <?php elseif ($success): ?>
        <p style="color: #00FFD1;"><?= $success ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>