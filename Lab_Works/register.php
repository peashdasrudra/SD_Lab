<?php
// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "sd3_form");

    $name     = $_POST['name'];
    $age      = $_POST['age'];
    $gender   = $_POST['gender'];
    $address  = $_POST['address'];
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO Registration (name, age, gender, address, email, mobile, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $name, $age, $gender, $address, $email, $mobile, $password);

    if ($stmt->execute()) {
        $msg = "<p class='success'>Registered successfully. <a href='login.php'>Login</a></p>";
    } else {
        $msg = "<p class='error'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
    <div class="form-box">
        <h2><i class="fas fa-user-plus"></i> Register</h2>
        <?= $msg ?? "" ?>
        <form method="POST">
            <label>Name</label>
            <input type="text" name="name" required title="Enter full name">

            <label>Age</label>
            <input type="number" name="age" required>

            <label>Gender</label>
            <select name="gender">
                <option>male</option>
                <option>female</option>
                <option>other</option>
            </select>

            <label>Address</label>
            <textarea name="address" required></textarea>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Mobile</label>
            <input type="tel" name="mobile" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit"><i class="fas fa-check"></i> Register</button>
        </form>
    </div>
</body>

</html>