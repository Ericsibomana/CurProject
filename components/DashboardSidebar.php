<?php
$currentPage = 'settings';
// Include the utility functions file
require_once '../../includes/functions.php';

// Get dynamic menu items for dashboard
$sidebar_menu = getMenuItems($conn, 'dashboard'); // You can change 'dashboard' to other locations if needed
?>

<aside class="w-full md:w-64 bg-white shadow-md md:min-h-screen hidden md:block" id="sidebar">
    <div class="p-4">
        <div class="flex items-center justify-center p-2">
            <a href="<?php echo SITE_URL; ?>" class="flex items-center">
                <span class="ml-2 text-xl font-bold text-primary">Admin Panel</span>
            </a>
        </div>

        <nav class="mt-6">
            <ul>
                <?php foreach ($sidebar_menu as $menu_item): ?>
                    <?php
                    // Initialize the $is_current flag to false
                    $is_current = false;

                    // Ensure the menu item has a title and a URL
                    if (isset($menu_item['title']) && isset($menu_item['url'])) {
                        // Parse URL for the menu item
                        $menu_url_parts = parse_url($menu_item['url']);
                        $menu_path = $menu_url_parts['path'] ?? '';
                        
                        // Check if current page matches the menu path
                        if (strpos($menu_path, $currentPage) !== false) {
                            $is_current = true;
                        }

                        // Special check for the 'Dashboard' title
                        if ($menu_item['title'] === 'Dashboard' && $currentPage === 'dashboard' && 
                            (strpos($_SERVER['PHP_SELF'], 'index.php') !== false || $_SERVER['PHP_SELF'] === '/pages/dashboard/')) {
                            $is_current = true;
                        }
                    }
                    ?>

                    <li class="mb-2">
                        <a href="<?php echo SITE_URL . $menu_item['url']; ?>" 
                           class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-md <?php echo $is_current ? 'bg-blue-100 text-blue-700' : ''; ?>">
                            <i class="fas fa-<?php echo htmlspecialchars($menu_item['icon']); ?> mr-3"></i>
                            <span><?php echo htmlspecialchars($menu_item['title']); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>

                <li class="mt-6">
                    <a href="<?php echo SITE_URL; ?>/pages/dashboard/logout.php" 
                       class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-md">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>