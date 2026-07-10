<?php
/**
 * Orchid Cafe - Reservations Page
 */
$page_title = "Book a Table";
require_once 'includes/header.php';
?>

<!-- Hero -->
<section class="bg-stone-900 py-24 text-white text-center">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl md:text-6xl font-bold serif italic mb-4">Reservations</h1>
        <p class="text-stone-400 max-w-xl mx-auto uppercase tracking-widest text-xs">Secure your spot for an exceptional dining experience</p>
    </div>
</section>

<!-- Reservation Content -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <!-- Information Column -->
            <div class="lg:col-span-5 space-y-12">
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-stone-900">Dining <span class="serif text-purple-600 italic">Policies</span></h2>
                    <p class="text-stone-600 leading-relaxed">
                        To ensure the best experience for all our guests, please note our reservation guidelines:
                    </p>
                    <ul class="space-y-4 text-stone-600">
                        <li class="flex gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-purple-600 flex-shrink-0"></i>
                            <span>Reservations are held for 15 minutes past the scheduled time.</span>
                        </li>
                        <li class="flex gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-purple-600 flex-shrink-0"></i>
                            <span>For groups larger than 10, please contact us directly via phone.</span>
                        </li>
                        <li class="flex gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-purple-600 flex-shrink-0"></i>
                            <span>Happy hour is first-come, first-served in the lounge area.</span>
                        </li>
                    </ul>
                </div>

                <div class="p-8 bg-stone-50 rounded-3xl border border-stone-200">
                    <h4 class="font-bold text-lg mb-4">Need Help?</h4>
                    <p class="text-sm text-stone-500 mb-6">If you have trouble booking online or have special requirements, call our host.</p>
                    <a href="tel:<?php echo h($settings['phone'] ?? '+977-XXXXXXXXXX'); ?>" class="flex items-center gap-3 text-stone-900 font-bold text-xl">
                        <i data-lucide="phone-call" class="w-6 h-6 text-purple-600"></i>
                        <?php echo h($settings['phone'] ?? '+977-XXXXXXXXXX'); ?>
                    </a>
                </div>
            </div>

            <!-- Form Column -->
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-2xl shadow-stone-200 border border-stone-100 p-8 md:p-12 relative -mt-32 lg:mt-0 z-10">
                <form action="actions/reservation-submit.php" method="POST" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Full Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition" placeholder="John Doe">
                        </div>
                        <!-- Phone -->
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Phone Number</label>
                            <input type="tel" name="phone" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition" placeholder="+977 XXXXXXXXXX">
                        </div>
                        <!-- Email -->
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Email Address</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition" placeholder="john@example.com">
                        </div>
                        <!-- Date -->
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Date</label>
                            <input type="date" name="date" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition">
                        </div>
                        <!-- Time -->
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Time</label>
                            <select name="time" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition">
                                <option value="">Select Time</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="12:00">12:00 PM</option>
                                <option value="13:00">01:00 PM</option>
                                <option value="18:00">06:00 PM</option>
                                <option value="19:00">07:00 PM</option>
                                <option value="20:00">08:00 PM</option>
                            </select>
                        </div>
                        <!-- Guests -->
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Number of Guests</label>
                            <input type="number" name="guests" min="1" max="10" required class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition" value="2">
                        </div>
                        <!-- Occasion -->
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Occasion</label>
                            <select name="occasion" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition">
                                <option value="none">Regular Meal</option>
                                <option value="birthday">Birthday</option>
                                <option value="anniversary">Anniversary</option>
                                <option value="business">Business</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Seating -->
                    <div class="space-y-4">
                        <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Seating Preference</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <label class="relative flex items-center p-4 rounded-xl border border-stone-200 cursor-pointer hover:bg-stone-50 transition group">
                                <input type="radio" name="seating" value="any" checked class="hidden peer">
                                <div class="w-full text-center">
                                    <span class="block font-bold text-sm peer-checked:text-purple-600">No Preference</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-purple-600 rounded-xl transition"></div>
                            </label>
                            <label class="relative flex items-center p-4 rounded-xl border border-stone-200 cursor-pointer hover:bg-stone-50 transition group">
                                <input type="radio" name="seating" value="window" class="hidden peer">
                                <div class="w-full text-center">
                                    <span class="block font-bold text-sm peer-checked:text-purple-600">Window</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-purple-600 rounded-xl transition"></div>
                            </label>
                            <label class="relative flex items-center p-4 rounded-xl border border-stone-200 cursor-pointer hover:bg-stone-50 transition group">
                                <input type="radio" name="seating" value="private" class="hidden peer">
                                <div class="w-full text-center">
                                    <span class="block font-bold text-sm peer-checked:text-purple-600">Private</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-purple-600 rounded-xl transition"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Special Request -->
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest font-bold text-stone-500">Special Requests</label>
                        <textarea name="requests" rows="3" class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 outline-none transition" placeholder="Allergies, high chair, surprise cake..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                        Confirm My Request
                    </button>
                    
                    <p class="text-center text-xs text-stone-400">By clicking confirm, you agree to our reservation terms.</p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
