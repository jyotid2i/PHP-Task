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
    // Check if the email already exists
    $checkEmailSql = "SELECT first_name, last_name, email, image_name, created_at, updated_at FROM php_user";
    $stmt = $conn->prepare($checkEmailSql);
    $stmt->execute();
    // Fetch all users' data
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Image Name</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    <?php if (!empty($users)): ?>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <?php if (!empty($user['image_name'])): ?>
                        <img src="images/<?php echo htmlspecialchars($user['image_name']); ?>" alt="Profile Image" style="width:100px; height:auto;">
                    <?php else: ?>
                        No image
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                <td><?php echo htmlspecialchars($user['updated_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No users found.</td>
        </tr>
    <?php endif; ?>
</table>


</body>
</html>

