<?php
function renderRelatedNews($current_id, $limit = 2) {
    // Get base path to ensure correct file inclusion regardless of where this is called from
    $base_path = dirname(dirname(__FILE__));
    
    // Include required files with absolute path
    require_once $base_path . '/data/news.php';
    
    // Get all news items
    $all_news = getNewsItems();
    
    // Filter out current article and limit results
    $related_articles = [];
    foreach ($all_news as $news) {
        if ($news['id'] != $current_id) {
            $related_articles[] = $news;
        }
    }
    
    // Shuffle and take up to limit
    shuffle($related_articles);
    $related_articles = array_slice($related_articles, 0, $limit);
    
    if (empty($related_articles)) {
        return; // Don't display anything if no related articles
    }
?>
    <div class="mt-10">
        <h3 class="text-xl font-bold mb-4">Related Articles</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($related_articles as $related): ?>
            <div class="bg-gray-50 p-4 rounded">
                <div class="text-gray-500 text-sm mb-1"><?php echo $related['date']; ?></div>
                <div class="font-bold mb-2"><?php echo $related['title']; ?></div>
                <div class="text-sm text-gray-600 mb-2"><?php echo $related['excerpt']; ?></div>
                <div class="text-right">
                    <a href="news-article.php?id=<?php echo $related['id']; ?>" class="text-primary font-medium">Read More...</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
}
?>