<?php
/**
 * Orchid Cafe - Admin: Offers Management
 */
$page_title = "Special Offers";
require_once 'partials/header.php';

// Fetch Offers
$offers = $pdo->query("SELECT * FROM offers ORDER BY created_at DESC")->fetchAll();

// Check for edit
$edit_offer = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM offers WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_offer = $stmt->fetch();
}
?>

<div class="space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Promotions & Offers</h3>
            <p class="text-sm text-gray-400">Manage limited-time deals and marketing banners.</p>
        </div>
        <?php if ($edit_offer): ?>
            <a href="offers.php" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition">Create New Offer</a>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Form Column -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 sticky top-8">
                <h4 class="text-lg font-bold mb-6"><?php echo $edit_offer ? 'Edit' : 'Create'; ?> Offer</h4>
                <form action="actions/offer-save.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?php if ($edit_offer): ?>
                        <input type="hidden" name="id" value="<?php echo $edit_offer['id']; ?>">
                    <?php endif; ?>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Main Title</label>
                        <input type="text" name="title" required value="<?php echo $edit_offer ? h($edit_offer['title']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. 20% Off Dinner">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Subtitle</label>
                        <input type="text" name="subtitle" value="<?php echo $edit_offer ? h($edit_offer['subtitle']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. For HBL card holders">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Dates (Start - End)</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="start_date" value="<?php echo $edit_offer ? $edit_offer['start_date'] : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition text-sm">
                            <input type="date" name="end_date" value="<?php echo $edit_offer ? $edit_offer['end_date'] : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition text-sm">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Background Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                            <option value="active" <?php echo ($edit_offer && $edit_offer['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo ($edit_offer && $edit_offer['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                        <?php echo $edit_offer ? 'Update Offer' : 'Launch Offer'; ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- List Column -->
        <div class="lg:col-span-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($offers as $offer): ?>
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden group">
                    <div class="aspect-video relative overflow-hidden bg-gray-100">
                        <img src="../<?php echo !empty($offer['image_url']) ? h($offer['image_url']) : 'assets/placeholder.jpg'; ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest <?php echo $offer['status'] == 'active' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white'; ?>">
                                <?php echo h($offer['status']); ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h5 class="font-bold text-gray-800 text-lg"><?php echo h($offer['title']); ?></h5>
                        <p class="text-sm text-gray-500 mt-1"><?php echo h($offer['subtitle']); ?></p>
                        <div class="mt-4 flex items-center justify-between text-xs text-gray-400">
                            <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> <?php echo $offer['start_date'] ? date('M d', strtotime($offer['start_date'])) : 'Anytime'; ?> - <?php echo $offer['end_date'] ? date('M d', strtotime($offer['end_date'])) : 'Forever'; ?></span>
                            <div class="flex gap-2">
                                <a href="offers.php?edit=<?php echo $offer['id']; ?>" class="text-blue-600 font-bold hover:underline">Edit</a>
                                <button onclick="confirmOfferDelete(<?php echo $offer['id']; ?>)" class="text-red-500 font-bold hover:underline">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if (empty($offers)): ?>
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-gray-200">
                        <i data-lucide="ticket" class="w-12 h-12 text-gray-100 mx-auto mb-4"></i>
                        <p class="text-gray-400 italic">No offers active at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function confirmOfferDelete(id) {
    if (confirm('Delete this offer permanently?')) {
        window.location.href = 'actions/offer-delete.php?id=' + id;
    }
}
</script>

<?php require_once 'partials/footer.php'; ?>
