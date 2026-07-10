<?php
/**
 * Orchid Cafe - Admin: Menu Items List
 */
$page_title = "Menu Management";
require_once 'partials/header.php';

// Fetch items with category name
$items = $pdo->query("
    SELECT m.*, c.name as category_name 
    FROM menu_items m 
    LEFT JOIN menu_categories c ON m.category_id = c.id 
    ORDER BY c.sort_order ASC, m.sort_order ASC
")->fetchAll();
?>

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Restaurant Menu</h3>
            <p class="text-sm text-gray-400">Manage all dishes, prices, and visibility.</p>
        </div>
        <a href="menu-item-edit.php" class="bg-purple-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200 flex items-center gap-2">
            <i data-lucide="plus-circle" class="w-5 h-5"></i>
            Add New Item
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                        <th class="px-6 py-5">Dish</th>
                        <th class="px-6 py-5">Category</th>
                        <th class="px-6 py-5">Price</th>
                        <th class="px-6 py-5">Attributes</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php foreach ($items as $item): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden shrink-0">
                                    <img src="../<?php echo !empty($item['image']) ? $item['image'] : 'assets/placeholder.jpg'; ?>" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/100x100?text=No+Img'">
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800"><?php echo h($item['name']); ?></p>
                                    <p class="text-[10px] text-gray-400 font-mono"><?php echo $item['is_veg'] ? '🟢 Veg' : '🔴 Non-Veg'; ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                <?php echo h($item['category_name'] ?? 'Uncategorized'); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-800">Rs. <?php echo number_format($item['price']); ?></p>
                            <?php if ($item['discount_price']): ?>
                                <p class="text-xs text-red-500 line-through">Rs. <?php echo number_format($item['discount_price']); ?></p>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-1 flex-wrap">
                                <?php if ($item['is_featured']): ?>
                                    <span class="bg-purple-100 text-purple-700 text-[8px] uppercase tracking-tighter px-1.5 py-0.5 rounded font-bold">Featured</span>
                                <?php endif; ?>
                                <?php if ($item['is_chef_special']): ?>
                                    <span class="bg-amber-100 text-amber-700 text-[8px] uppercase tracking-tighter px-1.5 py-0.5 rounded font-bold">Chef's</span>
                                <?php endif; ?>
                                <?php if ($item['is_popular']): ?>
                                    <span class="bg-blue-100 text-blue-700 text-[8px] uppercase tracking-tighter px-1.5 py-0.5 rounded font-bold">Popular</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest <?php echo $item['status'] == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                                <?php echo h($item['status']); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-1">
                            <a href="menu-item-edit.php?id=<?php echo $item['id']; ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <button onclick="confirmDelete(<?php echo $item['id']; ?>)" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="max-w-xs mx-auto space-y-4">
                                <i data-lucide="search-x" class="w-12 h-12 text-gray-200 mx-auto"></i>
                                <p class="text-gray-400 italic">No menu items found. Start by adding your signature dishes!</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this menu item? This action cannot be undone.')) {
        window.location.href = 'actions/item-delete.php?id=' + id;
    }
}
</script>

<?php require_once 'partials/footer.php'; ?>
