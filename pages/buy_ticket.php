// /pages/buy_ticket.php
<?php
include '../includes/header.php';
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login.php'>login</a> to buy tickets.</p>";
    exit();
}

$event_id = $_GET['event_id'];
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_id = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number_of_tickets = $_POST['number_of_tickets'];

    if ($number_of_tickets <= $event['available_tickets']) {
        $stmt = $pdo->prepare("INSERT INTO purchases (user_id, event_id, number_of_tickets) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $event['event_id'], $number_of_tickets]);

        // Update available tickets
        $stmt = $pdo->prepare("UPDATE events SET available_tickets = available_tickets - ? WHERE event_id = ?");
        $stmt->execute([$number_of_tickets, $event['event_id']]);

        echo "<p>Tickets purchased successfully!</p>";
    } else {
        echo "<p>Not enough tickets available.</p>";
    }
}
?>

<h2>Buy Tickets for <?php echo $event['event_name']; ?></h2>
<form method="POST">
    <input type="number" name="number_of_tickets" min="1" max="<?php echo $event['available_tickets']; ?>" required>
    <button type="submit">Buy Tickets</button>
</form>

<?php include '../includes/footer.php'; ?>
