<?php
/**
 * Orchid Cafe - Shared Footer
 */
?>
<footer class="bg-stone-900 text-stone-400 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
        <!-- Brand -->
        <div class="space-y-6">
            <div class="flex items-center gap-2">
                <?php if (!empty($settings['logo'])): ?>
                    <img src="<?php echo h($settings['logo']); ?>" alt="Logo" class="h-8 w-auto brightness-0 invert opacity-70">
                <?php else: ?>
                    <span class="bg-purple-600 text-white w-8 h-8 flex items-center justify-center rounded-lg">O</span>
                    <span class="serif text-2xl text-white font-bold"><?php echo h($settings['business_name'] ?? 'Orchid Cafe'); ?></span>
                <?php endif; ?>
            </div>
            <p class="text-sm leading-relaxed">
                <?php echo h($settings['footer_about'] ?? 'Experience the finest dining in Lahan. From authentic Steam Momo to our signature Biryani, we bring flavors that stay with you.'); ?>
            </p>
            <div class="flex gap-4">
                <?php if (!empty($settings['facebook_url'])): ?>
                    <a href="<?php echo h($settings['facebook_url']); ?>" class="hover:text-white transition"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['instagram_url'])): ?>
                    <a href="<?php echo h($settings['instagram_url']); ?>" class="hover:text-white transition"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['tiktok_url'])): ?>
                    <a href="<?php echo h($settings['tiktok_url']); ?>" class="hover:text-white transition"><i data-lucide="music-2" class="w-5 h-5"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['youtube_url'])): ?>
                    <a href="<?php echo h($settings['youtube_url']); ?>" class="hover:text-white transition"><i data-lucide="youtube" class="w-5 h-5"></i></a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="text-white font-semibold mb-6 uppercase tracking-widest text-xs">Explore</h4>
            <ul class="space-y-4 text-sm">
                <li><a href="menu.php" class="hover:text-white transition">Menu Highlights</a></li>
                <li><a href="reservations.php" class="hover:text-white transition">Book a Table</a></li>
                <li><a href="gallery.php" class="hover:text-white transition">Photo Gallery</a></li>
                <li><a href="about.php" class="hover:text-white transition">Our Story</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h4 class="text-white font-semibold mb-6 uppercase tracking-widest text-xs">Visit Us</h4>
            <ul class="space-y-4 text-sm">
                <li class="flex items-start gap-3">
                    <i data-lucide="map-pin" class="w-4 h-4 text-purple-500 mt-1"></i>
                    <span><?php echo nl2br(h($settings['address'] ?? 'PF7H+FX7, Lahan Road,\nLahan 56500, Nepal')); ?></span>
                </li>
                <li class="flex items-center gap-3">
                    <i data-lucide="phone" class="w-4 h-4 text-purple-500"></i>
                    <span><?php echo h($settings['phone'] ?? '+977-XXXXXXXXXX'); ?></span>
                </li>
                <li class="flex items-center gap-3">
                    <i data-lucide="mail" class="w-4 h-4 text-purple-500"></i>
                    <span><?php echo h($settings['email'] ?? 'info@orchidcafelahan.com'); ?></span>
                </li>
            </ul>
        </div>

        <!-- Opening Hours -->
        <div>
            <h4 class="text-white font-semibold mb-6 uppercase tracking-widest text-xs">Opening Hours</h4>
            <div class="text-sm space-y-4">
                <?php echo nl2br(h($settings['opening_hours_text'] ?? 'Mon - Thu: 10:00 AM - 10:00 PM\nFri - Sun: 09:00 AM - 11:00 PM')); ?>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 pt-8 border-t border-stone-800 flex flex-col md:flex-row justify-between items-center text-xs">
        <p>&copy; <?php echo date('Y'); ?> <?php echo h($settings['business_name'] ?? 'Orchid Cafe'); ?>, Lahan. All Rights Reserved.</p>
        <div class="flex gap-6 mt-4 md:mt-0">
            <a href="#" class="hover:text-white transition">Privacy Policy</a>
            <a href="#" class="hover:text-white transition">Terms of Service</a>
            <a href="admin/login.php" class="hover:text-white transition">Staff Login</a>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/js/main.js"></script>
<!-- Lucide Icon Initialization -->
<script>
    lucide.createIcons();
</script>
</body>
</html>
