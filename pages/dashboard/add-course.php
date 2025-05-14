<?php
require_once '../../includes/init.php';
$currentPage = 'add-course';

$error = '';
$success = '';

// Create uploads directory if it doesn't exist
$upload_dir = '../../uploads/courses/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
    $instructor = mysqli_real_escape_string($conn, $_POST['instructor'] ?? '');
    $duration = mysqli_real_escape_string($conn, $_POST['duration'] ?? '');
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    
    // Handle image upload
    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Check if extension is allowed
        $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($file_ext, $allowed_exts)) {
            // Generate unique name
            $new_file_name = uniqid('course_') . '.' . $file_ext;
            $destination = $upload_dir . $new_file_name;
            
            if (move_uploaded_file($file_tmp, $destination)) {
                $image_name = $new_file_name;
            } else {
                $error = 'Failed to upload image';
            }
        } else {
            $error = 'Invalid file extension. Allowed: jpg, jpeg, png, gif';
        }
    }
    
    // Validation
    if (empty($title) || empty($instructor) || empty($duration)) {
        $error = 'Please fill all required fields';
    } else {
        // Insert into database with image
        $query = "INSERT INTO courses (title, instructor, duration, description, image) 
                  VALUES ('$title', '$instructor', '$duration', '$description', '$image_name')";
        
        if (mysqli_query($conn, $query)) {
            $success = 'Course has been added successfully';
            // Clear form values
            $title = $instructor = $duration = $description = '';
        } else {
            $error = 'Error: ' . mysqli_error($conn);
        }
    }
}

include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';
?>

<main class="flex-1 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Add New Course</h1>
        <a href="<?php echo SITE_URL; ?>/pages/dashboard/courses.php" 
           class="text-blue-600 hover:underline">
            Back to Courses
        </a>
    </div>
    
    <?php if ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form method="post" class="space-y-6" enctype="multipart/form-data">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title*</label>
                <input type="text" id="title" name="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            
            <div>
                <label for="instructor" class="block text-sm font-medium text-gray-700 mb-1">Instructor*</label>
                <input type="text" id="instructor" name="instructor" value="<?php echo isset($instructor) ? htmlspecialchars($instructor) : ''; ?>" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration*</label>
                <input type="text" id="duration" name="duration" value="<?php echo isset($duration) ? htmlspecialchars($duration) : ''; ?>" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-sm text-gray-500 mt-1">Example: 12 weeks, 3 months, etc.</p>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Course Image</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-sm text-gray-500 mt-1">Upload a course thumbnail image (JPG, PNG, GIF)</p>
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Add Course
                </button>
            </div>
        </form>
    </div>
</main>

<?php include_once '../../components/DashFooter.php'; ?>