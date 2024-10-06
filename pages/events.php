// /pages/events.php
<?php
include '../includes/header.php';
include '../includes/db.php';

$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $stmt->fetchAll();
?>

<h2>Latest Events</h2>
<ul class="event-list">
    <?php foreach ($events as $event): ?>
        <li>
            <h3><?php echo $event['event_name']; ?></h3>
            <p>Date: <?php echo $event['event_date']; ?></p>
            <p>Location: <?php echo $event['location']; ?></p>
            <p>Description: <?php echo $event['description']; ?></p>
            <p>Price: $<?php echo $event['ticket_price']; ?></p>
            <p>Available Tickets: <?php echo $event['available_tickets']; ?></p>
            <a href="buy_ticket.php?event_id=<?php echo $event['event_id']; ?>">Buy Tickets</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../includes/footer.php'; ?>
