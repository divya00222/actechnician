<?php
/**
 * Orchid Cafe - Admin: Testimonials Management
 */
$page_title = "Testimonials";
require_once 'partials/header.php';

// Fetch Testimonials
$testimonials = $pdo->query("SELECT * FROM testimonials ORDER BY created_at DESC")->fetchAll();

// Check for edit
$edit_test = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_test = $stmt->fetch();
}
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- List Column -->
    <div class="lg:col-span-7 space-y-6">
        <div class="grid grid-cols-1 gap-6">
            <?php foreach ($testimonials as $test): ?>
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 group transition hover:shadow-md">
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold shrink-0">
                        <?php if (!empty($test['customer_image'])): ?>
                            <img src="../<?php echo $test['customer_image']; ?>" class="w-full h-full rounded-full object-cover">
                        <?php else: ?>
                            <?php echo strtoupper(substr($test['customer_name'], 0, 1)); ?>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 space-y-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <h5 class="font-bold text-gray-800"><?php echo h($test['customer_name']); ?></h5>
                                <div class="flex text-amber-400">
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <i data-lucide="star" class="w-3 h-3 <?php echo $i <= $test['rating'] ? 'fill-current' : ''; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <?php if($test['is_featured']): ?>
                                    <span class="bg-purple-100 text-purple-600 text-[8px] font-bold uppercase px-1.5 py-0.5 rounded">Featured</span>
                                <?php endif; ?>
                                <span class="bg-gray-100 text-gray-500 text-[8px] font-bold uppercase px-1.5 py-0.5 rounded"><?php echo $test['status']; ?></span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 italic leading-relaxed">"<?php echo h($test['review']); ?>"</p>
                        <div class="pt-4 flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition">
                            <a href="testimonials.php?edit=<?php echo $test['id']; ?>" class="text-xs font-bold text-blue-600 uppercase tracking-widest hover:underline">Edit</a>
                            <button onclick="confirmTestDelete(<?php echo $test['id']; ?>)" class="text-xs font-bold text-red-500 uppercase tracking-widest hover:underline">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($testimonials)): ?>
                <div class="bg-white rounded-3xl border border-dashed border-gray-200 p-20 text-center text-gray-400 italic">No testimonials yet.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Form Column -->
    <div class="lg:col-span-5">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 sticky top-8">
            <h3 class="text-xl font-bold mb-6"><?php echo $edit_test ? 'Edit' : 'Add New'; ?> Review</h3>
            <form action="actions/testimonial-save.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php if ($edit_test): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_test['id']; ?>">
                <?php endif; ?>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Customer Name</label>
                    <input type="text" name="customer_name" required value="<?php echo $edit_test ? h($edit_test['customer_name']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. Sarah J.">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Rating (1-5)</label>
                        <select name="rating" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                            <?php for($i=5; $i>=1; $i--): ?>
                                <option value="<?php echo $i; ?>" <?php echo ($edit_test && $edit_test['rating'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?> Stars</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                            <option value="active" <?php echo ($edit_test && $edit_test['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo ($edit_test && $edit_test['status'] == 'inactive') ? 'selected' : ''; ?>>Hidden</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Review Text</label>
                    <textarea name="review" required rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="What did they say?"><?php echo $edit_test ? h($edit_test['review']) : ''; ?></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Customer Photo (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700">
                </div>

                <label class="flex items-center gap-3 p-4 rounded-2xl border border-gray-100 bg-gray-50 cursor-pointer hover:bg-white transition">
                    <input type="checkbox" name="is_featured" value="1" <?php echo ($edit_test && $edit_test['is_featured']) ? 'checked' : ''; ?> class="w-5 h-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    <span class="text-sm font-bold text-gray-700">Show on Homepage</span>
                </label>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                        <?php echo $edit_test ? 'Update Review' : 'Add Review'; ?>
                    </button>
                    <?php if ($edit_test): ?>
                        <a href="testimonials.php" class="bg-gray-100 text-gray-600 px-6 py-4 rounded-xl font-bold hover:bg-gray-200 transition">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function confirmTestDelete(id) {
    if (confirm('Delete this testimonial?')) {
        window.location.href = 'actions/testimonial-delete.php?id=' + id;
    }
}
</script>

<?php require_once 'partials/footer.php'; ?>
