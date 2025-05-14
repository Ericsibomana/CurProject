<?php
require_once '../../includes/init.php';
$currentPage = 'news';

$error = '';
$success = false;

// Create uploads directory if it doesn't exist
$upload_dir = '../../uploads/news/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
    $date = mysqli_real_escape_string($conn, $_POST['date'] ?? '');
    $excerpt = mysqli_real_escape_string($conn, $_POST['excerpt'] ?? '');
    $content = $_POST['content'] ?? ''; // Will be sanitized later for HTML content
    
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
            $new_file_name = uniqid('news_') . '.' . $file_ext;
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
    if (empty($title) || empty($date) || empty($excerpt) || empty($content)) {
        $error = 'Please fill all required fields';
    } else {
        // Sanitize HTML content
        $content = htmlentities($content, ENT_QUOTES, 'UTF-8');
        
        // Insert news with image
        $query = "INSERT INTO news (title, publish_date, excerpt, content, image, created_at) 
                  VALUES ('$title', '$date', '$excerpt', '$content', '$image_name', NOW())";
                  
        if (mysqli_query($conn, $query)) {
            header('Location: news.php?success=added');
            exit;
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
        <h1 class="text-2xl font-bold">Add News</h1>
        <a href="<?php echo SITE_URL; ?>/pages/dashboard/news.php" 
           class="text-blue-600 hover:underline">
            Back to News
        </a>
    </div>
    
    <?php if ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form method="post" class="space-y-6" enctype="multipart/form-data">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">News Title*</label>
                <input type="text" id="title" name="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date*</label>
                <input type="text" id="date" name="date" value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : date('F j, Y'); ?>" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-sm text-gray-500 mt-1">Format: Month Day, Year (e.g. April 2, 2025)</p>
            </div>
            
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt/Summary*</label>
                <textarea id="excerpt" name="excerpt" rows="2" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"><?php echo isset($_POST['excerpt']) ? htmlspecialchars($_POST['excerpt']) : ''; ?></textarea>
                <p class="text-sm text-gray-500 mt-1">A brief summary that appears in news listings</p>
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content*</label>
                <textarea id="content" name="content" rows="10" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                <p class="text-sm text-gray-500 mt-1">You can use HTML tags for formatting</p>
            </div>
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">News Image</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-sm text-gray-500 mt-1">Upload an image for this news (JPG, PNG, GIF)</p>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Add News
                </button>
            </div>
        </form>
    </div>
</main>

<?php include_once '../../components/DashFooter.php'; ?>