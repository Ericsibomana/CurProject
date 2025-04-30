<?php
/**
 * components/NewsSection.php
 * Component for displaying the news section on pages
 */

/**
 * Renders a section with news cards
 * 
 * @param int $limit Number of news items to display (0 for all)
 * @return void
 */
function renderNewsSection($limit = 3) {
    // Get news items from the data file
    $news_items = getNewsItems($limit);
?>
    <!-- News Section Component - Made Responsive -->
    <section id="news" class="max-w-6xl mx-auto px-4 py-8 md:py-10">
        <h2 class="text-xl sm:text-2xl font-bold mb-6">News</h2>
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-5 mb-6">
            <?php 
            foreach($news_items as $news): 
                renderNewsCard($news); 
            endforeach; 
            ?>
        </div>
        <div class="text-center">
            <a href="pages/all-news.php" class="inline-block bg-primary text-white px-5 py-2 rounded-full text-sm">More News</a>
        </div>
    </section>
<?php
}
?>