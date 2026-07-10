<?php
/**
 * Orchid Cafe - Change Admin Password
 */
$page_title = 'Change Password';
require_once __DIR__ . '/partials/header.php';
?>

<div class="max-w-xl">
    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-50">
            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center">
                <i data-lucide="lock" class="w-6 h-6"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800">Change Admin Password</h3>
                <p class="text-sm text-gray-400">Update your security credentials</p>
            </div>
        </div>

        <form action="actions/change-password.php" method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="text-sm font-bold text-gray-600 ml-1">Current Password</label>
                <input type="password" name="current_password" required
                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-gray-600 ml-1">New Password</label>
                <input type="password" name="new_password" required minlength="8"
                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition">
                <p class="text-[10px] text-gray-400 ml-1 uppercase tracking-widest font-semibold">Minimum 8 characters</p>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-gray-600 ml-1">Confirm New Password</label>
                <input type="password" name="confirm_password" required minlength="8"
                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-stone-900 hover:bg-black text-white px-8 py-5 rounded-2xl font-bold transition flex items-center justify-center gap-3">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
