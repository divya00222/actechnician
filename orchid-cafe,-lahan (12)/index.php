<?php
/**
 * Orchid Cafe - Home Page
 */
$page_title = "Welcome to Orchid Cafe, Lahan";
require_once __DIR__ . '/includes/header.php';

// Fetch dynamic content with safety
$featured_dishes = [];
$offers = [];

if (isset($pdo) && $pdo instanceof PDO) {
    $featured_dishes = getFeaturedDishes($pdo, 3);
    $offers = getActiveOffers($pdo);
}
?>

<main class="flex-grow pt-24 md:pt-32">
<!-- Hero Section -->
<section class="relative h-[85vh] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=2000" alt="Cafe Ambience" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-900/60"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
        <div class="max-w-2xl space-y-8">
            <span class="uppercase tracking-[0.3em] text-sm font-semibold text-purple-400">Established Excellence</span>
            <h1 class="text-5xl md:text-7xl font-bold leading-tight">
                <?php echo nl2br(h($settings['hero_title'] ?? "Authentic Flavors, \nModern Dining.")); ?>
            </h1>
            <p class="text-lg md:text-xl text-stone-200 max-w-lg leading-relaxed">
                <?php echo h($settings['hero_subtitle'] ?? "From our kitchen to your table, experience the heart of Lahan's culinary scene. Award-winning Momo, Biryani, and more."); ?>
            </p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="<?php echo h($settings['hero_cta_link'] ?? 'menu.php'); ?>" class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-full font-bold transition flex items-center gap-2">
                    <?php echo h($settings['hero_cta_text'] ?? 'View Our Menu'); ?> <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="reservations.php" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 px-8 py-4 rounded-full font-bold transition">
                    Book a Table
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/50 animate-bounce">
        <i data-lucide="chevron-down" class="w-6 h-6"></i>
    </div>
</section>

<!-- Featured Categories Quick Preview -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div class="max-w-xl">
                <h2 class="text-4xl font-bold text-stone-900 mb-6">Culinary <span class="serif text-purple-600 italic">Signature</span></h2>
                <p class="text-stone-600">Discover the dishes that made us a favorite in Lahan. Each plate is crafted with locally sourced ingredients and passion.</p>
            </div>
            <a href="menu.php" class="text-purple-600 font-bold flex items-center gap-1 hover:gap-2 transition-all">Full Menu <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($featured_dishes as $dish): ?>
            <div class="group relative overflow-hidden rounded-2xl aspect-[4/5]">
                <img src="<?php echo !empty($dish['image']) ? (strpos($dish['image'], 'http') === 0 ? $dish['image'] : $dish['image']) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=800'; ?>" alt="<?php echo h($dish['name']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-stone-900/90 via-stone-900/20 to-transparent flex flex-col justify-end p-8 text-white">
                    <span class="bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold w-fit mb-4">
                        <?php echo $dish['is_chef_special'] ? "Chef's Special" : ($dish['is_popular'] ? "Popular Choice" : "Featured"); ?>
                    </span>
                    <h3 class="text-2xl font-bold mb-2"><?php echo h($dish['name']); ?></h3>
                    <p class="text-sm text-stone-300 mb-4 opacity-0 group-hover:opacity-100 transition duration-300"><?php echo h($dish['short_description']); ?></p>
                    <span class="text-xl font-semibold serif"><?php echo format_currency($dish['price']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Section Preview -->
<section class="py-24 bg-stone-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="relative">
                <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&q=80&w=800" alt="Orchid Cafe Interior" class="w-full h-auto">
                </div>
                <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-purple-600 rounded-2xl -z-0 hidden md:block"></div>
                <div class="absolute -top-6 -left-6 border-4 border-purple-200 w-32 h-32 rounded-full -z-0"></div>
            </div>
            
            <div class="space-y-8">
                <span class="text-purple-600 font-bold uppercase tracking-widest text-sm">Since <?php echo h($settings['established_since'] ?? '2015'); ?></span>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight">The Story of <span class="serif italic text-purple-600"><?php echo h($settings['business_name'] ?? 'Orchid Cafe'); ?></span></h2>
                <p class="text-lg text-stone-600 leading-relaxed">
                    <?php echo h($settings['footer_about'] ?? 'Nestled in the heart of Lahan, Orchid Cafe began with a simple mission: to serve honest, flavorful food in a space that feels like home. Over the years, we\'ve become a hub for families, foodies, and friends.'); ?>
                </p>
                <div class="grid grid-cols-2 gap-8 py-4">
                    <div class="space-y-2">
                        <span class="text-3xl font-bold text-stone-900 serif"><?php echo h($settings['google_rating'] ?? '3.9'); ?>+</span>
                        <p class="text-sm text-stone-500 uppercase tracking-widest">Google Rating</p>
                    </div>
                    <div class="space-y-2">
                        <span class="text-3xl font-bold text-stone-900 serif"><?php echo h($settings['reviews_count'] ?? '400'); ?>+</span>
                        <p class="text-sm text-stone-500 uppercase tracking-widest">Reviews</p>
                    </div>
                </div>
                <a href="about.php" class="inline-block text-stone-900 font-bold border-b-2 border-purple-600 pb-1 hover:text-purple-600 transition">Read Full Story</a>
            </div>
        </div>
    </div>
</section>

<!-- Offers Section -->
<?php if (!empty($offers)): ?>
<section class="py-24 bg-purple-900 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-white/5 skew-x-12"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Exclusive <span class="serif italic font-normal">Offers</span></h2>
            <p class="text-purple-200">Special deals for our loyal customers and happy hours.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php foreach ($offers as $offer): ?>
            <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 flex flex-col md:flex-row gap-6 items-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-purple-900 flex-shrink-0">
                    <span class="text-xl font-bold"><?php echo h($offer['discount_value']); ?></span>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2"><?php echo h($offer['title']); ?></h3>
                    <p class="text-purple-200 text-sm mb-4"><?php echo h($offer['description']); ?></p>
                    <?php if (!empty($offer['code'])): ?>
                        <span class="text-xs font-mono uppercase tracking-widest bg-purple-600/50 px-3 py-1 rounded-md">Code: <?php echo h($offer['code']); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Reservations CTA -->
<section class="py-32 bg-white text-center relative overflow-hidden">
    <div class="max-w-3xl mx-auto px-4 relative z-10">
        <h2 class="text-5xl md:text-6xl font-bold mb-8">Ready for an <span class="serif italic text-purple-600">Unforgettable</span> Meal?</h2>
        <p class="text-xl text-stone-600 mb-12">Whether it's a private dinner or a quick happy hour snack, we're ready to host you.</p>
        <div class="flex justify-center gap-6">
            <a href="reservations.php" class="bg-stone-900 text-white px-10 py-5 rounded-full font-bold hover:bg-stone-800 transition shadow-xl hover:shadow-2xl translate-y-0 hover:-translate-y-1">
                Book a Table Now
            </a>
        </div>
    </div>
</section>

</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
