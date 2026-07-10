<?php
/**
 * Orchid Cafe - FAQ Page
 */
$page_title = "Frequently Asked Questions";
require_once 'includes/header.php';

$faqs = getFaqs($pdo);

// Fallback for demo
if (empty($faqs)) {
    $faqs = [
        ['question' => 'Do you offer home delivery?', 'answer' => 'Yes, we partner with local delivery services in Lahan. You can also call us directly for bulk orders.'],
        ['question' => 'Is there parking available?', 'answer' => 'Yes, we have dedicated parking space for both two-wheelers and four-wheelers near the cafe entrance.'],
        ['question' => 'Do you have vegetarian options?', 'answer' => 'Absolutely! We have a wide range of vegetarian Momos, curries, and snacks clearly marked on our menu.'],
        ['question' => 'Can we host birthday parties?', 'answer' => 'Yes, we have a private dining area perfect for birthday celebrations. Please visit our Private Dining page for more details.'],
        ['question' => 'Are reservations mandatory?', 'answer' => 'Walk-ins are always welcome, but we recommend reservations for weekends or groups larger than 6 to ensure you have a table.'],
    ];
}
?>

<section class="bg-stone-50 py-32 border-b border-stone-200">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-7xl font-bold text-stone-900 mb-6">Common <span class="serif italic text-purple-600">Questions</span></h1>
        <p class="text-stone-500 max-w-xl mx-auto">Everything you need to know about dining at Orchid Cafe. If you don't find your answer here, feel free to contact us.</p>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <div class="space-y-6">
            <?php foreach ($faqs as $index => $faq): ?>
            <div class="border border-stone-200 rounded-2xl overflow-hidden group">
                <button class="w-full flex items-center justify-between p-6 text-left hover:bg-stone-50 transition" onclick="toggleFaq(<?php echo $index; ?>)">
                    <span class="font-bold text-stone-900"><?php echo h($faq['question']); ?></span>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-stone-400 transition-transform duration-300" id="faq-icon-<?php echo $index; ?>"></i>
                </button>
                <div class="hidden p-6 pt-0 text-stone-600 leading-relaxed border-t border-stone-100 bg-stone-50/30" id="faq-ans-<?php echo $index; ?>">
                    <?php echo h($faq['answer']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-20 p-12 bg-purple-600 rounded-3xl text-center text-white relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-4">Still have questions?</h3>
                <p class="text-purple-100 mb-8">Our team is happy to assist you with any specific queries.</p>
                <a href="contact.php" class="bg-white text-purple-600 px-8 py-3 rounded-full font-bold hover:bg-stone-100 transition shadow-lg">Contact Us Now</a>
            </div>
            <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white/10 rounded-full"></div>
        </div>
    </div>
</section>

<script>
    function toggleFaq(index) {
        const ans = document.getElementById('faq-ans-' + index);
        const icon = document.getElementById('faq-icon-' + index);
        
        if (ans.classList.contains('hidden')) {
            ans.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            ans.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
</script>

<?php require_once 'includes/footer.php'; ?>
