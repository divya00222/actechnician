<?php
/**
 * Orchid Cafe - Admin Dashboard
 */
$page_title = "Overview";
require_once 'partials/header.php';

// Fetch Statistics (Counts)
$stats = [
    'menu'         => $pdo->query("SELECT COUNT(*) FROM menu_items")->fetchColumn(),
    'reservations' => $pdo->query("SELECT COUNT(*) FROM reservations WHERE status = 'pending'")->fetchColumn(),
    'messages'     => $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'unread'")->fetchColumn(),
    'events'       => $pdo->query("SELECT COUNT(*) FROM event_inquiries WHERE status = 'pending'")->fetchColumn(),
    'offers'       => $pdo->query("SELECT COUNT(*) FROM offers WHERE status = 'active'")->fetchColumn(),
    'gallery'      => $pdo->query("SELECT COUNT(*) FROM gallery_images")->fetchColumn(),
];

// Recent Activities (Mocking for now)
$recent_reservations = $pdo->query("SELECT * FROM reservations ORDER BY created_at DESC LIMIT 5")->fetchAll();
$recent_messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>

<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
        <!-- Menu Items -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <i data-lucide="utensils" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Menu</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['menu']; ?></h3>
            </div>
        </div>

        <!-- Pending Reservations -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                <i data-lucide="calendar" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Reservations</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['reservations']; ?></h3>
            </div>
        </div>

        <!-- Unread Messages -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                <i data-lucide="mail" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Messages</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['messages']; ?></h3>
            </div>
        </div>

        <!-- Pending Events -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-pink-50 text-pink-600 rounded-xl flex items-center justify-center">
                <i data-lucide="star" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Inquiries</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['events']; ?></h3>
            </div>
        </div>

        <!-- Active Offers -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">
                <i data-lucide="tag" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Offers</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['offers']; ?></h3>
            </div>
        </div>

        <!-- Gallery Items -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                <i data-lucide="image" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Gallery</p>
                <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['gallery']; ?></h3>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Actions -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                <h4 class="text-lg font-bold mb-6">Quick Actions</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="menu-add.php" class="p-6 bg-gray-50 rounded-2xl text-center hover:bg-purple-50 hover:text-purple-600 transition group">
                        <i data-lucide="plus-circle" class="w-6 h-6 mx-auto mb-3 text-gray-400 group-hover:text-purple-600"></i>
                        <span class="text-sm font-bold">Add Dish</span>
                    </a>
                    <a href="offers-add.php" class="p-6 bg-gray-50 rounded-2xl text-center hover:bg-purple-50 hover:text-purple-600 transition group">
                        <i data-lucide="plus-circle" class="w-6 h-6 mx-auto mb-3 text-gray-400 group-hover:text-purple-600"></i>
                        <span class="text-sm font-bold">Create Offer</span>
                    </a>
                    <a href="gallery-upload.php" class="p-6 bg-gray-50 rounded-2xl text-center hover:bg-purple-50 hover:text-purple-600 transition group">
                        <i data-lucide="upload-cloud" class="w-6 h-6 mx-auto mb-3 text-gray-400 group-hover:text-purple-600"></i>
                        <span class="text-sm font-bold">Upload Photo</span>
                    </a>
                    <a href="settings.php" class="p-6 bg-gray-50 rounded-2xl text-center hover:bg-purple-50 hover:text-purple-600 transition group">
                        <i data-lucide="edit-3" class="w-6 h-6 mx-auto mb-3 text-gray-400 group-hover:text-purple-600"></i>
                        <span class="text-sm font-bold">Edit Info</span>
                    </a>
                </div>
            </div>

            <!-- Recent Reservations -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                    <h4 class="text-lg font-bold">Recent Reservations</h4>
                    <a href="reservations.php" class="text-xs font-bold text-purple-600 uppercase tracking-widest hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-[10px] uppercase tracking-widest font-bold text-gray-400">
                                <th class="px-8 py-4">Guest</th>
                                <th class="px-8 py-4">Date & Time</th>
                                <th class="px-8 py-4">Guests</th>
                                <th class="px-8 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach ($recent_reservations as $res): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-8 py-4">
                                    <p class="font-bold text-gray-800"><?php echo h($res['name']); ?></p>
                                    <p class="text-xs text-gray-400"><?php echo h($res['phone']); ?></p>
                                </td>
                                <td class="px-8 py-4">
                                    <p class="text-sm text-gray-600"><?php echo date('M d, Y', strtotime($res['reservation_date'])); ?></p>
                                    <p class="text-xs text-gray-400"><?php echo date('h:i A', strtotime($res['reservation_time'])); ?></p>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="text-sm font-medium text-gray-600"><?php echo $res['guests']; ?> Persons</span>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest <?php echo $res['status'] == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700'; ?>">
                                        <?php echo h($res['status']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($recent_reservations)): ?>
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">No reservations yet.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Recent Messages -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden h-full">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                    <h4 class="text-lg font-bold">New Messages</h4>
                    <a href="messages.php" class="text-xs font-bold text-purple-600 uppercase tracking-widest hover:underline">Inbox</a>
                </div>
                <div class="p-8 space-y-8">
                    <?php foreach ($recent_messages as $msg): ?>
                    <div class="flex gap-4">
                        <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center shrink-0 font-bold">
                            <?php echo strtoupper(substr($msg['name'], 0, 1)); ?>
                        </div>
                        <div class="space-y-1">
                            <div class="flex justify-between items-start">
                                <h5 class="text-sm font-bold text-gray-800"><?php echo h($msg['name']); ?></h5>
                                <span class="text-[10px] text-gray-400"><?php echo date('M d', strtotime($msg['created_at'])); ?></span>
                            </div>
                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                <?php echo h($msg['message']); ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if (empty($recent_messages)): ?>
                        <div class="text-center py-12">
                            <i data-lucide="inbox" class="w-12 h-12 text-gray-200 mx-auto mb-4"></i>
                            <p class="text-sm text-gray-400">No new messages.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once 'partials/footer.php'; ?>
