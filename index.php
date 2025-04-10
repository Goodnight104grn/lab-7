<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-md mx-auto bg-white shadow-md rounded-xl p-6 mt-10">
    <h2 class="text-2xl font-bold text-center mb-6">Додати продукт</h2>
    <form action="submit.php" method="POST" class="space-y-4">
        <div>
            <label class="block mb-1 text-gray-700">Назва:</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Опис:</label>
            <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Категорія:</label>
            <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option>Електроніка</option>
                <option>Книги</option>
                <option>Одяг</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 text-gray-700">Ціна:</label>
            <input type="number" name="price" step="0.01" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 text-gray-700">E-mail:</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition duration-200">
            Додати
        </button>
    </form>
</div>

<?php include 'footer.php'; ?>
