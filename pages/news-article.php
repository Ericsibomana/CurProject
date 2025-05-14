<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 

// Use database connection instead of data file
require_once $base_path . '/includes/config.php';
require_once $base_path . '/components/RelatedNews.php';

// Get article ID from URL parameter
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get the specific article from database
function getNewsArticleFromDatabase($id) {
    global $conn;
    
    $query = "SELECT id, title, content, image, publish_date, created_at, updated_at
              FROM news
              WHERE id = ?";
              
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        // Handle error or article not found
        return null;
    }
}

// Get related news articles
function getRelatedNewsFromDatabase($current_article_id, $limit = 3) {
    global $conn;
    
    $query = "SELECT id, title, excerpt, image, publish_date
              FROM news
              WHERE id != ?
              ORDER BY publish_date DESC
              LIMIT ?";
              
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $current_article_id, $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $related_news = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $related_news[] = $row;
        }
    }
    
    return $related_news;
}

// Get the article
$article = getNewsArticleFromDatabase($article_id);

// Check if article exists
if (!$article) {
    header("Location: " . $web_root . "index.php"); // Redirect to homepage if article not found
    exit;
}

// Format the date for display
$display_date = date("F j, Y", strtotime($article['publish_date']));

// Page title for SEO
$page_title = $article['title'] . ' - Catholic University of Rwanda';
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
    $site_url = $web_root;
    include $base_path . '/components/Header.php'; 
    ?>
    
    <!-- Article Content -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <article>
            <!-- Back to News Link -->
            <div class="mb-6">
                <a href="<?php echo $web_root; ?>news/all-news.php" class="text-primary hover:underline">← Back to All News</a>
            </div>
            
            <!-- Article Header -->
            <div class="mb-6">
                <h1 class="text-2xl md:text-3xl font-bold mb-2"><?php echo $article['title']; ?></h1>
                <div class="text-gray-500"><?php echo $display_date; ?></div>
            </div>
            
            <!-- Featured Image -->
            <div class="mb-6">
                <img src="<?php echo $web_root . 'uploads/news/' . $article['image']; ?>" 
                     alt="<?php echo $article['title']; ?>" 
                     class="w-full h-auto rounded">
            </div>
            
            <!-- Article Content -->
            <div class="prose max-w-none">
                <?php echo $article['content']; ?>
            </div>
            
            <!-- Share Buttons -->
            <div class="mt-8 pt-4 border-t border-gray-200">
                <h3 class="text-lg font-semibold mb-3">Share this article</h3>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                       target="_blank" class="text-blue-600 hover:text-blue-800">Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($article['title']); ?>" 
                       target="_blank" class="text-blue-400 hover:text-blue-600">Twitter</a>
                    <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($article['title'] . ' - ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                       target="_blank" class="text-green-600 hover:text-green-800">WhatsApp</a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                       target="_blank" class="text-blue-700 hover:text-blue-900">LinkedIn</a>
                </div>
            </div>
            
            <!-- Related Articles -->
            <div class="mt-12">
                <h3 class="text-xl font-semibold mb-6">Related Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php
                    $related_news = getRelatedNewsFromDatabase($article_id);
                    if (!empty($related_news)):
                        foreach ($related_news as $news_item):
                            $image_path = $web_root . 'uploads/news/' . $news_item['image'];
                            $news_link = "news-article.php?id=" . $news_item['id'];
                            $news_date = date("F j, Y", strtotime($news_item['publish_date']));
                    ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <a href="<?php echo $news_link; ?>">
                            <img src="<?php echo $image_path; ?>" alt="<?php echo $news_item['title']; ?>" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <span class="text-sm text-gray-500"><?php echo $news_date; ?></span>
                            <h3 class="text-lg font-semibold mt-1">
                                <a href="<?php echo $news_link; ?>" class="text-primary hover:underline"><?php echo $news_item['title']; ?></a>
                            </h3>
                            <p class="text-gray-600 mt-2 line-clamp-3"><?php echo $news_item['excerpt']; ?></p>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <p class="col-span-3 text-gray-500">No related articles available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </main>
    
    <!-- Footer -->
    <?php 
    include $base_path . '/components/Footer.php'; 
    ?>
    
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>