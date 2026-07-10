<?php
/**
 * Orchid Cafe - Gallery Page
 */
$page_title = "Moments at Orchid Cafe";
require_once 'includes/header.php';
?>

<!-- Minimal Header -->
<section class="bg-stone-50 py-24 border-b border-stone-200">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="uppercase tracking-widest text-[10px] text-purple-600 font-bold mb-4 block">Visual Journey</span>
        <h1 class="text-4xl md:text-6xl font-bold text-stone-900 mb-6">Capture the <span class="serif italic text-purple-600">Experience</span></h1>
        <p class="text-stone-500 max-w-xl mx-auto">Take a look inside our kitchen, our dining hall, and the happy moments shared by our guests.</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Tabs -->
        <div class="flex justify-center gap-8 mb-16 border-b border-stone-100 pb-4 overflow-x-auto whitespace-nowrap scrollbar-hide">
            <button class="pb-4 border-b-2 border-purple-600 text-stone-900 font-bold text-sm uppercase tracking-widest">All Photos</button>
            <button class="pb-4 border-b-2 border-transparent text-stone-400 font-bold text-sm uppercase tracking-widest hover:text-stone-900 transition">Ambience</button>
            <button class="pb-4 border-b-2 border-transparent text-stone-400 font-bold text-sm uppercase tracking-widest hover:text-stone-900 transition">Dishes</button>
            <button class="pb-4 border-b-2 border-transparent text-stone-400 font-bold text-sm uppercase tracking-widest hover:text-stone-900 transition">Events</button>
            <button class="pb-4 border-b-2 border-transparent text-stone-400 font-bold text-sm uppercase tracking-widest hover:text-stone-900 transition">Videos</button>
        </div>

        <!-- Masonry-style Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Item 1 -->
            <div class="group relative overflow-hidden rounded-2xl aspect-square shadow-md">
                <img src="https://images.unsplash.com/photo-1550966841-3ee7adac1661?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-stone-900/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                    <button class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-stone-900 shadow-xl scale-90 group-hover:scale-100 transition duration-300">
                        <i data-lucide="maximize-2" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="group relative overflow-hidden rounded-2xl aspect-[3/4] shadow-md row-span-2">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-stone-900/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center text-center p-6">
                    <div>
                        <h4 class="text-white font-bold mb-2">Chef in Action</h4>
                        <p class="text-stone-300 text-xs">Quality preparation in our Lahan kitchen.</p>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="group relative overflow-hidden rounded-2xl aspect-video shadow-md">
                <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            </div>

            <!-- Item 4 -->
            <div class="group relative overflow-hidden rounded-2xl aspect-square shadow-md">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            </div>

            <!-- Item 5 -->
            <div class="group relative overflow-hidden rounded-2xl aspect-square shadow-md">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            </div>

            <!-- Item 6 -->
            <div class="group relative overflow-hidden rounded-2xl aspect-[4/3] shadow-md lg:col-span-2">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute bottom-6 left-6 text-white z-10">
                    <span class="bg-purple-600 px-3 py-1 rounded text-[10px] font-bold uppercase tracking-widest mb-2 inline-block">Evening Vibe</span>
                    <h3 class="text-2xl font-bold serif italic">The Warmth of Orchid</h3>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 to-transparent"></div>
            </div>
        </div>

        <!-- Instagram CTA -->
        <div class="mt-24 border-2 border-dashed border-stone-200 rounded-3xl p-12 text-center">
            <i data-lucide="instagram" class="w-12 h-12 text-purple-600 mx-auto mb-6"></i>
            <h3 class="text-2xl font-bold mb-4">Follow Us for Daily Updates</h3>
            <p class="text-stone-500 mb-8">See what's cooking today and get notified about our flash deals.</p>
            <a href="#" class="bg-stone-900 text-white px-8 py-3 rounded-full font-bold hover:bg-stone-800 transition shadow-lg inline-flex items-center gap-2">
                @orchidcafelahan <i data-lucide="external-link" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
