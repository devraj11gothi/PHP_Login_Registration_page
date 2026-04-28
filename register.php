<?php
include "db.php";

$message = "";

// This runs only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get data from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password before saving (never store plain text passwords)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");

    if (mysqli_num_rows($check) > 0) {
        $message = "Username already taken. Try another.";
    } else {
        // Save the new user to the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            $message = "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            $message = "Something went wrong. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth">

    <div class="card">
        <h2>Register</h2>

        <?php if ($message != "") { echo "<div class='message'>" . $message . "</div>"; } ?>

        <form method="POST" action="register.php">

            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>

        </form>

        <p class="footer-link">Already have an account? <a href="login.php">Login</a></p>
    </div>

</body>
</html>
