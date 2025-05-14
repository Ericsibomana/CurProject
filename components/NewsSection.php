<?php
function renderNewsSection($limit = 3) {
    // Using the existing connection from the main config file
    require_once './includes/config.php';
    
    // Prepare SQL query to fetch news items with the correct column names
    $query = "SELECT id, title, excerpt, content, image, publish_date, created_at, updated_at 
              FROM news 
              ORDER BY publish_date DESC 
              LIMIT ?";
              
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch all news items as an associative array
    $news_items = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Fix image path by prepending the uploads directory path
            $row['image'] = 'uploads/news/' . $row['image'];
            $news_items[] = $row;
        }
    } else {
        // Handle database query errors
        echo "<div class='bg-red-100 text-red-700 p-3 rounded'>Database error: " . mysqli_error($conn) . "</div>";
    }
?>
    <!-- News Section Component - Made Responsive -->
    <section id="news" class="max-w-6xl mx-auto px-4 py-8 md:py-10">
    <h2 class="text-xl sm:text-2xl font-bold mb-6">News</h2>
    
    <?php if (empty($news_items)): ?>
        <p class="text-gray-500">No news items available at this time.</p>
    <?php else: ?>
        <div class="flex <?php echo count($news_items) === 1 ? 'justify-center' : 'flex-col sm:flex-row gap-4 sm:gap-5'; ?> mb-6">
            <?php foreach($news_items as $news): ?>
                <?php renderNewsCard($news); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <div class="text-center">
        <a href="pages/all-news.php" class="inline-block bg-primary text-white px-5 py-2 rounded-full text-sm">More News</a>
    </div>
</section>
<?php
}
?>