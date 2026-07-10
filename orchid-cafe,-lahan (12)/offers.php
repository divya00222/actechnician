<?php
/**
 * Orchid Cafe - Offers Page
 */
$page_title = "Special Offers";
require_once 'includes/header.php';

$offers = getActiveOffers($pdo);

// Fallback for demo
if (empty($offers)) {
    $offers = [
        [
            'title' => 'Happy Hour Delight',
            'description' => 'Get 20% off on all starters and mocktails from 4 PM to 7 PM every weekday.',
            'discount_val' => 20,
            'code' => 'HAPPY20',
            'expiry_date' => '2026-12-31',
            'image' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?auto=format&fit=crop&q=80&w=600'
        ],
        [
            'title' => 'Sunday Family Brunch',
            'description' => 'Special family platter serving 4 people at a discounted price of Rs. 2499.',
            'discount_val' => 15,
            'code' => 'FAMILY15',
            'expiry_date' => '2026-10-30',
            'image' => 'https://images.unsplash.com/photo-1550966841-3ee7adac1661?auto=format&fit=crop&q=80&w=600'
        ]
    ];
}
?>

<section class="bg-stone-900 py-32 text-white text-center">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-5xl md:text-7xl font-bold serif italic mb-4">Exclusive Deals</h1>
        <p class="text-purple-400 uppercase tracking-widest text-sm font-semibold">Savor the flavor for less</p>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <?php foreach ($offers as $offer): ?>
            <div class="bg-stone-50 rounded-3xl overflow-hidden border border-stone-200 flex flex-col md:flex-row group">
                <div class="md:w-2/5 relative overflow-hidden h-64 md:h-auto">
                    <img src="<?php echo h($offer['image'] ?? 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&q=80&w=600'); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 left-4 bg-purple-600 text-white font-bold px-3 py-1 rounded text-sm shadow-lg">
                        <?php echo h($offer['discount_val']); ?>% OFF
                    </div>
                </div>
                <div class="md:w-3/5 p-8 flex flex-col justify-center space-y-4">
                    <h3 class="text-2xl font-bold text-stone-900"><?php echo h($offer['title']); ?></h3>
                    <p class="text-stone-600 text-sm leading-relaxed"><?php echo h($offer['description']); ?></p>
                    <div class="pt-4 flex items-center justify-between">
                        <div class="bg-white border-2 border-dashed border-stone-300 px-4 py-2 rounded-lg font-mono font-bold text-purple-600">
                            <?php echo h($offer['code']); ?>
                        </div>
                        <span class="text-[10px] text-stone-400 uppercase tracking-widest">Expires: <?php echo date('M d, Y', strtotime($offer['expiry_date'])); ?></span>
                    </div>
                    <a href="menu.php" class="text-stone-900 font-bold flex items-center gap-2 hover:gap-3 transition-all text-sm pt-4">Order Now <i data-lucide="arrow-right" class="w-4 h-4 text-purple-600"></i></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Terms Note -->
<section class="py-12 bg-stone-50 border-t border-stone-100">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-[10px] text-stone-400 uppercase tracking-[0.2em] max-w-2xl mx-auto">Offers cannot be combined with other discounts. Please mention the code to your server or at the checkout counter.</p>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
