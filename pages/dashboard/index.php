<?php
require_once '../../includes/init.php';
$currentPage = 'dashboard';

// Get statistics using mysqli
$courseCount = countRecords($conn, 'courses');
$newsCount = countRecords($conn, 'news');
$userCount = countRecords($conn, 'users');

// Get recent news
$recentNews = fetchData($conn, "SELECT * FROM news ORDER BY created_at DESC LIMIT 5");

include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';
?>

<main class="flex-1 p-4 md:p-6">
    <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Dashboard</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
        <!-- Stats Cards -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6 text-center">
            <h2 class="text-md md:text-lg font-medium text-gray-600">Courses</h2>
            <p class="text-3xl md:text-4xl font-bold text-primary mt-2 mb-2 md:mb-4"><?php echo $courseCount; ?></p>
            <a href="<?php echo SITE_URL; ?>/pages/dashboard/courses.php" 
               class="text-blue-600 hover:underline">Manage Courses</a>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6 text-center">
            <h2 class="text-md md:text-lg font-medium text-gray-600">News Articles</h2>
            <p class="text-3xl md:text-4xl font-bold text-primary mt-2 mb-2 md:mb-4"><?php echo $newsCount; ?></p>
            <a href="<?php echo SITE_URL; ?>/pages/dashboard/news.php" 
               class="text-blue-600 hover:underline">Manage News</a>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6 text-center">
            <h2 class="text-md md:text-lg font-medium text-gray-600">Users</h2>
            <p class="text-3xl md:text-4xl font-bold text-primary mt-2 mb-2 md:mb-4"><?php echo $userCount; ?></p>
            <a href="<?php echo SITE_URL; ?>/pages/dashboard/users.php" 
               class="text-blue-600 hover:underline">Manage Users</a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4 md:p-6">
        <h2 class="text-lg md:text-xl font-bold mb-4">Recent News</h2>
        
        <div class="bg-white  overflow-x-auto">
        <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-2 md:px-4 py-2 text-left">Title</th>
                        <th class="px-2 md:px-4 py-2 text-left">Date</th>
                        <th class="px-2 md:px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recentNews)): ?>
                        <tr>
                            <td colspan="3" class="px-2 md:px-4 py-2 text-center">No news articles found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($recentNews as $news): ?>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-2 md:px-4 py-2"><?php echo htmlspecialchars($news['title']); ?></td>
                            <td class="px-2 md:px-4 py-2"><?php echo formatDate($news['created_at']); ?></td>
                            <td class="px-2 md:px-4 py-2">
                                <a href="<?php echo SITE_URL; ?>/pages/dashboard/news.php?edit=<?php echo $news['id']; ?>" 
                                   class="text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include_once '../../components/DashFooter.php'; ?>