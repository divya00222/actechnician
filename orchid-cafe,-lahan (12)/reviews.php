<?php
/**
 * Orchid Cafe - Reviews & Testimonials
 */
$page_title = "Reviews & Testimonials";
require_once 'includes/header.php';

$testimonials = getTestimonials($pdo, 20);

// Fallback for demo
if (empty($testimonials)) {
    $testimonials = [
        ['author' => 'Ram Kumar', 'text' => 'The best Momo in Lahan! The chutney is perfectly spicy and the atmosphere is very cozy.', 'rating' => 5, 'location' => 'Lahan'],
        ['author' => 'Sita Thapa', 'text' => 'Excellent service and great Biryani. We had our family dinner here and everyone loved it.', 'rating' => 4, 'location' => 'Siraha'],
        ['author' => 'Anish Shrestha', 'text' => 'A hidden gem. Great for happy hour with friends. The chicken lollipop is a must-try.', 'rating' => 5, 'location' => 'Local Guide'],
        ['author' => 'Priya Das', 'text' => 'Nice ambience and clean. The staff is very polite. Highly recommended.', 'rating' => 5, 'location' => 'Visitor']
    ];
}
?>

<section class="bg-stone-50 py-32 border-b border-stone-200">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-7xl font-bold text-stone-900 mb-6">Guest <span class="serif italic text-purple-600">Stories</span></h1>
        <p class="text-stone-500 max-w-xl mx-auto">We take pride in our service. Hear what our community has to say about their experience at Orchid Cafe.</p>
        
        <div class="mt-12 flex justify-center items-center gap-8">
            <div class="text-center">
                <span class="text-4xl font-bold text-stone-900 block">3.9</span>
                <div class="flex text-yellow-400 justify-center my-1">
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    <i data-lucide="star" class="w-4 h-4 text-stone-300"></i>
                </div>
                <span class="text-[10px] text-stone-400 uppercase tracking-widest">Google Rating</span>
            </div>
            <div class="w-px h-12 bg-stone-200"></div>
            <div class="text-center">
                <span class="text-4xl font-bold text-stone-900 block">400+</span>
                <span class="text-[10px] text-stone-400 uppercase tracking-widest mt-1 block">Reviews</span>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
            <?php foreach ($testimonials as $review): ?>
            <div class="break-inside-avoid bg-stone-50 p-8 rounded-3xl border border-stone-100 hover:border-purple-200 transition-all shadow-sm">
                <div class="flex text-yellow-400 mb-6">
                    <?php for($i=0; $i<5; $i++): ?>
                        <i data-lucide="star" class="w-4 h-4 <?php echo $i < ($review['rating'] ?? 5) ? 'fill-current' : 'text-stone-300'; ?>"></i>
                    <?php endfor; ?>
                </div>
                <p class="text-stone-700 italic leading-relaxed mb-6">"<?php echo h($review['text']); ?>"</p>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold">
                        <?php echo substr($review['author'], 0, 1); ?>
                    </div>
                    <div>
                        <h4 class="font-bold text-stone-900"><?php echo h($review['author']); ?></h4>
                        <p class="text-[10px] text-stone-400 uppercase tracking-widest"><?php echo h($review['location'] ?? 'Customer'); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-24 text-center">
            <p class="text-stone-500 mb-6">Had a great time at Orchid Cafe?</p>
            <a href="https://www.google.com/search?q=Orchid+Cafe+Lahan#lrd=0x39efbe9604106511:0x41e8c7516f4d8520,3" target="_blank" class="bg-stone-900 text-white px-10 py-5 rounded-full font-bold inline-flex items-center gap-3 hover:bg-stone-800 transition shadow-xl">
                Leave a Google Review <i data-lucide="external-link" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
