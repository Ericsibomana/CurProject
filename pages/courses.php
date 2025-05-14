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

// Include components and database config
include $base_path . '/includes/config.php'; // Database connection
include $base_path . '/components/Header.php'; 

// Get all courses function - works with your courses table
function getAllCourses() {
    global $conn;
    global $web_root;
    
    // Using the courses table as seen in the screenshot
    $query = "SELECT id, title, instructor, duration, description, image, created_at 
              FROM courses 
              ORDER BY created_at DESC";
    
    $result = mysqli_query($conn, $query);
    
    $courses = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $courses[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'instructor' => $row['instructor'],
                'duration' => $row['duration'],
                'description' => $row['description'],
                'image' => $row['image'],
                'created_at' => $row['created_at']
            ];
        }
    } else {
        // Handle database query errors
        echo "<div class='bg-red-100 text-red-700 p-3 rounded'>Database error: " . mysqli_error($conn) . "</div>";
    }
    
    return $courses;
}

// Simple function to render a course card
function renderCourseCard($id, $title, $description, $instructor, $duration, $image) {
    global $web_root;
    ?>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="h-48 overflow-hidden">
            <?php if ($image): ?>
                <img src="<?php echo $web_root . 'uploads/courses/' . $image; ?>" alt="<?php echo $title; ?>" class="w-full h-full object-cover">
            <?php else: ?>
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No image available</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold mb-2"><?php echo $title; ?></h3>
            <div class="flex items-center mb-2">
                <span class="text-gray-700 font-medium">Instructor:</span>
                <span class="ml-2 text-gray-600"><?php echo $instructor; ?></span>
            </div>
            <div class="flex items-center mb-4">
                <span class="text-gray-700 font-medium">Duration:</span>
                <span class="ml-2 text-gray-600"><?php echo $duration; ?></span>
            </div>
            <p class="text-gray-700 mb-4"><?php echo substr($description, 0, 120) . (strlen($description) > 120 ? '...' : ''); ?></p>
            <a href="<?php echo $web_root; ?>pages/course-single.php?id=<?php echo $id; ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Learn More</a>
        </div>
    </div>
    <?php
}

$allCourses = getAllCourses();
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
                The Center for Entrepreneurship offers courses across various disciplines, providing students with the knowledge, skills, and mindset needed to succeed in today's dynamic business environment.
            </p>
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="font-medium">Our courses are designed to cater to students at all levels, from beginners exploring entrepreneurial concepts to advanced entrepreneurs refining their business strategies.</p>
            </div>
        </div>
    </div>
</div>

<!-- All Courses Section -->
<div class="container mx-auto px-4 py-8 mb-12">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-blue-800">Available Courses</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            if (empty($allCourses)): 
            ?>
                <div class="col-span-3 text-center py-8 bg-gray-100 rounded-lg">
                    <p class="text-gray-600">No courses available yet. Check back soon for new offerings.</p>
                </div>
            <?php
            else:
                foreach ($allCourses as $course) {
                    renderCourseCard(
                        $course['id'],
                        $course['title'],
                        $course['description'],
                        $course['instructor'],
                        $course['duration'],
                        $course['image']
                    );
                }
            endif;
            ?>
        </div>
    </div>
</div>

<?php
// Include footer component
include $base_path . '/components/Footer.php';
?>
<script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>