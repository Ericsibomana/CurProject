<?php
// session_start();
requireLogin();

// Optional: fallback if user_name not set
if (!isset($_SESSION['user_name']) && isset($_SESSION['name'])) {
    $_SESSION['user_name'] = $_SESSION['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getPageTitle($currentPage); ?> - <?php echo SITE_NAME; ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#003366',
                        secondary: '#f5f5f5',
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        // Toggle mobile menu
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('block');
        }
    </script>
</head>
<body class="bg-gray-100">
    <header class="bg-primary text-white h-16 flex justify-between items-center px-4 md:px-6 shadow-md">
        <div class="flex items-center">
            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="mr-2 md:hidden" onclick="toggleSidebar()">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <div class="logo">
                <a href="<?php echo SITE_URL; ?>" class="flex items-center">
                    <img src="<?php echo SITE_URL; ?>/images/logo.png" alt="<?php echo SITE_NAME; ?>" class="h-8 md:h-10">
                </a>
            </div>
        </div>
        
        <div class="user-menu flex items-center gap-2 md:gap-4">
            <span class="hidden sm:inline">Welcome, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Guest'); ?></span>
        </div>
    </header>
    <div class="flex flex-col md:flex-row min-h-[calc(100vh-64px)]">