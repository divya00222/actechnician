<?php
/**
 * Orchid Cafe - 404 Error Page
 */
$page_title = "Page Not Found";
require_once 'includes/header.php';
?>

<section class="h-[70vh] flex items-center justify-center bg-white text-center px-4">
    <div class="max-w-xl">
        <div class="relative inline-block mb-12">
            <span class="text-[12rem] font-bold text-stone-100 leading-none serif">404</span>
            <div class="absolute inset-0 flex items-center justify-center">
                <i data-lucide="utensils-cross" class="w-20 h-20 text-purple-600 opacity-20"></i>
            </div>
        </div>
        
        <h1 class="text-4xl font-bold text-stone-900 mb-4">Lost in Flavor?</h1>
        <p class="text-stone-500 mb-12 leading-relaxed">The page you're looking for has been moved or doesn't exist. Let's get you back to the menu.</p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="index.php" class="bg-stone-900 text-white px-8 py-3 rounded-full font-bold hover:bg-stone-800 transition shadow-lg">Back to Home</a>
            <a href="menu.php" class="bg-purple-600 text-white px-8 py-3 rounded-full font-bold hover:bg-purple-700 transition shadow-lg">View Our Menu</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
