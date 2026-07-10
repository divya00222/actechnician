<?php
/**
 * Orchid Cafe - Admin Login
 */
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

// Redirect if already logged in
if (is_admin_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean_input($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            // Success: Regenerate session ID for security
            session_regenerate_id(true);

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'];
            $_SESSION['admin_user'] = [
                'username' => $admin['username'],
                'full_name' => $admin['full_name']
            ];
            
            set_flash_message('success', 'Welcome back, ' . $admin['full_name'] . '!');
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Orchid Cafe</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <div class="bg-purple-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-purple-500/20">
                <i data-lucide="shield-check" class="w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Admin Console</h1>
            <p class="text-slate-400 mt-2">Sign in to manage Orchid Cafe</p>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-2xl">
            <?php if (isset($error)): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm font-medium mb-6 flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Username</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="username" required class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 focus:border-purple-600 outline-none transition" placeholder="admin_user">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="password" name="password" required class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 focus:border-purple-600 outline-none transition" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white py-4 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                    Sign In
                </button>
            </form>
        </div>

        <div class="text-center mt-8">
            <a href="../index.php" class="text-slate-500 hover:text-white transition flex items-center justify-center gap-2 text-sm font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Website
            </a>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
