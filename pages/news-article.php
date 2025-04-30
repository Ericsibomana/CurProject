<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 
require_once $base_path . '/data/news.php';
require_once $base_path . '/components/RelatedNews.php';

// Get article ID from URL parameter
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get the specific article
$article = getNewsById($article_id);

// Check if article exists
if (!$article) {
    header("Location: ../index.php"); // Redirect to homepage if article not found
    exit;
}

// Page title for SEO
$page_title = $article['title'] . ' - Catholic University of Rwanda';

$site_url = $web_root;
    include $base_path . '/components/Header.php'; 
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
    <!-- Header would go here -->
    
    <!-- Article Content -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <article>
            <!-- Back to News Link -->
            <div class="mb-6">
                <a href="../index.php#news" class="text-primary hover:underline">← Back to News</a>
            </div>
            
            <!-- Article Header -->
            <div class="mb-6">
                <h1 class="text-2xl md:text-3xl font-bold mb-2"><?php echo $article['title']; ?></h1>
                <div class="text-gray-500"><?php echo $article['date']; ?></div>
            </div>
            
            <!-- Featured Image -->
            <div class="mb-6">
                <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" class="w-full h-auto rounded">
            </div>
            
            <!-- Article Content -->
            <div class="prose max-w-none">
                <?php echo $article['content']; ?>
            </div>

            <!-- Share Buttons -->
            <div class="mt-8 pt-4 border-t border-gray-200">
                <h3 class="text-lg font-semibold mb-3">Share this article</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800">Facebook</a>
                    <a href="#" class="text-blue-400 hover:text-blue-600">Twitter</a>
                    <a href="#" class="text-green-600 hover:text-green-800">WhatsApp</a>
                    <a href="#" class="text-blue-700 hover:text-blue-900">LinkedIn</a>
                </div>
            </div>
            
            <!-- Related Articles Component -->
            <?php renderRelatedNews($article_id); ?>
        </article>
    </main>
    
    <!-- Footer -->
    <?php 
    $site_url = $web_root;
    include $base_path . '/components/Footer.php'; 
    ?>
    
</body>
</html>