<?php
/**
 * Orchid Cafe - Admin: Add/Edit Menu Item
 */
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

require_admin_auth();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$item = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();
}

$page_title = $item ? "Edit Item: " . h($item['name']) : "Add New Dish";
require_once 'partials/header.php';

// Fetch categories for dropdown
$categories = $pdo->query("SELECT id, name FROM menu_categories ORDER BY sort_order ASC")->fetchAll();
?>

<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center gap-4">
        <a href="menu-items.php" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:text-purple-600 hover:border-purple-600 transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h3 class="text-2xl font-bold text-gray-800"><?php echo $page_title; ?></h3>
    </div>

    <form action="actions/item-save.php" method="POST" enctype="multipart/form-data" class="space-y-8 pb-20">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Column: Details -->
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Dish Name</label>
                        <input type="text" name="name" required value="<?php echo $item ? h($item['name']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. Chicken Biryani">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Category</label>
                            <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>" <?php echo ($item && $item['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                        <?php echo h($cat['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Price (Rs.)</label>
                            <input type="number" name="price" required value="<?php echo $item ? $item['price'] : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Short Description</label>
                        <textarea name="short_description" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="Appears in menu lists..."><?php echo $item ? h($item['short_description']) : ''; ?></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Full Details (Optional)</label>
                        <textarea name="full_description" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="Ingredients, spice level, etc..."><?php echo $item ? h($item['full_description']) : ''; ?></textarea>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-6">
                    <h4 class="font-bold text-gray-800">Dish Attributes</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-gray-100 bg-gray-50 cursor-pointer hover:bg-white transition">
                            <input type="checkbox" name="is_veg" value="1" <?php echo ($item && $item['is_veg']) ? 'checked' : ''; ?> class="w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm font-bold">Vegetarian</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-gray-100 bg-gray-50 cursor-pointer hover:bg-white transition">
                            <input type="checkbox" name="is_featured" value="1" <?php echo ($item && $item['is_featured']) ? 'checked' : ''; ?> class="w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm font-bold">Featured</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-gray-100 bg-gray-50 cursor-pointer hover:bg-white transition">
                            <input type="checkbox" name="is_chef_special" value="1" <?php echo ($item && $item['is_chef_special']) ? 'checked' : ''; ?> class="w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm font-bold">Chef's Special</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-gray-100 bg-gray-50 cursor-pointer hover:bg-white transition">
                            <input type="checkbox" name="is_popular" value="1" <?php echo ($item && $item['is_popular']) ? 'checked' : ''; ?> class="w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm font-bold">Popular</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Image Upload -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-6">
                    <h4 class="font-bold text-gray-800">Dish Image</h4>
                    <div class="space-y-4">
                        <div class="aspect-square rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden relative group">
                            <?php if ($item && !empty($item['image'])): ?>
                                <img src="../<?php echo $item['image']; ?>" class="w-full h-full object-cover" id="img-preview">
                            <?php else: ?>
                                <div class="text-center p-6" id="placeholder-box">
                                    <i data-lucide="image-plus" class="w-8 h-8 text-gray-300 mx-auto mb-2"></i>
                                    <p class="text-xs text-gray-400">Square images work best. Max 2MB.</p>
                                </div>
                                <img src="" class="w-full h-full object-cover hidden" id="img-preview">
                            <?php endif; ?>
                        </div>
                        <input type="file" name="image" id="img-input" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                    </div>
                </div>

                <!-- Status & Order -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Visibility</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                            <option value="active" <?php echo ($item && $item['status'] == 'active') ? 'selected' : ''; ?>>Available</option>
                            <option value="inactive" <?php echo ($item && $item['status'] == 'inactive') ? 'selected' : ''; ?>>Unavailable</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Sort Order</label>
                        <input type="number" name="sort_order" value="<?php echo $item ? $item['sort_order'] : '0'; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                    </div>
                </div>

                <!-- Action Button -->
                <button type="submit" class="w-full bg-purple-600 text-white py-5 rounded-2xl font-bold text-lg hover:bg-purple-700 transition shadow-xl shadow-purple-200">
                    <?php echo $item ? 'Save Changes' : 'Publish Dish'; ?>
                </button>
            </div>

        </div>
    </form>
</div>

<script>
    const imgInput = document.getElementById('img-input');
    const imgPreview = document.getElementById('img-preview');
    const placeholder = document.getElementById('placeholder-box');

    imgInput.onchange = evt => {
        const [file] = imgInput.files;
        if (file) {
            imgPreview.src = URL.createObjectURL(file);
            imgPreview.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        }
    }
</script>

<?php require_once 'partials/footer.php'; ?>
