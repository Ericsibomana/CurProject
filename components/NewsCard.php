<?php
function renderNewsCard($news, $full_width = false) {
    $classes = $full_width ? "w-full" : "flex-1";
    
    // Use the link if provided, otherwise construct one
    // This makes the component more flexible
    $link = isset($news['link']) ? $news['link'] : "pages/news-article.php?id=" . $news['id'];
?>
    <!-- News Card Component - Made Responsive -->
    <div class="<?php echo $classes; ?> bg-gray-100 rounded overflow-hidden">
        <div class="h-36 sm:h-40 md:h-44 overflow-hidden">
            <img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>" class="w-full h-full object-cover">
        </div>
        <div class="p-3 sm:p-4">
            <div class="text-gray-500 text-xs sm:text-sm mb-1"><?php echo $news['date']; ?></div>
            <div class="font-bold mb-2 text-gray-800 text-sm sm:text-base"><?php echo $news['title']; ?></div>
            <div class="text-xs sm:text-sm text-gray-600 mb-2"><?php echo $news['excerpt']; ?></div>
            <div class="text-right">
                <a href="<?php echo $link; ?>" class="text-primary text-xs sm:text-sm font-medium">Read More...</a>
            </div>
        </div>
    </div>
<?php
}
?>