<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 

// Instead of using data file, use database connection
require_once $base_path . '/includes/config.php';
require_once $base_path . '/components/NewsCard.php';

// Get all news items from database
function getNewsFromDatabase() {
    global $conn;
    
    $query = "SELECT id, title, excerpt, content, image, publish_date, created_at, updated_at 
              FROM news 
              ORDER BY publish_date DESC";
              
    $result = mysqli_query($conn, $query);
    
    // Fetch all news items as an associative array
    $news_items = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $news_items[] = $row;
        }
        return $news_items;
    } else {
        // Handle database query errors
        echo "<div class='bg-red-100 text-red-700 p-3 rounded'>Database error: " . mysqli_error($conn) . "</div>";
        return [];
    }
}

// Get news items from database
$news_items = getNewsFromDatabase();

$page_title = 'All News - Catholic University of Rwanda';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <!-- Include your CSS files here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <?php
    // Pass the web root to the header
    $site_url = $web_root;
    include $base_path . '/components/Header.php'; 
    ?>
    
    <!-- All News Content -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="<?php echo $web_root; ?>index.php" class="text-primary hover:underline">← Back to Home</a>
        </div>
        
        <h1 class="text-2xl md:text-3xl font-bold mb-8">News & Updates</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (empty($news_items)): ?>
                <p class="text-gray-500 col-span-3">No news items available at this time.</p>
            <?php else: ?>
                <?php foreach($news_items as $news): ?>
                    <?php 
                    $news_copy = $news;
                    
                    // Prepend uploads directory to image path
                    $news_copy['image'] = $web_root . 'uploads/news/' . $news_copy['image'];
                    
                    // Set link to the article page
                    $news_copy['link'] = "news-article.php?id=" . $news_copy['id'];
                    
                    renderNewsCard($news_copy, true); 
                    ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    
    <!-- Footer -->
    <?php include $base_path . '/components/Footer.php'; ?>
    
    <!-- Include your JavaScript file -->
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>