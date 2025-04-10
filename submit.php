<?php
include 'db.php';

$name = htmlspecialchars(trim($_POST['name']));
$desc = htmlspecialchars(trim($_POST['description']));
$cat = htmlspecialchars(trim($_POST['category']));
$price = $_POST['price'];
$email = htmlspecialchars(trim($_POST['email']));

$errors = [];

if (!$name || !$price || !$email) {
    $errors[] = "Всі обов'язкові поля мають бути заповнені.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Некоректний e-mail.";
}

if (count($errors) > 0) {
    foreach ($errors as $e) echo "<p style='color:red;'>$e</p>";
    echo "<a href='index.php'>Назад</a>";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO products (name, description, category, price, email, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->execute([$name, $desc, $cat, $price, $email]);

echo "<p style='color:green;'>Продукт успішно додано!</p>";
echo "<a href='index.php'>Додати ще</a> | <a href='view.php'>Переглянути всі</a>";
?>
