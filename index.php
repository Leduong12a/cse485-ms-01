<?php
require_once 'data.php';

$categoryMap = [];
foreach ($categories as $cat) {
    $categoryMap[$cat['id']] = $cat['name'];
}

$totalInventoryValue = 0;
$productCount = count($products);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>MiniShop — Catalog (Buoi 1)</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .number { text-align: right; }
    </style>
</head>
<body>
    <h1>MiniShop — Catalog (Buoi 1)</h1>
    
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th class="number">Đơn giá (đ)</th>
                <th class="number">Số lượng</th>
                <th class="number">Thành tiền (đ)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): 
                $sku = htmlspecialchars($product['sku']);
                $name = htmlspecialchars($product['name']);
                
                $catId = $product['category_id'];
                $catName = isset($categoryMap[$catId]) ? htmlspecialchars($categoryMap[$catId]) : 'Khác';
                
                $price = $product['price'];
                $qty = $product['qty'];
                $lineTotal = $price * $qty;
                
                $totalInventoryValue += $lineTotal;
            ?>
                <tr>
                    <td><?php echo $sku; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $catName; ?></td>
                    <td class="number"><?php echo number_format($price, 0, ',', '.'); ?></td>
                    <td class="number"><?php echo $qty; ?></td>
                    <td class="number"><?php echo number_format($lineTotal, 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div>
        <p><strong>Số sản phẩm:</strong> <?php echo $productCount; ?></p>
        <p><strong>Tong gia tri kho =</strong> <?php echo $totalInventoryValue; ?></p>
    </div>

    <hr>
    <h3>Cấu trúc dữ liệu (Debug):</h3>
    <pre><?php var_dump($products); ?></pre>
</body>
</html>
<!-- MS_EXPECT product_count=8 inventory_value=41380000 -->
