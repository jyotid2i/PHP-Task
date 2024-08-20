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
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $image_name = $_FILES['profile']['name'];
        
        // Check if the email already exists
        $checkEmailSql = "SELECT * FROM php_user WHERE email = :email";
        $stmt = $conn->prepare($checkEmailSql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Email exists, display a message
            echo "User already exists.<br>";
        } else {
            // Handle the file upload
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile"]["name"]);
            if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["profile"]["name"])). " has been uploaded.<br>";
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }

            // Insert data into the database
            $sql = "INSERT INTO php_user (first_name, last_name, email, password, image_name)
                    VALUES (:first_name, :last_name, :email, :password, :image_name)";

            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':image_name', $image_name);

            // Execute the query
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->errorInfo();
            }
        }
    }


?>

<form method="POST"  enctype="multipart/form-data">
    <div>E-mail: <input type="text" name="email" placeholder="E-mail"></div><br>
    <div>First Name: <input type="text" name="first_name"  placeholder="First Name"></div><br>
    <div>Last Name: <input type="text" name="last_name"  placeholder="Last Name"></div><br>
    <div>Age: <input type="text" name="age"  placeholder="Age"></div><br>
    <div>Password: <input type="password" name="password"  placeholder="password"></div><br>
    <div>Picture: <input type="file" name="profile"></div><br>
    <input type="submit">
</form>

</body>
</html>




<!-- CREATE TABLE php_user (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(100),
last_name VARCHAR(100),
email VARCHAR(100) NOT NULL,
password VARCHAR(100),
image_name VARCHAR(500),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) -->

