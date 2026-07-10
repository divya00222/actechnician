<?php
/**
 * Orchid Cafe - Admin: Menu Categories
 */
$page_title = "Menu Categories";
require_once 'partials/header.php';

// Fetch All Categories
$categories = $pdo->query("SELECT * FROM menu_categories ORDER BY sort_order ASC")->fetchAll();

// Check if editing
$edit_cat = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM menu_categories WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_cat = $stmt->fetch();
}
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- List Column -->
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Available Categories</h3>
                <span class="text-xs text-gray-400"><?php echo count($categories); ?> Total</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                            <th class="px-6 py-4">Order</th>
                            <th class="px-6 py-4">Category Name</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($categories as $cat): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-mono"><?php echo $cat['sort_order']; ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800"><?php echo h($cat['name']); ?></p>
                                <p class="text-xs text-gray-400"><?php echo h($cat['slug']); ?></p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest <?php echo $cat['status'] == 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-400'; ?>">
                                    <?php echo h($cat['status']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="menu-categories.php?edit=<?php echo $cat['id']; ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <button onclick="confirmDelete(<?php echo $cat['id']; ?>)" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">No categories found. Create your first one!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Column (Add/Edit) -->
    <div class="lg:col-span-4">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 sticky top-8">
            <h3 class="text-xl font-bold mb-6"><?php echo $edit_cat ? 'Edit' : 'Add New'; ?> Category</h3>
            <form action="actions/category-save.php" method="POST" class="space-y-6">
                <?php if ($edit_cat): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_cat['id']; ?>">
                <?php endif; ?>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Category Name</label>
                    <input type="text" name="name" required value="<?php echo $edit_cat ? h($edit_cat['name']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. Main Course">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Slug (URL friendly)</label>
                    <input type="text" name="slug" required value="<?php echo $edit_cat ? h($edit_cat['slug']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. main-course">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Display Order</label>
                    <input type="number" name="sort_order" required value="<?php echo $edit_cat ? $edit_cat['sort_order'] : '0'; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Status</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                        <option value="active" <?php echo ($edit_cat && $edit_cat['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?php echo ($edit_cat && $edit_cat['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-3.5 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                        <?php echo $edit_cat ? 'Update' : 'Create'; ?> Category
                    </button>
                    <?php if ($edit_cat): ?>
                        <a href="menu-categories.php" class="bg-gray-100 text-gray-600 px-6 py-3.5 rounded-xl font-bold hover:bg-gray-200 transition">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this category? All items in this category will become uncategorized.')) {
        window.location.href = 'actions/category-delete.php?id=' + id;
    }
}
</script>

<?php require_once 'partials/footer.php'; ?>
