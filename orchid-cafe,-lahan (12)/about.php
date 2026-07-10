<?php
/**
 * Orchid Cafe - About Page
 */
$page_title = "Our Story - Since 2015";
require_once 'includes/header.php';
?>

<!-- Simple Header -->
<section class="bg-stone-900 py-32 text-white text-center">
    <div class="max-w-7xl mx-auto px-4">
        <span class="uppercase tracking-widest text-sm text-purple-400 mb-4 block">About Us</span>
        <h1 class="text-5xl md:text-7xl font-bold serif italic mb-6">Orchid Cafe</h1>
        <p class="text-stone-400 max-w-2xl mx-auto text-lg leading-relaxed">
            A decade of flavors, family, and Lahan's finest hospitality.
        </p>
    </div>
</section>

<!-- Content Grid -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
            <div class="space-y-12">
                <div class="space-y-6">
                    <h2 class="text-4xl font-bold text-stone-900 leading-tight">Authenticity in <br><span class="serif text-purple-600 italic">Every Detail.</span></h2>
                    <p class="text-stone-600 leading-relaxed text-lg">
                        Founded in 2015, Orchid Cafe was born out of a passion for bringing high-quality dining to Lahan. We started as a small coffee spot and evolved into the full-service restaurant you know today.
                    </p>
                    <p class="text-stone-600 leading-relaxed">
                        Our secret? Consistency. We source the freshest ingredients from local farmers in Saptari and Siraha districts, ensuring that every Momo, every Biryani, and every cup of coffee meets the "Orchid Standard."
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-8 bg-stone-50 rounded-2xl border-l-4 border-purple-600">
                        <i data-lucide="award" class="w-8 h-8 text-purple-600 mb-4"></i>
                        <h4 class="font-bold mb-2">Quality First</h4>
                        <p class="text-sm text-stone-500">We never compromise on hygiene or ingredient freshness.</p>
                    </div>
                    <div class="p-8 bg-stone-50 rounded-2xl border-l-4 border-purple-600">
                        <i data-lucide="users" class="w-8 h-8 text-purple-600 mb-4"></i>
                        <h4 class="font-bold mb-2">Community Led</h4>
                        <p class="text-sm text-stone-500">We take pride in being a favorite gathering spot for Lahan residents.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4 pt-12">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&q=80&w=600" alt="Kitchen" class="rounded-2xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&q=80&w=600" alt="Food Prep" class="rounded-2xl shadow-lg">
                </div>
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1550966841-3ee7adac1661?auto=format&fit=crop&q=80&w=600" alt="Ambience" class="rounded-2xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&q=80&w=600" alt="Restaurant Interior" class="rounded-2xl shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-24 bg-stone-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl font-bold mb-4 serif italic">Our Pillars</h2>
            <p class="text-stone-400">What keeps us moving forward every day.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center space-y-6">
                <div class="w-20 h-20 bg-purple-600/20 rounded-full flex items-center justify-center mx-auto mb-8 border border-purple-600/30">
                    <i data-lucide="heart" class="w-10 h-10 text-purple-400"></i>
                </div>
                <h3 class="text-2xl font-bold">Passion</h3>
                <p class="text-stone-400 leading-relaxed">Cooking isn't just a business for us; it's a craft. Every recipe is a tribute to our love for great food.</p>
            </div>

            <div class="text-center space-y-6">
                <div class="w-20 h-20 bg-purple-600/20 rounded-full flex items-center justify-center mx-auto mb-8 border border-purple-600/30">
                    <i data-lucide="shield-check" class="w-10 h-10 text-purple-400"></i>
                </div>
                <h3 class="text-2xl font-bold">Integrity</h3>
                <p class="text-stone-400 leading-relaxed">Honest pricing, honest portions, and an honest atmosphere. We treat our customers like family.</p>
            </div>

            <div class="text-center space-y-6">
                <div class="w-20 h-20 bg-purple-600/20 rounded-full flex items-center justify-center mx-auto mb-8 border border-purple-600/30">
                    <i data-lucide="coffee" class="w-10 h-10 text-purple-400"></i>
                </div>
                <h3 class="text-2xl font-bold">Hospitality</h3>
                <p class="text-stone-400 leading-relaxed">A smile is served with every dish. Our staff is trained to provide the best service in the city.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-24 bg-white text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-4xl font-bold mb-8">Join Us at the <span class="serif text-purple-600 italic">Table</span></h2>
        <p class="text-stone-600 mb-10 leading-relaxed text-lg">Whether it's your first time or your hundredth, there's always something special waiting for you at Orchid Cafe.</p>
        <a href="reservations.php" class="bg-purple-600 text-white px-10 py-5 rounded-full font-bold hover:bg-purple-700 transition inline-flex items-center gap-2 shadow-xl">
            Reserve Your Spot <i data-lucide="calendar" class="w-5 h-5"></i>
        </a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
