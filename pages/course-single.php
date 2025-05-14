<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set base paths
$base_path = dirname(__DIR__);
$web_root = "../";

// Include database connection
include $base_path . '/includes/config.php';

// Function to get course by ID from database
function getCourseById($id) {
    global $conn;
    global $web_root;
    
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT id, title, instructor, duration, description, image, created_at 
              FROM courses 
              WHERE id = $id";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);
        // Add image path
        $course['image'] = $web_root . 'uploads/courses/' . $course['image'];
        return $course;
    }
    
    return null;
}

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p style='text-align: center; margin-top: 2rem;'>Invalid or missing course ID.</p>";
    exit;
}

$courseId = (int) $_GET['id'];

// Get course data by ID
$course = getCourseById($courseId);

// If course not found, display message
if (!$course) {
    echo "<p style='text-align: center; margin-top: 2rem;'>Course not found.</p>";
    exit;
}

// Now that we've handled any redirects, we can start outputting HTML
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Center for Entrepreneurship</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#1E40AF"
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-gray-50">

<?php
// Include header component
include $base_path . '/components/Header.php';
?>

<!-- Course Banner -->
<div class="bg-blue-900 py-16 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold mb-4"><?php echo htmlspecialchars($course['title']); ?></h1>
            <div class="flex flex-wrap gap-4 items-center">
                <span class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php echo htmlspecialchars($course['duration']); ?>
                </span>
                <?php if (!empty($course['instructor'])): ?>
                <span class="flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <?php echo htmlspecialchars($course['instructor']); ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Course Content -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-1/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-8">
                    <img src="<?php echo $course['image']; ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" class="w-full h-auto">
                    <div class="p-6 space-y-4">
                        <div class="bg-gray-50 p-4 rounded-md mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Enrollment:</span>
                                <span class="font-medium">Open</span>
                            </div>
                        </div>
                        <a href="#" class="block w-full bg-blue-600 text-white text-center py-3 px-4 rounded-md hover:bg-blue-700 transition-colors font-medium">
                            Enroll Now
                        </a>
                        <a href="#" class="block w-full border border-blue-600 text-blue-600 text-center py-3 px-4 rounded-md hover:bg-blue-50 transition-colors font-medium">
                            Download Syllabus
                        </a>
                    </div>
                </div>
            </div>
            <div class="md:w-2/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden p-6 mb-8">
                    <h2 class="text-2xl font-bold text-blue-800 mb-4">About This Course</h2>
                    
                    <p class="text-gray-700 mb-6"><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
                    
                    <!-- Course highlights -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                        <p class="font-medium">This course is perfect for students interested in developing their entrepreneurship skills in <?php echo strtolower(htmlspecialchars($course['title'])); ?>.</p>
                    </div>
                    
                    <!-- What you'll learn -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-3">What You'll Learn</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Core principles and concepts in <?php echo strtolower(htmlspecialchars($course['title'])); ?></span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Practical applications through hands-on projects</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Industry best practices and strategies</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Real-world case studies and applications</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Course structure section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden p-6 mb-8">
                    <h3 class="text-xl font-semibold mb-4">Course Structure</h3>
                    <div class="bg-gray-50 p-4 rounded-md mb-6">
                        <ul class="space-y-3">
                            <li class="flex justify-between">
                                <span class="text-gray-600">Duration:</span>
                                <span class="font-medium"><?php echo htmlspecialchars($course['duration']); ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Weekly Commitment:</span>
                                <span class="font-medium">5-7 hours</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Format:</span>
                                <span class="font-medium">Online with live sessions</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Certificate:</span>
                                <span class="font-medium">Yes, upon completion</span>
                            </li>
                        </ul>
                    </div>
                    
                    <h4 class="text-lg font-medium mb-3">Course Modules</h4>
                    <div class="space-y-3">
                        <div class="border border-gray-200 rounded-md">
                            <div class="flex justify-between items-center p-4 cursor-pointer bg-gray-50">
                                <h5 class="font-medium">Module 1: Introduction and Fundamentals</h5>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="border border-gray-200 rounded-md">
                            <div class="flex justify-between items-center p-4 cursor-pointer bg-gray-50">
                                <h5 class="font-medium">Module 2: Core Concepts and Applications</h5>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="border border-gray-200 rounded-md">
                            <div class="flex justify-between items-center p-4 cursor-pointer bg-gray-50">
                                <h5 class="font-medium">Module 3: Advanced Strategies</h5>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="border border-gray-200 rounded-md">
                            <div class="flex justify-between items-center p-4 cursor-pointer bg-gray-50">
                                <h5 class="font-medium">Module 4: Capstone Project</h5>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Instructor section -->
                <?php if (!empty($course['instructor'])): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden p-6">
                    <h3 class="text-xl font-semibold mb-4">About the Instructor</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 rounded-full bg-gray-300 mr-4 overflow-hidden">
                            <img src="<?php echo $web_root; ?>assets/images/instructor-placeholder.jpg" alt="Instructor" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/64'">
                        </div>
                        <div>
                            <h4 class="font-medium text-lg"><?php echo htmlspecialchars($course['instructor']); ?></h4>
                            <p class="text-gray-600">Faculty, Center for Entrepreneurship</p>
                        </div>
                    </div>
                    <p class="text-gray-700">
                        Our instructors are industry professionals with extensive experience in their fields. 
                        They bring real-world insights and practical knowledge to help students develop the skills 
                        needed to succeed in today's competitive business environment.
                    </p>
                </div>
                <?php endif; ?>
            </div>
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