<?php
/**
 * Orchid Cafe - Shared Header
 */
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

$settings = getAllSettings($pdo);
$page_title = isset($page_title) ? $page_title . " | " . ($settings['business_name'] ?? 'Orchid Cafe') : ($settings['site_title'] ?? "Orchid Cafe, Lahan - Best Restaurant & Cafe");
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($page_title); ?></title>
    
    <?php if (!empty($settings['favicon'])): ?>
    <link rel="icon" type="image/png" href="<?php echo h($settings['favicon']); ?>">
    <?php endif; ?>
    
    <!-- Meta Tags -->
    <meta name="description" content="<?php echo h($settings['meta_description'] ?? 'Orchid Cafe, Lahan - Premium dining experience with Steam Chicken Momo, Biryani, and more.'); ?>">
    <meta name="keywords" content="Restaurant Lahan, Cafe Lahan, Orchid Cafe, Nepali Food, Biryani Lahan, Momo Lahan">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --brand-primary: #8B5CF6; /* Orchid Purple */
            --brand-dark: #1F2937;
        }
        body {
            font-family: 'Outfit', sans-serif;
        }
        h1, h2, h3, .serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-stone-50 text-slate-800">

<!-- Top Bar -->
<div class="bg-stone-900 text-stone-300 py-2 text-xs md:text-sm px-4 hidden md:block">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex gap-4">
            <span class="flex items-center gap-1"><i data-lucide="phone" class="w-3 h-3"></i> <?php echo h($settings['phone'] ?? '+977-XXXXXXXXXX'); ?></span>
            <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i> <?php echo h($settings['address'] ?? 'Lahan, Nepal'); ?></span>
        </div>
        <div class="flex gap-4 uppercase tracking-widest font-medium">
            <a href="reservations.php" class="hover:text-white transition">Book a Table</a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/navbar.php'; ?>

<?php display_flash_message(); ?>
