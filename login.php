<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "Jyoti123@#$";
$dbname = "phpfirstproject";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from form inputs
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        
        // Check if the email already exists
        $checkEmailSql = "SELECT * FROM php_user WHERE email = :email AND password =:password";
        $stmt = $conn->prepare($checkEmailSql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $$password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Email exists, display a message
            // Redirect to the target page
            header("Location: userDetails.php");
        } 
        else {
            echo "<br>Incorrect Credentials";
        }
    }


?>

<form method="POST">
    <div>E-mail: <input type="text" name="email" placeholder="E-mail"></div><br>
    <div>Password: <input type="password" name="password"  placeholder="password"></div><br>
    <input type="submit">
</form>

</body>
</html>

