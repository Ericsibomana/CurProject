<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 


require_once $base_path . '/data/news.php';
require_once $base_path . '/components/NewsCard.php';

$news_items = getNewsItems();

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
            <?php foreach($news_items as $news): ?>
                <?php 
                $news_copy = $news;
                
                if (!empty($news_copy['image']) && substr($news_copy['image'], 0, 1) !== '/') {
                    $news_copy['image'] = $web_root . $news_copy['image'];
                }
                
                $news_copy['link'] = "news-article.php?id=" . $news_copy['id'];
                
                renderNewsCard($news_copy, true); 
                ?>
            <?php endforeach; ?>
        </div>
    </main>
    
    <!-- Footer -->
    <?php include $base_path . '/components/Footer.php'; ?>
    
    <!-- Include your JavaScript file -->
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>