<?php
$root_path = "";
if (isset($base_path)) {
    $root_path = $base_path;
} else {
    // If not set, calculate it from the current file
    $root_path = dirname(__DIR__);
}

// Create relative URL base for assets
$site_url = "";
$current_path = $_SERVER['PHP_SELF'];
$depth = substr_count($current_path, '/') - 1;
$site_url = str_repeat("../", max(0, $depth - 1));



// Check if we're on the landing page (index.php)
$is_landing_page = basename($_SERVER['SCRIPT_NAME']) === 'index.php';
?>

<header class="bg-white shadow-md">
    <!-- Desktop Header -->
    <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo - Use direct path on landing page, relative path elsewhere -->
        <div class="flex items-center">
        <img src="<?php echo $site_url; ?>images/logo.png" alt="Logo" class="h-12 mr-3">
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-primary focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:block">
            <ul class="flex items-center">
                <li class="mx-3"><a href="<?php echo $site_url; ?>index.php" class="text-primary font-medium hover:underline">Home</a></li>
                
                <!-- About Dropdown -->
                <li class="relative mx-3 dropdown-menu">
                    <button class="text-primary font-medium hover:underline flex items-center dropdown-toggle bg-transparent border-0">
                        About
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded shadow-lg z-10 hidden dropdown-content">
                        <a href="<?php echo $site_url; ?>pages/history.php" class="block px-4 py-2 text-primary hover:bg-gray-100">History</a>
                        <a href="<?php echo $site_url; ?>pages/mission.php" class="block px-4 py-2 text-primary hover:bg-gray-100">Mission/Vision</a>
                        <a href="<?php echo $site_url; ?>pages/team.php" class="block px-4 py-2 text-primary hover:bg-gray-100">Team</a>
                        <a href="<?php echo $site_url; ?>pages/contact.php" class="block px-4 py-2 text-primary hover:bg-gray-100">Contact</a>
                    </div>
                </li>
                
                <li class="mx-3"><a href="<?php echo $site_url; ?>pages/courses.php" class="text-primary font-medium hover:underline">Courses</a></li>
                
                <!-- Partnerships Dropdown -->
                <li class="relative mx-3 dropdown-menu">
                    <button class="text-primary font-medium hover:underline flex items-center dropdown-toggle bg-transparent border-0">
                        Partnerships
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded shadow-lg z-10 hidden dropdown-content">
                        <a href="<?php echo $site_url; ?>pages/projects.php" class="block px-4 py-2 text-primary hover:bg-gray-100">Projects</a>
                        <a href="<?php echo $site_url; ?>pages/partnership.php" class="block px-4 py-2 text-primary hover:bg-gray-100">Partnership</a>
                    </div>
                </li>
                
                <li class="mx-3"><a href="<?php echo $site_url; ?>pages/all-news.php" class="text-primary font-medium hover:underline">News</a></li>
                <li class="mx-3"><a href="<?php echo $site_url; ?>pages/contact.php" class="text-primary font-medium hover:underline">Contact</a></li>
            </ul>
        </nav>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <a href="<?php echo $site_url; ?>index.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Home</a>
        
        <!-- Mobile About Dropdown -->
        <div class="mobile-dropdown">
            <button class="w-full text-left flex justify-between items-center py-2 px-4 text-primary hover:bg-gray-100">
                About
                <svg class="w-4 h-4 ml-1 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="hidden bg-gray-50 pl-8">
                <a href="<?php echo $site_url; ?>pages/history.php" class="block py-2 px-4 text-primary hover:bg-gray-100">History</a>
                <a href="<?php echo $site_url; ?>pages/mission.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Mission/Vision</a>
                <a href="<?php echo $site_url; ?>pages/team.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Team</a>
                <a href="<?php echo $site_url; ?>pages/contact.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Contact</a>
            </div>
        </div>
        
        <a href="<?php echo $site_url; ?>pages/courses.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Courses</a>
        
        <!-- Mobile Partnerships Dropdown -->
        <div class="mobile-dropdown">
            <button class="w-full text-left flex justify-between items-center py-2 px-4 text-primary hover:bg-gray-100">
                Partnerships
                <svg class="w-4 h-4 ml-1 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="hidden bg-gray-50 pl-8">
                <a href="<?php echo $site_url; ?>pages/projects.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Projects</a>
                <a href="<?php echo $site_url; ?>pages/partnership.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Partnership</a>
            </div>
        </div>
        
        <a href="<?php echo $site_url; ?>pages/all-news.php" class="block py-2 px-4 text-primary hover:bg-gray-100">News</a>
        <a href="<?php echo $site_url; ?>pages/contact.php" class="block py-2 px-4 text-primary hover:bg-gray-100">Contact</a>
    </div>
</header>