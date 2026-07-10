<?php
/**
 * Orchid Cafe - Admin Header
 */
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

require_admin_auth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' | ' . APP_NAME . ' Admin' : APP_NAME . ' Administration'; ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for simplicity in this project) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

<div class="flex">
    <!-- Sidebar -->
    <?php require_once __DIR__ . '/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 p-8 lg:ml-72 min-h-screen">
        <!-- Top Nav -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-800"><?php echo h($page_title ?? 'Dashboard'); ?></h1>
                <p class="text-sm text-gray-400 mt-1">Manage your cafe operations</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="../index.php" target="_blank" class="flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-purple-600 transition uppercase tracking-widest bg-white px-4 py-2 rounded-xl border border-gray-100">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    View Site
                </a>
                <div class="h-10 w-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 font-bold border border-purple-200">
                    <?php echo strtoupper(substr($_SESSION['admin_user']['username'], 0, 1)); ?>
                </div>
            </div>
        </div>

        <?php display_flash_message(); ?>
