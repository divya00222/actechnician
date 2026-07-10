<?php
/**
 * Orchid Cafe - Admin: Gallery Management
 */
$page_title = "Gallery Management";
require_once 'partials/header.php';

// Fetch Gallery Images
$images = $pdo->query("SELECT * FROM gallery_images ORDER BY sort_order ASC, created_at DESC")->fetchAll();

// Check for edit
$edit_img = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM gallery_images WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_img = $stmt->fetch();
}
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- List Column -->
    <div class="lg:col-span-7 space-y-6">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Gallery Photos</h3>
                <span class="text-xs text-gray-400"><?php echo count($images); ?> Photos</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-6">
                <?php foreach ($images as $img): ?>
                <div class="group relative aspect-square rounded-2xl bg-gray-100 overflow-hidden border border-gray-100">
                    <img src="../<?php echo h($img['image_url']); ?>" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                        <a href="gallery.php?edit=<?php echo $img['id']; ?>" class="w-8 h-8 rounded-full bg-white text-blue-600 flex items-center justify-center hover:scale-110 transition">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
                        <button onclick="confirmDelete(<?php echo $img['id']; ?>)" class="w-8 h-8 rounded-full bg-white text-red-600 flex items-center justify-center hover:scale-110 transition">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2">
                        <span class="text-[8px] bg-black/50 text-white px-2 py-0.5 rounded backdrop-blur-sm uppercase tracking-widest font-bold">
                            <?php echo h($img['category']); ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if (empty($images)): ?>
                    <div class="col-span-full py-20 text-center text-gray-400 italic">No images in gallery.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Form Column -->
    <div class="lg:col-span-5">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 sticky top-8">
            <h3 class="text-xl font-bold mb-6"><?php echo $edit_img ? 'Edit' : 'Upload'; ?> Photo</h3>
            <form action="actions/gallery-save.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php if ($edit_img): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_img['id']; ?>">
                <?php endif; ?>

                <div class="space-y-4">
                    <div class="aspect-video rounded-2xl bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden relative">
                        <?php if ($edit_img): ?>
                            <img src="../<?php echo $edit_img['image_url']; ?>" class="w-full h-full object-cover" id="preview">
                        <?php else: ?>
                            <div class="text-center p-4" id="placeholder">
                                <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-300 mx-auto mb-2"></i>
                                <p class="text-xs text-gray-400">Select image file</p>
                            </div>
                            <img src="" class="w-full h-full object-cover hidden" id="preview">
                        <?php endif; ?>
                    </div>
                    <input type="file" name="image" id="file-input" <?php echo $edit_img ? '' : 'required'; ?> accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Title</label>
                    <input type="text" name="title" value="<?php echo $edit_img ? h($edit_img['title']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="e.g. Interior view">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Category</label>
                        <select name="category" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                            <option value="interior" <?php echo ($edit_img && $edit_img['category'] == 'interior') ? 'selected' : ''; ?>>Interior</option>
                            <option value="food" <?php echo ($edit_img && $edit_img['category'] == 'food') ? 'selected' : ''; ?>>Food</option>
                            <option value="events" <?php echo ($edit_img && $edit_img['category'] == 'events') ? 'selected' : ''; ?>>Events</option>
                            <option value="other" <?php echo ($edit_img && $edit_img['category'] == 'other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Sort Order</label>
                        <input type="number" name="sort_order" value="<?php echo $edit_img ? $edit_img['sort_order'] : '0'; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Alt Text</label>
                    <input type="text" name="alt_text" value="<?php echo $edit_img ? h($edit_img['alt_text']) : ''; ?>" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-600 outline-none transition" placeholder="SEO description">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                        <?php echo $edit_img ? 'Update Image' : 'Upload Image'; ?>
                    </button>
                    <?php if ($edit_img): ?>
                        <a href="gallery.php" class="bg-gray-100 text-gray-600 px-6 py-4 rounded-xl font-bold hover:bg-gray-200 transition">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    const fileInput = document.getElementById('file-input');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');

    fileInput.onchange = evt => {
        const [file] = fileInput.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        }
    }

    function confirmDelete(id) {
        if (confirm('Delete this image permanently?')) {
            window.location.href = 'actions/gallery-delete.php?id=' + id;
        }
    }
</script>

<?php require_once 'partials/footer.php'; ?>
