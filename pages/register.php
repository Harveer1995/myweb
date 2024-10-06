// /pages/register.php
<?php
include '../includes/header.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        echo "<p>Registration successful. You can <a href='login.php'>login here</a>.</p>";
    } else {
        echo "<p>Registration failed. Please try again.</p>";
    }
}
?>

<h2>Register</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
<?php include '../includes/footer.php'; ?>
