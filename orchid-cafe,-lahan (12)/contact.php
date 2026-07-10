<?php
/**
 * Orchid Cafe - Contact Page
 */
$page_title = "Contact Us";
require_once 'includes/header.php';
?>

<!-- Header -->
<section class="bg-stone-900 py-32 text-white text-center">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-5xl md:text-7xl font-bold serif italic mb-4">Get in Touch</h1>
        <p class="text-stone-400 max-w-xl mx-auto">We're here to help. Reach out for reservations, events, or feedback.</p>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
            
            <!-- Contact Info -->
            <div class="space-y-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <i data-lucide="map-pin" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <h4 class="font-bold text-xl">Visit Us</h4>
                        <p class="text-stone-500 text-sm leading-relaxed">
                            <?php echo nl2br(h($settings['address'] ?? "PF7H+FX7, Lahan Road,\nLahan 56500, Nepal")); ?>
                        </p>
                    </div>
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <i data-lucide="phone" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <h4 class="font-bold text-xl">Call Us</h4>
                        <p class="text-stone-500 text-sm">
                            General: <?php echo h($settings['phone'] ?? '+977-XXXXXXXXXX'); ?><br>
                            WhatsApp: <?php echo h($settings['whatsapp'] ?? '+977-XXXXXXXXXX'); ?>
                        </p>
                    </div>
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <i data-lucide="mail" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <h4 class="font-bold text-xl">Email Us</h4>
                        <p class="text-stone-500 text-sm">
                            <?php echo h($settings['email'] ?? 'info@orchidcafelahan.com'); ?>
                        </p>
                    </div>
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                            <i data-lucide="clock" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <h4 class="font-bold text-xl">Hours</h4>
                        <div class="text-stone-500 text-sm">
                            <?php echo nl2br(h($settings['opening_hours_text'] ?? "Mon - Sat: 10AM - 10PM\nSunday: 11AM - 9PM")); ?>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <?php if (!empty($settings['map_embed_url'])): ?>
                <div class="rounded-3xl overflow-hidden bg-stone-100 aspect-video relative shadow-xl">
                    <iframe src="<?php echo $settings['map_embed_url']; ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <?php else: ?>
                <!-- Map Placeholder -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-8">
                        <i data-lucide="map" class="w-12 h-12 text-stone-300 mb-4 group-hover:scale-110 transition duration-500"></i>
                        <p class="text-stone-400 font-bold uppercase tracking-widest text-xs">Interactive Map Placeholder</p>
                        <p class="text-stone-400 text-[10px] mt-2 italic">(Embedded Google Map would go here)</p>
                    </div>
                    <div class="absolute inset-0 bg-stone-900/5 group-hover:bg-transparent transition duration-500"></div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-stone-50 p-8 md:p-12 rounded-3xl border border-stone-200">
                <h3 class="text-2xl font-bold mb-8">Send a Message</h3>
                <form action="actions/contact-submit.php" method="POST" class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Your Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-stone-200 bg-white focus:border-purple-600 outline-none transition">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Email Address</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-stone-200 bg-white focus:border-purple-600 outline-none transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Subject</label>
                            <select name="subject" class="w-full px-4 py-3 rounded-xl border border-stone-200 bg-white focus:border-purple-600 outline-none transition">
                                <option value="general">General Inquiry</option>
                                <option value="feedback">Feedback</option>
                                <option value="business">Business Proposal</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Message</label>
                        <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-xl border border-stone-200 bg-white focus:border-purple-600 outline-none transition" placeholder="How can we help you?"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-stone-900 text-white py-4 rounded-xl font-bold hover:bg-stone-800 transition shadow-lg">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
