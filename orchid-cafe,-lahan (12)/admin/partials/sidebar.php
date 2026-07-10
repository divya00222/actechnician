<?php
/**
 * Orchid Cafe - Admin Sidebar
 */
$current_page = basename($_SERVER['PHP_SELF']);

$nav_items = [
    ['icon' => 'layout-dashboard', 'label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['icon' => 'list', 'label' => 'Menu Items', 'url' => 'menu-items.php'],
    ['icon' => 'grid', 'label' => 'Categories', 'url' => 'menu-categories.php'],
    ['icon' => 'calendar', 'label' => 'Reservations', 'url' => 'reservations.php'],
    ['icon' => 'party-popper', 'label' => 'Event Inquiries', 'url' => 'events.php'],
    ['icon' => 'mail', 'label' => 'Messages', 'url' => 'messages.php'],
    ['icon' => 'tag', 'label' => 'Offers', 'url' => 'offers.php'],
    ['icon' => 'image', 'label' => 'Gallery', 'url' => 'gallery.php'],
    ['icon' => 'message-square', 'label' => 'Testimonials', 'url' => 'testimonials.php'],
    ['icon' => 'help-circle', 'label' => 'FAQs', 'url' => 'faqs.php'],
    ['icon' => 'settings', 'label' => 'Settings', 'url' => 'settings.php'],
    ['icon' => 'key', 'label' => 'Password', 'url' => 'change-password.php'],
];
?>

<aside id="admin-sidebar" class="fixed inset-y-0 left-0 w-72 bg-white border-r border-gray-100 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="h-full flex flex-col p-6">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-2 mb-10">
            <div class="w-10 h-10 bg-purple-600 rounded-xl flex items-center justify-center">
                <i data-lucide="flower-2" class="text-white w-6 h-6"></i>
            </div>
            <div>
                <span class="block font-extrabold text-lg text-gray-800 leading-none">Orchid Admin</span>
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 block">Lahan Branch</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 space-y-1">
            <?php foreach ($nav_items as $item): ?>
            <a href="<?php echo $item['url']; ?>" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 group <?php echo $current_page == $item['url'] ? 'bg-purple-50 text-purple-600 font-bold' : 'text-gray-400 hover:bg-gray-50 hover:text-gray-600'; ?>">
                <i data-lucide="<?php echo $item['icon']; ?>" class="w-5 h-5 <?php echo $current_page == $item['url'] ? 'text-purple-600' : 'text-gray-300 group-hover:text-gray-400'; ?>"></i>
                <span class="text-sm"><?php echo $item['label']; ?></span>
            </a>
            <?php endforeach; ?>
        </nav>

        <!-- User/Footer -->
        <div class="mt-auto pt-6 border-t border-gray-50 space-y-4">
            <div class="px-2">
                <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Logged in as</p>
                <p class="text-sm font-bold text-gray-700"><?php echo h($_SESSION['admin_user']['username']); ?></p>
            </div>
            <a href="logout.php" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-red-400 hover:bg-red-50 hover:text-red-600 transition-all font-bold">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span class="text-sm">Logout</span>
            </a>
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div id="admin-sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>
