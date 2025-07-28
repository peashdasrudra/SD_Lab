<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body style="margin:0; font-family:'Segoe UI',sans-serif; background:#f0f8ff; display:flex; justify-content:center; align-items:center; height:100vh;">
    <div style="
  background:#fff;
  padding:40px;
  border-radius:20px;
  box-shadow:0 20px 50px rgba(0,0,0,0.1);
  max-width:500px;
  width:90%;
  animation:fade 0.5s ease;
  text-align:center;
">

        <!-- Avatar Image (static placeholder) -->
        <img
            src="https://i.pravatar.cc/150?u=<?= urlencode($user['email']) ?>"
            alt="User Avatar"
            style="width:120px; height:120px; border-radius:50%; border:4px solid #3f51b5; margin-bottom:20px;"
            title="Your avatar (based on your email)" />

        <!-- Welcome Title -->
        <h2 style="color:#3f51b5; margin-bottom:20px;">
            <i class="fas fa-user-circle"></i> <?= htmlspecialchars($user['name']) ?>
        </h2>

        <!-- Profile Info Fields -->
        <p><i class="fas fa-cake-candles" title="Your age"></i> <strong>Age:</strong> <?= $user['age'] ?></p>
        <p><i class="fas fa-venus-mars" title="Your gender"></i> <strong>Gender:</strong> <?= $user['gender'] ?></p>
        <p><i class="fas fa-map" title="Your address"></i> <strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
        <p><i class="fas fa-envelope" title="Your email"></i> <strong>Email:</strong> <?= $user['email'] ?></p>
        <p><i class="fas fa-phone" title="Your mobile number"></i> <strong>Mobile:</strong> <?= $user['mobile'] ?></p>

        <!-- Logout Button -->
        <a href="logout.php" style="
    display:inline-block;
    margin-top:25px;
    background:#e53935;
    color:white;
    padding:12px 25px;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
    transition: background-color 0.3s ease;"
            title="Click to logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <!-- Fade animation for the card -->
    <style>
        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>

</html>