<?php
/**
 * Orchid Cafe - Menu Page
 */
$page_title = "Our Culinary Selection";
require_once 'includes/header.php';

// Fetch Categories
$categories = getMenuCategories($pdo);

// Category Filter handling (Mocking database logic if empty)
$active_cat = isset($_GET['cat']) ? (int)$_GET['cat'] : ($categories[0]['id'] ?? 0);
$menu_items = getMenuItems($pdo, $active_cat);

// Fallback for demo if DB is empty
if (empty($menu_items)) {
    $menu_items = [
        ['name' => 'Steam Chicken Momo', 'price' => 350, 'short_description' => 'Traditional dumplings with juicy chicken filling, served with tomato chutney.', 'image' => 'https://images.unsplash.com/photo-1534422298391-e4f8c170db76?auto=format&fit=crop&q=80&w=400', 'is_veg' => 0, 'is_featured' => 1],
        ['name' => 'Chicken Biryani Rice', 'price' => 650, 'short_description' => 'Long-grain basmati rice with marinated chicken and secret spices.', 'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&q=80&w=400', 'is_veg' => 0, 'is_featured' => 1],
        ['name' => 'Chicken Lollipop', 'price' => 450, 'short_description' => 'Spicy and crispy fried chicken wings with a tangy dip.', 'image' => 'https://images.unsplash.com/photo-1527477396000-e27163b481c2?auto=format&fit=crop&q=80&w=400', 'is_veg' => 0, 'is_featured' => 0],
        ['name' => 'Paneer Tikka', 'price' => 420, 'short_description' => 'Char-grilled cottage cheese cubes marinated in yogurt spices.', 'image' => 'https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?auto=format&fit=crop&q=80&w=400', 'is_veg' => 1, 'is_featured' => 0],
    ];
}
?>

<!-- Menu Hero -->
<section class="bg-stone-900 py-32 text-white relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover">
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-5xl md:text-7xl font-bold serif italic mb-4">The Menu</h1>
        <p class="text-stone-400 max-w-xl mx-auto">Explore our diverse selection of flavors, crafted with tradition and modern flair.</p>
    </div>
</section>

<!-- Menu Grid & Filters -->
<section class="py-24 bg-white min-h-[800px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Navigation -->
        <div class="flex flex-wrap justify-center gap-4 mb-20">
            <a href="menu.php" class="px-8 py-3 rounded-full border border-stone-200 transition-all font-semibold <?php echo $active_cat == 0 ? 'bg-stone-900 text-white shadow-lg' : 'bg-white text-stone-600 hover:border-purple-600 hover:text-purple-600'; ?>">
                All Dishes
            </a>
            <?php foreach ($categories as $cat): ?>
            <a href="menu.php?cat=<?php echo $cat['id']; ?>" class="px-8 py-3 rounded-full border border-stone-200 transition-all font-semibold <?php echo $active_cat == $cat['id'] ? 'bg-stone-900 text-white shadow-lg' : 'bg-white text-stone-600 hover:border-purple-600 hover:text-purple-600'; ?>">
                <?php echo h($cat['name']); ?>
            </a>
            <?php endforeach; ?>
            <!-- Demo placeholders if DB empty -->
            <?php if (empty($categories)): ?>
            <a href="#" class="px-8 py-3 rounded-full border border-stone-200 bg-white text-stone-600 hover:border-purple-600 transition font-semibold">Starters</a>
            <a href="#" class="px-8 py-3 rounded-full border border-stone-200 bg-white text-stone-600 hover:border-purple-600 transition font-semibold">Main Course</a>
            <a href="#" class="px-8 py-3 rounded-full border border-stone-200 bg-white text-stone-600 hover:border-purple-600 transition font-semibold">Desserts</a>
            <?php endif; ?>
        </div>

        <!-- Items Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
            <?php foreach ($menu_items as $item): ?>
            <div class="group">
                <div class="relative aspect-[4/3] overflow-hidden rounded-2xl mb-6 shadow-md group-hover:shadow-xl transition duration-500">
                    <img src="<?php echo (strpos($item['image'], 'http') === 0) ? $item['image'] : $item['image']; ?>" alt="<?php echo h($item['name']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <?php if ($item['is_featured']): ?>
                    <span class="absolute top-4 left-4 bg-purple-600 text-white text-[10px] uppercase tracking-widest font-bold px-3 py-1 rounded-full shadow-lg">Featured</span>
                    <?php endif; ?>
                    <span class="absolute top-4 right-4 bg-white/90 backdrop-blur-md text-stone-900 text-[10px] font-bold px-2 py-1 rounded border border-stone-200">
                        <?php echo $item['is_veg'] ? '🟢 VEG' : '🔴 NON-VEG'; ?>
                    </span>
                </div>
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-stone-900 group-hover:text-purple-600 transition"><?php echo h($item['name']); ?></h3>
                    <span class="text-lg font-bold serif text-stone-900"><?php echo format_currency($item['price']); ?></span>
                </div>
                <p class="text-stone-500 text-sm leading-relaxed mb-4">
                    <?php echo h($item['short_description']); ?>
                </p>
                <button class="text-xs uppercase tracking-widest font-bold text-stone-400 hover:text-purple-600 transition flex items-center gap-2">
                    Add to order <i data-lucide="plus" class="w-3 h-3"></i>
                </button>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination or Load More -->
        <div class="mt-24 text-center">
            <button class="bg-stone-50 border border-stone-200 text-stone-600 px-10 py-4 rounded-full font-bold hover:bg-stone-100 transition shadow-sm">
                Load More Items
            </button>
        </div>
    </div>
</section>

<!-- Diet Note -->
<section class="py-12 bg-stone-50 border-t border-stone-100">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-xs text-stone-400 uppercase tracking-[0.2em]">Please inform our staff about any allergies or dietary requirements before ordering.</p>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
