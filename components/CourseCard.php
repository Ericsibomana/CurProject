<?php
function renderCourseCard($id, $title, $description, $level, $duration, $image = null) {
    // Fix the course path to use the correct PHP file
    $coursePath = "course-single.php?id=" . $id;
    
    // Determine level badge color
    $levelColor = 'bg-gray-500';
    if ($level == 'Beginner') {
        $levelColor = 'bg-green-500';
    } else if ($level == 'Intermediate') {
        $levelColor = 'bg-blue-500';
    } else if ($level == 'Advanced') {
        $levelColor = 'bg-purple-500';
    }

    // Default image if none provided
    if (empty($image)) {
        $image = '/images/course-default.jpg';
    }
    
    // Output the card HTML
    ?>
    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full transform transition-transform duration-200 hover:scale-105 hover:shadow-lg">
        <?php if ($image): ?>
        <div class="h-48 overflow-hidden">
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="w-full h-full object-cover">
        </div>
        <?php endif; ?>
        
        <div class="p-6 flex-grow">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800"><?php echo $title; ?></h3>
                <span class="<?php echo $levelColor; ?> text-white text-xs font-semibold px-2 py-1 rounded-full uppercase"><?php echo $level; ?></span>
            </div>
            
            <p class="text-gray-600 mb-4 line-clamp-3"><?php echo $description; ?></p>
            
            <div class="flex items-center text-gray-500 text-sm mt-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php echo $duration; ?></span>
            </div>
        </div>
        
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            <a href="<?php echo $coursePath; ?>" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                View Course Details
            </a>
        </div>
    </div>
    <?php
}
?>