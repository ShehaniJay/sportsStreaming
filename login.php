<?php

$host = "localhost";
$user = "root"; 
$pass = "";  
$db = "sportsstreamingdb"; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['login'])) {
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $stmt = $conn->prepare("SELECT PasswordHash FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
            header("Location: home.php"); 
            exit();
            } else {
                $authMessage = "Invalid password!";
            }
        } else {
            $authMessage = "No account found with that email!";
        }

        $stmt->close();

    } elseif (isset($_POST['signup'])) {
        $name = $_POST['signup_name'];
        $email = $_POST['signup_email'];
        $password = $_POST['signup_password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $checkStmt = $conn->prepare("SELECT UserID FROM Users WHERE Email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $authMessage = "Email already exists!";
        } else {
            $insertStmt = $conn->prepare("INSERT INTO Users (Name, Email, PasswordHash) VALUES (?, ?, ?)");
            $insertStmt->bind_param("sss", $name, $email, $hashedPassword);

            if ($insertStmt->execute()) {
            header("Location: login.php"); 
            exit();
            } else {
                $authMessage = "Error: " . $insertStmt->error;
            }

            $insertStmt->close();
        }

        $checkStmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login / Sign Up</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>

    body {
      background-color: #272221;
      font-family: 'Segoe UI', sans-serif;
      color: #FFFFFF;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #000000;
      padding: 2rem;
      border-radius: 15px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 15px rgba(240, 89, 34, 0.4);
    }

    h2 {
      text-align: center;
      margin-bottom: 1rem;
      color: #F05922;
    }

    form input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
    }

    form button {
      width: 100%;
      padding: 10px;
      background-color: #D95C2D;
      color: #FFFFFF;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    form button:hover {
      background-color: #F05922;
    }

    .switch-link {
      text-align: center;
      margin-top: 1rem;
    }

    .switch-link a {
      color: #F05922;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
    }

    .form {
      display: none;
    }

    .form.active {
      display: block;
    }

    .message {
      text-align: center;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>SportStream</h2>
    <?php if (!empty($authMessage)): ?>
      <div class="message"><?php echo $authMessage; ?></div>
    <?php endif; ?>

    <!-- LOGIN FORM -->
    <div id="loginForm" class="form active">
      <form method="POST">
        <input type="email" name="login_email" placeholder="Email" required />
        <input type="password" name="login_password" placeholder="Password" required />
        <button type="submit" name="login">Login</button>
      </form>
      <div class="switch-link">
        Don't have an account? <a onclick="toggleForms()">Sign Up</a>
      </div>
    </div>

    <!-- SIGNUP FORM -->
    <div id="signupForm" class="form">
      <form method="POST">
        <input type="text" name="signup_name" placeholder="Full Name" required />
        <input type="email" name="signup_email" placeholder="Email" required />
        <input type="password" name="signup_password" placeholder="Password" required />
        <button type="submit" name="signup">Sign Up</button>
      </form>
      <div class="switch-link">
        Already have an account? <a onclick="toggleForms()">Login</a>
      </div>
    </div>
  </div>

  <script>
    function toggleForms() {
      const login = document.getElementById('loginForm');
      const signup = document.getElementById('signupForm');
      login.classList.toggle('active');
      signup.classList.toggle('active');
    }
  </script>
</body>
</html>


