<?php
include 'db.php';
include 'header.php';


$id = $_GET['id'] ?? null;
$message = '';
$product = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];

        if ($name && $description && $category && $price) {
            $update = "UPDATE products SET name=?, description=?, category=?, price=? WHERE id=?";
            $stmt = $pdo->prepare($update);
            $stmt->execute([$name, $description, $category, $price, $id]);
            header("Location: index.php");
            exit;
        } else {
            $message = "Будь ласка, заповніть усі поля.";
        }
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


<div class="max-w-md mx-auto bg-white shadow-md rounded-xl p-6 mt-10">
    <h2 class="text-2xl font-bold text-center mb-6">
        <?= $product ? 'Редагувати продукт' : 'Додати продукт' ?>
    </h2>

    <?php if ($message): ?>
        <p class="text-red-500 mb-4"><?= $message ?></p>
    <?php endif; ?>

    <form action="<?= $product ? '?id=' . $id : 'submit.php' ?>" method="POST" class="space-y-4">
        <div>
            <label class="block mb-1 text-gray-700">Назва:</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg" value="<?= htmlspecialchars($product['name'] ?? '') ?>">
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Опис:</label>
            <textarea name="description" class="w-full px-4 py-2 border rounded-lg"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Категорія:</label>
            <input type="text" name="category" required class="w-full px-4 py-2 border rounded-lg" value="<?= htmlspecialchars($product['category'] ?? '') ?>">
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Ціна:</label>
            <input type="number" name="price" step="0.01" required class="w-full px-4 py-2 border rounded-lg" value="<?= $product['price'] ?? '' ?>">
        </div>

        <?php if (!$product): ?>
        <div>
            <label class="block mb-1 text-gray-700">E-mail:</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        <?php endif; ?>

        <button type="submit" name="<?= $product ? 'update' : '' ?>" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
            <?= $product ? 'Оновити' : 'Додати' ?>
        </button>
    </form>
</div>



<?php include 'footer.php'; ?>
