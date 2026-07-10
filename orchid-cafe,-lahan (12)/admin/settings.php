<?php
/**
 * Orchid Cafe - Business Settings
 */
$page_title = 'Business Settings';
require_once __DIR__ . '/partials/header.php';

$settings = getAllSettings($pdo);
?>

<div class="max-w-4xl">
    <form action="actions/save-settings.php" method="POST" enctype="multipart/form-data" class="space-y-8">
        
        <!-- Basic Info -->
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-50">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="info" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Basic Business Info</h3>
                    <p class="text-sm text-gray-400">Core identity and contact details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Restaurant Name</label>
                    <input type="text" name="business_name" value="<?php echo h($settings['business_name'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Tagline</label>
                    <input type="text" name="tagline" value="<?php echo h($settings['tagline'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Full Address</label>
                    <input type="text" name="address" value="<?php echo h($settings['address'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Primary Phone</label>
                    <input type="text" name="phone" value="<?php echo h($settings['phone'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">WhatsApp Number</label>
                    <input type="text" name="whatsapp" value="<?php echo h($settings['whatsapp'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Primary Email</label>
                    <input type="email" name="email" value="<?php echo h($settings['email'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Established Since</label>
                    <input type="text" name="established_since" value="<?php echo h($settings['established_since'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
            </div>
        </div>

        <!-- Branding -->
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-50">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="image" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Branding</h3>
                    <p class="text-sm text-gray-400">Logo and site visuals</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <label class="text-sm font-bold text-gray-600 ml-1">Site Logo</label>
                    <div class="flex items-center gap-4">
                        <?php if (!empty($settings['logo'])): ?>
                            <img src="../<?php echo h($settings['logo']); ?>" alt="Logo" class="w-20 h-20 object-contain rounded-xl bg-gray-50 border border-gray-100 p-2">
                        <?php endif; ?>
                        <input type="file" name="logo" class="text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-purple-50 file:text-purple-600 hover:file:bg-purple-100">
                    </div>
                </div>
                <div class="space-y-4">
                    <label class="text-sm font-bold text-gray-600 ml-1">Favicon</label>
                    <div class="flex items-center gap-4">
                        <?php if (!empty($settings['favicon'])): ?>
                            <img src="../<?php echo h($settings['favicon']); ?>" alt="Favicon" class="w-10 h-10 object-contain rounded-lg bg-gray-50 border border-gray-100 p-1">
                        <?php endif; ?>
                        <input type="file" name="favicon" class="text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-purple-50 file:text-purple-600 hover:file:bg-purple-100">
                    </div>
                </div>
            </div>
        </div>

        <!-- Homepage Content -->
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-50">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="layout" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Homepage Content</h3>
                    <p class="text-sm text-gray-400">Hero section and global display</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Hero Title</label>
                    <input type="text" name="hero_title" value="<?php echo h($settings['hero_title'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Hero Subtitle</label>
                    <textarea name="hero_subtitle" rows="3" 
                              class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition"><?php echo h($settings['hero_subtitle'] ?? ''); ?></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-600 ml-1">Hero CTA Text</label>
                        <input type="text" name="hero_cta_text" value="<?php echo h($settings['hero_cta_text'] ?? ''); ?>" 
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-600 ml-1">Hero CTA Link</label>
                        <input type="text" name="hero_cta_link" value="<?php echo h($settings['hero_cta_link'] ?? ''); ?>" 
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Footer About Text</label>
                    <textarea name="footer_about" rows="3" 
                              class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition"><?php echo h($settings['footer_about'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Social & Map -->
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-50">
                <div class="w-12 h-12 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="share-2" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Social Media & Map</h3>
                    <p class="text-sm text-gray-400">External links and embeds</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Facebook URL</label>
                    <input type="url" name="facebook_url" value="<?php echo h($settings['facebook_url'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Instagram URL</label>
                    <input type="url" name="instagram_url" value="<?php echo h($settings['instagram_url'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Google Maps Embed URL</label>
                    <textarea name="map_embed_url" rows="3" 
                              class="w-full px-5 py-4 font-mono text-xs bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition"><?php echo h($settings['map_embed_url'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <!-- SEO -->
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-50">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="search" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">SEO / Meta Basics</h3>
                    <p class="text-sm text-gray-400">Search engine optimization</p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Site Title Tag</label>
                    <input type="text" name="site_title" value="<?php echo h($settings['site_title'] ?? ''); ?>" 
                           class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-600 ml-1">Meta Description</label>
                    <textarea name="meta_description" rows="3" 
                              class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-600/20 focus:border-purple-600 transition"><?php echo h($settings['meta_description'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end pt-4 pb-12">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-10 py-5 rounded-3xl font-bold transition shadow-xl shadow-purple-200 flex items-center gap-3">
                <i data-lucide="save" class="w-5 h-5"></i>
                Save All Settings
            </button>
        </div>

    </form>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
