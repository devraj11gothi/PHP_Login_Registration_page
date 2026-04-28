<?php
include "db.php";

session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {

            $_SESSION["username"] = $username;

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Wrong password.";
        }

    } else {
        $message = "No user found with that username.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth">

    <div class="card">
        <h2>Login</h2>

        <?php if ($message != "") { echo "<div class='message'>" . $message . "</div>"; } ?>

        <form method="POST" action="login.php">

            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>

        </form>

        <p class="footer-link">Don't have an account? <a href="register.php">Register</a></p>
    </div>

</body>
</html>
