// /includes/db.php
<?php
$host = 'localhost';
$db = 'event_ticket_db';
$user = 'root'; // Change as needed
$pass = ''; // Change as needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
