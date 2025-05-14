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

// Handle delete news
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $news_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get current image to delete if exists
    $result = mysqli_query($conn, "SELECT image FROM news WHERE id = '$news_id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $news = mysqli_fetch_assoc($result);
        if (!empty($news['image'])) {
            // Delete the image file
            $image_path = $upload_dir . $news['image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }
    
    $query = "DELETE FROM news WHERE id = '$news_id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: news.php?success=deleted');
        exit;
    } else {
        $error = 'Error deleting news: ' . mysqli_error($conn);
    }
}

// Handle update news submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_news') {
    $news_id = mysqli_real_escape_string($conn, $_POST['news_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
    $date = mysqli_real_escape_string($conn, $_POST['date'] ?? '');
    $excerpt = mysqli_real_escape_string($conn, $_POST['excerpt'] ?? '');
    $content = $_POST['content'] ?? ''; // Will be sanitized later for HTML content
    
    // Get current image name
    $current_image = '';
    $result = mysqli_query($conn, "SELECT image FROM news WHERE id = '$news_id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $news = mysqli_fetch_assoc($result);
        $current_image = $news['image'];
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
            $new_file_name = uniqid('news_') . '.' . $file_ext;
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
    if (empty($title) || empty($date) || empty($excerpt) || empty($content)) {
        $error = 'Please fill all required fields';
    } else {
        // Sanitize HTML content
        $content = htmlentities($content, ENT_QUOTES, 'UTF-8');
        
        // Update news with image
        $query = "UPDATE news 
                  SET title = '$title', 
                      publish_date = '$date', 
                      excerpt = '$excerpt', 
                      content = '$content',
                      image = '$image_name'
                  WHERE id = '$news_id'";
                  
        if (mysqli_query($conn, $query)) {
            header('Location: news.php?success=updated');
            exit;
        } else {
            $error = 'Error: ' . mysqli_error($conn);
        }
    }
}

// Get news data for editing
$edit_news = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $news_id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM news WHERE id = '$news_id'");
    
    if ($result && mysqli_num_rows($result) > 0) {
        $edit_news = mysqli_fetch_assoc($result);
        // Decode HTML content for editing
        $edit_news['content'] = html_entity_decode($edit_news['content'], ENT_QUOTES, 'UTF-8');
    } else {
        $error = 'News not found';
    }
}

// Get all news - Using 'publish_date' instead of 'date'
$news_items = fetchData($conn, "SELECT * FROM news ORDER BY publish_date DESC");

include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';
?>

<main class="flex-1 p-6">
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && $edit_news): ?>
        <!-- Edit News Form -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit News</h1>
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
                <input type="hidden" name="action" value="update_news">
                <input type="hidden" name="news_id" value="<?php echo $edit_news['id']; ?>">
                
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">News Title*</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($edit_news['title']); ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date*</label>
                    <input type="text" id="date" name="date" value="<?php echo htmlspecialchars($edit_news['publish_date'] ?? ''); ?>" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    <p class="text-sm text-gray-500 mt-1">Format: Month Day, Year (e.g. April 2, 2025)</p>
                </div>
                
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt/Summary*</label>
                    <textarea id="excerpt" name="excerpt" rows="2" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"><?php echo htmlspecialchars($edit_news['excerpt']); ?></textarea>
                    <p class="text-sm text-gray-500 mt-1">A brief summary that appears in news listings</p>
                </div>
                
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content*</label>
                    <textarea id="content" name="content" rows="10" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"><?php echo $edit_news['content']; ?></textarea>
                    <p class="text-sm text-gray-500 mt-1">You can use HTML tags for formatting</p>
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">News Image</label>
                    <?php if (!empty($edit_news['image'])): ?>
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                            <img src="<?php echo SITE_URL; ?>/uploads/news/<?php echo htmlspecialchars($edit_news['image']); ?>" 
                                alt="News Image" class="w-40 h-auto object-cover rounded">
                        </div>
                    <?php endif; ?>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    <p class="text-sm text-gray-500 mt-1">Upload a new image to replace the current one (JPG, PNG, GIF)</p>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Update News
                    </button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <!-- News List View -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Manage News</h1>
            <a href="<?php echo SITE_URL; ?>/pages/dashboard/add-news.php" 
               class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Add News
            </a>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?php 
                    if ($_GET['success'] == 'deleted') {
                        echo 'News has been successfully deleted.';
                    } else if ($_GET['success'] == 'added') {
                        echo 'News has been successfully added.';
                    } else {
                        echo 'News has been successfully updated.';
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excerpt</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($news_items)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">No news found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($news_items as $news): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <?php if (!empty($news['image'])): ?>
                                    <img src="<?php echo SITE_URL; ?>/uploads/news/<?php echo htmlspecialchars($news['image']); ?>" 
                                        alt="<?php echo htmlspecialchars($news['title']); ?>"
                                        class="w-20 h-12 object-cover rounded">
                                <?php else: ?>
                                    <div class="w-20 h-12 bg-gray-200 flex items-center justify-center rounded">
                                        <span class="text-xs text-gray-500">No image</span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($news['title']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($news['publish_date'] ?? ''); ?></td>
                            <td class="px-6 py-4 max-w-xs truncate"><?php echo htmlspecialchars($news['excerpt']); ?></td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="<?php echo SITE_URL; ?>/pages/news-article.php?id=<?php echo $news['id']; ?>" 
                                   class="text-green-600 hover:underline" target="_blank">View</a>
                                <a href="?action=edit&id=<?php echo $news['id']; ?>" 
                                   class="text-blue-600 hover:underline">Edit</a>
                                <a href="?action=delete&id=<?php echo $news['id']; ?>" 
                                   class="text-red-600 hover:underline"
                                   onclick="return confirm('Are you sure you want to delete this news item?')">Delete</a>
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