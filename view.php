<?php
include 'db.php';
include 'header.php';

$order = $_GET['sort'] ?? 'created_at';
$sql = "SELECT * FROM products ORDER BY $order DESC";
$data = $pdo->query($sql)->fetchAll();
?>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-6xl mx-auto px-4 mt-10">
    <h2 class="text-3xl font-semibold text-center mb-6">Список продуктів</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-800 uppercase">
                <tr>
                    <th class="px-6 py-3"><a href="?sort=name" class="hover:underline">Назва</a></th>
                    <th class="px-6 py-3">Опис</th>
                    <th class="px-6 py-3">Категорія</th>
                    <th class="px-6 py-3"><a href="?sort=price" class="hover:underline">Ціна</a></th>
                    <th class="px-6 py-3">E-mail</th>
                    <th class="px-6 py-3"><a href="?sort=created_at" class="hover:underline">Дата</a></th>
                    <th class="px-6 py-3">Дії</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><?= htmlspecialchars($row['name']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['description']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['category']) ?></td>
                        <td class="px-6 py-4"><?= $row['price'] ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="px-6 py-4"><?= $row['created_at'] ?></td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="index.php?id=<?= $row['id'] ?>" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded text-xs">Редагувати</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Ви впевнені, що хочете видалити цей продукт?')" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-xs">Видалити</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
