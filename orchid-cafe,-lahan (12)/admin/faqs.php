<?php
/**
 * Orchid Cafe - Admin: FAQ Management
 */
$page_title = "FAQs";
require_once 'partials/header.php';

// Fetch FAQs
$faqs = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC")->fetchAll();

// Check for edit
$edit_faq = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_faq = $stmt->fetch();
}
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- List Column -->
    <div class="lg:col-span-7 space-y-6">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50">
                <h3 class="font-bold text-gray-800">Frequently Asked Questions</h3>
            </div>
            <div class="divide-y divide-gray-50">
                <?php foreach ($faqs as $faq): ?>
                <div class="p-6 hover:bg-gray-50 transition group">
                    <div class="flex justify-between items-start gap-4">
                        <div class="space-y-1">
                            <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded font-bold">#<?php echo $faq['sort_order']; ?></span>
                            <h5 class="font-bold text-gray-800"><?php echo h($faq['question']); ?></h5>
                            <p class="text-sm text-gray-500 leading-relaxed"><?php echo h($faq['answer']); ?></p>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="faqs.php?edit=<?php echo $faq['id']; ?>" class="text-blue-600 p-2 hover:bg-blue-50 rounded-lg"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                            <button onclick="confirmFaqDelete(<?php echo $faq['id']; ?>)" class="text-red-500 p-2 hover:bg-red-50 rounded-lg"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if (empty($faqs)): ?>
                    <div class="py-20 text-center text-gray-400 italic">No FAQs added yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Form Column -->
    <div class="lg:col-span-5">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 sticky top-8">
            <h3 class="text-xl font-bold mb-6"><?php echo $edit_faq ? 'Edit' : 'Add New'; ?> FAQ</h3>
            <form action="actions/faq-save.php" method="POST" class="space-y-6">
                <?php if ($edit_faq): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_faq['id']; ?>">
                <?php endif; ?>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Question</label>
                    <input type="text" name="question" required value="<?php echo $edit_faq ? h($edit_faq['question']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. Do you offer parking?">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Answer</label>
                    <textarea name="answer" required rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="Answer details..."><?php echo $edit_faq ? h($edit_faq['answer']) : ''; ?></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Display Order</label>
                        <input type="number" name="sort_order" value="<?php echo $edit_faq ? $edit_faq['sort_order'] : '0'; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                            <option value="active" <?php echo ($edit_faq && $edit_faq['status'] == 'active') ? 'selected' : ''; ?>>Visible</option>
                            <option value="inactive" <?php echo ($edit_faq && $edit_faq['status'] == 'inactive') ? 'selected' : ''; ?>>Hidden</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                        <?php echo $edit_faq ? 'Update FAQ' : 'Save FAQ'; ?>
                    </button>
                    <?php if ($edit_faq): ?>
                        <a href="faqs.php" class="bg-gray-100 text-gray-600 px-6 py-4 rounded-xl font-bold hover:bg-gray-200 transition">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function confirmFaqDelete(id) {
    if (confirm('Delete this FAQ?')) {
        window.location.href = 'actions/faq-delete.php?id=' + id;
    }
}
</script>

<?php require_once 'partials/footer.php'; ?>
