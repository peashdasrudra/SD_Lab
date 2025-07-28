<?php
// Start session to track logged-in user
session_start();

// Handle login POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "sd3_form");
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Find user with this email
    $stmt = $conn->prepare("SELECT * FROM Registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    // If user exists, verify password
    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: profile.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
    <div class="form-box">
        <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" required title="Enter your email">

            <label>Password</label>
            <input type="password" name="password" required title="Enter your password">

            <button type="submit"><i class="fas fa-arrow-right"></i> Login</button>
        </form>
    </div>
</body>

</html>