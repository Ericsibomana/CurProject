<?php
require_once '../../includes/init.php';
$currentPage = 'courses';

$error = '';
$success = false;

// Create uploads directory if it doesn't exist
$upload_dir = '../../uploads/courses/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle delete course
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $course_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get current image to delete if exists
    $result = mysqli_query($conn, "SELECT image FROM courses WHERE id = '$course_id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);
        if (!empty($course['image'])) {
            // Delete the image file
            $image_path = $upload_dir . $course['image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }
    
    $query = "DELETE FROM courses WHERE id = '$course_id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: courses.php?success=deleted');
        exit;
    } else {
        $error = 'Error deleting course: ' . mysqli_error($conn);
    }
}

// Handle update course submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_course') {
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
    $instructor = mysqli_real_escape_string($conn, $_POST['instructor'] ?? '');
    $duration = mysqli_real_escape_string($conn, $_POST['duration'] ?? '');
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    
    // Get current image name
    $current_image = '';
    $result = mysqli_query($conn, "SELECT image FROM courses WHERE id = '$course_id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);
        $current_image = $course['image'];
    }
    
    // Handle image upload
    $image_name = $current_image;
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
                // Delete old image if exists
                if (!empty($current_image)) {
                    $old_image_path = $upload_dir . $current_image;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
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
        // Update course with image
        $query = "UPDATE courses 
                  SET title = '$title', 
                      instructor = '$instructor', 
                      duration = '$duration', 
                      description = '$description',
                      image = '$image_name'
                  WHERE id = '$course_id'";
                  
        if (mysqli_query($conn, $query)) {
            header('Location: courses.php?success=updated');
            exit;
        } else {
            $error = 'Error: ' . mysqli_error($conn);
        }
    }
}

// Get course data for editing
$edit_course = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $course_id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM courses WHERE id = '$course_id'");
    
    if ($result && mysqli_num_rows($result) > 0) {
        $edit_course = mysqli_fetch_assoc($result);
    } else {
        $error = 'Course not found';
    }
}

// Get all courses
$courses = fetchData($conn, "SELECT * FROM courses ORDER BY created_at DESC");

include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';
?>

<main class="flex-1 p-6">
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && $edit_course): ?>
        <!-- Edit Course Form -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Course</h1>
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
        
        <div class="bg-white rounded-lg shadow p-6">
            <form method="post" class="space-y-6" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_course">
                <input type="hidden" name="course_id" value="<?php echo $edit_course['id']; ?>">
                
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title*</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($edit_course['title']); ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                
                <div>
                    <label for="instructor" class="block text-sm font-medium text-gray-700 mb-1">Instructor*</label>
                    <input type="text" id="instructor" name="instructor" value="<?php echo htmlspecialchars($edit_course['instructor']); ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration*</label>
                    <input type="text" id="duration" name="duration" value="<?php echo htmlspecialchars($edit_course['duration']); ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="5"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"><?php echo htmlspecialchars($edit_course['description']); ?></textarea>
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Course Image</label>
                    <?php if (!empty($edit_course['image'])): ?>
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                            <img src="<?php echo SITE_URL; ?>/uploads/courses/<?php echo htmlspecialchars($edit_course['image']); ?>" 
                                alt="Course Image" class="w-40 h-auto object-cover rounded">
                        </div>
                    <?php endif; ?>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    <p class="text-sm text-gray-500 mt-1">Upload a new image to replace the current one (JPG, PNG, GIF)</p>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Update Course
                    </button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <!-- Courses List View -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <h1 class="text-2xl font-bold">Manage Courses</h1>
    <a href="<?php echo SITE_URL; ?>/pages/dashboard/add-course.php" 
       class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
        Add New Course
    </a>
</div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?php 
                    if ($_GET['success'] == 'deleted') {
                        echo 'Course has been successfully deleted.';
                    } else {
                        echo 'Course has been successfully updated.';
                    }
                ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <div class="bg-white rounded-lg shadow overflow-x-auto">
         <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($courses)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">No courses found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($courses as $course): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <?php if (!empty($course['image'])): ?>
                                    <img src="<?php echo SITE_URL; ?>/uploads/courses/<?php echo htmlspecialchars($course['image']); ?>" 
                                        alt="<?php echo htmlspecialchars($course['title']); ?>"
                                        class="w-20 h-12 object-cover rounded">
                                <?php else: ?>
                                    <div class="w-20 h-12 bg-gray-200 flex items-center justify-center rounded">
                                        <span class="text-xs text-gray-500">No image</span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($course['title']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($course['instructor']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($course['duration']); ?></td>
                            <td class="px-6 py-4"><?php echo formatDate($course['created_at']); ?></td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="?action=edit&id=<?php echo $course['id']; ?>" 
                                   class="text-blue-600 hover:underline">Edit</a>
                                <a href="?action=delete&id=<?php echo $course['id']; ?>" 
                                   class="text-red-600 hover:underline"
                                   onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php include_once '../../components/DashFooter.php'; ?>