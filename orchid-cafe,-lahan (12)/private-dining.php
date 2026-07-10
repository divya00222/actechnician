<?php
/**
 * Orchid Cafe - Private Dining & Events
 */
$page_title = "Private Dining & Events";
require_once 'includes/header.php';
?>

<!-- Hero -->
<section class="relative h-[60vh] flex items-center">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&q=80&w=2000" alt="Private Event" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-900/60"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 text-white">
        <h1 class="text-5xl md:text-7xl font-bold serif italic mb-4">Elevated Events</h1>
        <p class="text-lg text-stone-300 max-w-xl">Create unforgettable memories in our exclusive private dining rooms.</p>
    </div>
</section>

<!-- Features -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <div class="space-y-4">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto">
                    <i data-lucide="users" class="w-8 h-8 text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold">Up to 40 Guests</h3>
                <p class="text-stone-500 text-sm">Flexible seating arrangements for intimate gatherings or large parties.</p>
            </div>
            <div class="space-y-4">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto">
                    <i data-lucide="chef-hat" class="w-8 h-8 text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold">Custom Menus</h3>
                <p class="text-stone-500 text-sm">Work with our chef to design a menu tailored to your preferences.</p>
            </div>
            <div class="space-y-4">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto">
                    <i data-lucide="music" class="w-8 h-8 text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold">Full Amenities</h3>
                <p class="text-stone-500 text-sm">Audio-visual equipment and ambient lighting for all types of events.</p>
            </div>
        </div>
    </div>
</section>

<!-- Inquiry Section -->
<section class="py-24 bg-stone-50">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-3xl p-8 md:p-16 shadow-xl border border-stone-100">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Event Inquiry</h2>
                <p class="text-stone-500">Tell us about your event and we'll get back to you with a custom proposal.</p>
            </div>
            
            <form action="actions/event-submit.php" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Full Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 outline-none transition">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Phone</label>
                        <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 outline-none transition">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Event Type</label>
                        <select name="event_type" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 outline-none transition">
                            <option value="corporate">Corporate Meeting</option>
                            <option value="birthday">Birthday Celebration</option>
                            <option value="wedding">Engagement / Reception</option>
                            <option value="other">Social Gathering</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Preferred Date</label>
                        <input type="date" name="date" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 outline-none transition">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Expected Guests</label>
                        <input type="number" name="guest_count" min="5" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 outline-none transition">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-stone-500 uppercase tracking-widest">Additional Details</label>
                    <textarea name="details" rows="4" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 outline-none transition" placeholder="Tell us about decor, budget, or menu requirements..."></textarea>
                </div>
                <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition">Submit Inquiry</button>
            </form>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
