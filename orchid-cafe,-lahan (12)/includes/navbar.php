<?php
/**
 * Orchid Cafe - Navigation Bar
 */
?>
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-stone-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="index.php" class="text-2xl font-bold tracking-tight text-stone-900 flex items-center gap-2">
                    <?php if (!empty($settings['logo'])): ?>
                        <img src="<?php echo h($settings['logo']); ?>" alt="<?php echo h($settings['business_name'] ?? 'Orchid Cafe'); ?>" class="h-10 w-auto">
                    <?php else: ?>
                        <span class="bg-purple-600 text-white w-8 h-8 flex items-center justify-center rounded-lg shadow-lg">O</span>
                        <span class="serif"><?php echo h($settings['business_name'] ?? 'Orchid Cafe'); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="index.php" class="text-stone-600 hover:text-purple-600 font-medium transition">Home</a>
                <a href="about.php" class="text-stone-600 hover:text-purple-600 font-medium transition">About</a>
                <a href="menu.php" class="text-stone-600 hover:text-purple-600 font-medium transition">Menu</a>
                <a href="gallery.php" class="text-stone-600 hover:text-purple-600 font-medium transition">Gallery</a>
                <a href="offers.php" class="text-stone-600 hover:text-purple-600 font-medium transition">Offers</a>
                <a href="contact.php" class="text-stone-600 hover:text-purple-600 font-medium transition">Contact</a>
                <a href="reservations.php" class="bg-purple-600 text-white px-5 py-2.5 rounded-full font-semibold hover:bg-purple-700 transition shadow-md">Reserve</a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" id="mobile-menu-button" class="text-stone-500 hover:text-stone-900 focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-stone-100">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-stone-700 hover:bg-stone-50">Home</a>
            <a href="about.php" class="block px-3 py-2 rounded-md text-base font-medium text-stone-700 hover:bg-stone-50">About</a>
            <a href="menu.php" class="block px-3 py-2 rounded-md text-base font-medium text-stone-700 hover:bg-stone-50">Menu</a>
            <a href="gallery.php" class="block px-3 py-2 rounded-md text-base font-medium text-stone-700 hover:bg-stone-50">Gallery</a>
            <a href="offers.php" class="block px-3 py-2 rounded-md text-base font-medium text-stone-700 hover:bg-stone-50">Offers</a>
            <a href="contact.php" class="block px-3 py-2 rounded-md text-base font-medium text-stone-700 hover:bg-stone-50">Contact</a>
            <a href="reservations.php" class="block px-3 py-2 rounded-md text-base font-bold text-purple-600 hover:bg-stone-50">Reservations</a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
