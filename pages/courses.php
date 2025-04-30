<?php 
// Add DOCTYPE and HTML head with Tailwind CSS CDN before including Header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center for Entrepreneurship - Courses</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 

// Include components and data
include $base_path . '/components/Header.php'; 
include $base_path . '/components/CourseCard.php'; 
include $base_path . '/data/courses.php'; 

$allCategories = getCategories();

// Map numeric IDs to string keys used in $courses
$categoryMap = [
    1 => 'foundation',
    2 => 'advanced',
    3 => 'specialized'
];
?>

<!-- Page Banner -->
<div class="bg-blue-900 py-16 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Our Courses</h1>
        <p class="text-xl max-w-3xl mx-auto">Explore our comprehensive range of entrepreneurship courses designed to develop your business skills and innovative thinking.</p>
    </div>
</div>

<!-- Courses Overview Section -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">Course Programs</h2>
            <p class="text-gray-600 mb-6">
                The Center for Entrepreneurship offers over 200 courses across various disciplines, providing students with the knowledge, skills, and mindset needed to succeed in today's dynamic business environment.
            </p>
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="font-medium">Our courses are designed to cater to students at all levels, from beginners exploring entrepreneurial concepts to advanced entrepreneurs refining their business strategies.</p>
            </div>
        </div>
    </div>
</div>

<!-- Course Categories -->
<div class="container mx-auto px-4 py-8 mb-12">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-center mb-8">Course Categories</h2>
        
        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($allCategories as $category): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-800 text-white p-4">
                    <h3 class="text-xl font-semibold"><?php echo $category['name']; ?></h3>
                </div>
                <div class="p-6">
                    <p class="mb-4"><?php echo $category['description']; ?></p>
                    <a href="#category-<?php echo $category['id']; ?>" class="text-blue-600 hover:underline font-medium flex items-center">
                        View Courses
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
// Loop through categories to display courses for each
foreach ($allCategories as $category):
    $categoryId = $category['id'];
    $categoryName = $category['name'];
    $categoryKey = $categoryMap[$categoryId]; // Map numeric ID to key
    $categoryCourses = getCoursesByCategory($categoryKey);
?>
<!-- <?php echo $categoryName; ?> Courses Section -->
<div id="category-<?php echo $categoryId; ?>" class="container mx-auto px-4 py-8 <?php echo ($categoryKey === 'specialized') ? 'mb-12' : ''; ?>">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-blue-800"><?php echo $categoryName; ?> Courses</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            foreach ($categoryCourses as $course) {
                renderCourseCard(
                    $course['id'], // Pass the course ID as the first parameter
                    $course['title'],
                    $course['description'],
                    $course['level'],
                    $course['duration'],
                    $course['image']
                );
            }
            ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php
// Include footer component
include $base_path . '/components/Footer.php';
?>
<script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>