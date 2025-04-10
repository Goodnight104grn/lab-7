<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID не вказано');
}

$sql = "DELETE FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);


header("Location: index.php"); 
exit;
?>
