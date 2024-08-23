<?php
// Check if the form is submitted
if (isset($_POST['registerButton'])) {
    // Redirect to the target page
    header("Location: registration.php");
    exit();
}
if (isset($_POST['loginButton'])) {
    // Redirect to the target page
    header("Location: login.php");
    exit();
}
if (isset($_POST['seeUsers'])) {
    // Redirect to the target page
    header("Location: userDetails.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>

    Welcome To My First PHP Project<br>
    <!-- Form with a button to trigger the redirect -->
    <form method="post">
        <button type="submit" name="loginButton">Login</button>
    </form>
    <form method="post">
        <button type="submit" name="registerButton">Register</button>
    </form>
    <form method="post">
        <button type="submit" name="seeUsers">View Registered Users</button>
    </form>

</body>
</html>
