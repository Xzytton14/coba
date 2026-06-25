<?php
require_once 'Database.php';
require_once 'Product.php';

// Inisialisasi Database
$database = new Database();
$db = $database->getConnection();

// Ambil data dari database
$query = "SELECT * FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Array untuk menampung objek produk hasil instansiasi OOP
$product_list = [];

foreach ($rows as $row) {
    if ($row['type'] == 'physical') {
        // Instansiasi objek PhysicalProduct
        $product_list[] = new PhysicalProduct($row['id'], $row['name'], $row['price'], $row['extra_info']);
    } else if ($row['type'] == 'digital') {
        // Instansiasi objek DigitalProduct
        $product_list[] = new DigitalProduct($row['id'], $row['name'], $row['price'], $row['extra_info']);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Toko OOP PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">Simulasi Project Web - Konsep OOP PHP</h1>
        <p class="text-gray-600 text-center mb-6">Menampilkan produk menggunakan konsep <em>Inheritance</em> dan <em>Polymorphism</em></p>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="p-3 rounded-l-lg">Nama Produk</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3 rounded-r-lg">Informasi / Detail Produk (Polymorphism)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($product_list) > 0): ?>
                    <?php foreach ($product_list as $product): ?>
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3 font-semibold text-gray-700"><?php echo $product->getName(); ?></td>
                            <td class="p-3 text-emerald-600 font-medium"><?php echo $product->getPrice(); ?></td>
                            <td class="p-3 text-gray-600"><?php echo $product->getInfo(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="p-3 text-center text-gray-500">Belum ada data produk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>