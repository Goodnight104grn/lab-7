<?php
include 'db.php';

$id = $_GET['id'] ?? null;
$message = '';

if (!$id) {
    die('ID не вказано');
}

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die('Продукт не знайдено');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;

    if ($name && $description && $category && $price) {
        $update = "UPDATE products SET name=?, description=?, category=?, price=? WHERE id=?";
        $stmt = $pdo->prepare($update);
        $stmt->execute([$name, $description, $category, $price, $id]);
        $message = "Продукт успішно оновлено!";
        
        header("Location: index.php"); 
        exit;
    } else {
        $message = "Будь ласка, заповніть усі поля.";
    }
}
?>

<h2>Редагування продукту</h2>

<?php if ($message): ?>
    <p style="color: red;"><?= $message ?></p>
<?php endif; ?>

<form method="POST">
    <label>Назва:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>"><br><br>

    <label>Опис:</label><br>
    <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea><br><br>

    <label>Категорія:</label><br>
    <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>"><br><br>

    <label>Ціна:</label><br>
    <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01"><br><br>

    <button type="submit">Оновити</button>
</form>
