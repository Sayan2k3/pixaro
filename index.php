<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM workers WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['designation'];

        // Redirect based on role
        if ($user['designation'] == 'Admin') {
            header("Location: admin.php");
        } elseif ($user['designation'] == 'Coordinator') {
            header("Location: coordinator.php");
        } else {
            header("Location: employee.php");
        }
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixaro Login</title>
    <link rel="stylesheet" href="indexstyles.css">
</head>
<body>

    <div class="outer-container">
        <div class="login-container">
            <h2>Welcome to <span class="pixaro">Pixaro</span></h2>
            <p>AI Driven Smart construction monitoring</p>

            <?php if (isset($error)) echo "<p>$error</p>"; ?>

            <form method="POST">
                <input type="email" name="email" placeholder="📧 Email" required>
                <input type="password" name="password" placeholder="🔒 Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

</body>
</html>

