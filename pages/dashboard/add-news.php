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

// Process inline images in content
function process_inline_images($content, $uploaded_images) {
    if (empty($uploaded_images)) {
        return $content;
    }
    
    $image_counter = 0;
    return preg_replace_callback(
        '/<img src="IMAGE_PLACEHOLDER"([^>]*)>/',
        function($matches) use (&$image_counter, $uploaded_images, $upload_dir) {
            if (isset($uploaded_images[$image_counter])) {
                $img_path = SITE_URL . '/uploads/news/' . $uploaded_images[$image_counter];
                $image_counter++;
                return '<img src="' . $img_path . '"' . $matches[1] . '>';
            }
            return $matches[0];
        },
        $content
    );
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
    $date = mysqli_real_escape_string($conn, $_POST['date'] ?? '');
    $excerpt = mysqli_real_escape_string($conn, $_POST['excerpt'] ?? '');
    $content = $_POST['content'] ?? ''; // Will be sanitized later
    
    // Handle featured image upload
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
                $error = 'Failed to upload featured image';
            }
        } else {
            $error = 'Invalid file extension. Allowed: jpg, jpeg, png, gif';
        }
    }
    
    // Handle multiple inline image uploads
    $uploaded_inline_images = [];
    if (isset($_FILES['inline_images'])) {
        $file_count = count($_FILES['inline_images']['name']);
        
        for ($i = 0; $i < $file_count; $i++) {
            if ($_FILES['inline_images']['error'][$i] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['inline_images']['tmp_name'][$i];
                $file_name = $_FILES['inline_images']['name'][$i];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($file_ext, $allowed_exts)) {
                    $new_file_name = uniqid('inline_') . '.' . $file_ext;
                    $destination = $upload_dir . $new_file_name;
                    
                    if (move_uploaded_file($file_tmp, $destination)) {
                        $uploaded_inline_images[] = $new_file_name;
                    }
                }
            }
        }
    }
    
    // Validation
    if (empty($title) || empty($date) || empty($excerpt) || empty($content)) {
        $error = 'Please fill all required fields';
    } else {
        // Process inline images - replace placeholders with actual paths
        $content = process_inline_images($content, $uploaded_inline_images);
        
        // Sanitize HTML content - Allow certain tags for formatting
        $allowed_tags = '<p><br><h1><h2><h3><h4><h5><h6><strong><em><i><b><ul><ol><li><img><a><div><span>';
        $content = strip_tags($content, $allowed_tags);
        
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

<!-- Add CSS for editor toolbar -->
<style>
.editor-toolbar {
    display: flex;
    gap: 10px;
    padding: 8px;
    background-color: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-bottom: none;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}

.editor-toolbar button {
    padding: 5px 10px;
    background-color: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.editor-toolbar button:hover {
    background-color: #f8fafc;
}

.editor-toolbar .divider {
    width: 1px;
    background-color: #cbd5e1;
    margin: 0 5px;
}

#editor-container {
    position: relative;
}

.toolbar-group {
    display: flex;
    gap: 5px;
}

.toolbar-heading-dropdown {
    position: absolute;
    top: 38px;
    left: 0;
    background: white;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: none;
    z-index: 100;
}

.toolbar-heading-dropdown button {
    display: block;
    width: 100%;
    text-align: left;
    padding: 5px 10px;
    border: none;
    background: none;
    cursor: pointer;
}

.toolbar-heading-dropdown button:hover {
    background-color: #f1f5f9;
}

#image-upload-form {
    display: none;
    position: absolute;
    top: 38px;
    right: 0;
    background: white;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    z-index: 100;
    width: 250px;
}

#content-wrapper {
    border: 1px solid #e2e8f0;
    border-top: none;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}

#content {
    border: none;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    min-height: 300px;
}

/* Add preview styles */
.image-preview {
    max-width: 100%;
    margin-top: 10px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
}

.image-preview img {
    max-width: 100%;
    height: auto;
}

/* Hidden file inputs container */
#inline-images-container {
    display: none;
}
</style>

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
        <form method="post" class="space-y-6" enctype="multipart/form-data" id="news-form">
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
                <div id="editor-container">
                    <!-- Toolbar -->
                    <div class="editor-toolbar">
                        <div class="toolbar-group">
                            <button type="button" id="heading-btn" title="Heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z"/>
                                </svg>
                            </button>
                            <div class="toolbar-heading-dropdown" id="heading-dropdown">
                                <button type="button" data-heading="h1" class="heading-option">Heading 1</button>
                                <button type="button" data-heading="h2" class="heading-option">Heading 2</button>
                                <button type="button" data-heading="h3" class="heading-option">Heading 3</button>
                                <button type="button" data-heading="h4" class="heading-option">Heading 4</button>
                            </div>
                        </div>
                        
                        <div class="toolbar-group">
                            <button type="button" id="bold-btn" title="Bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.21 13c2.106 0 3.412-1.087 3.412-2.823 0-1.306-.984-2.283-2.324-2.386v-.055a2.176 2.176 0 0 0 1.852-2.14c0-1.51-1.162-2.46-3.014-2.46H3.843V13H8.21zM5.908 4.674h1.696c.963 0 1.517.451 1.517 1.244 0 .834-.629 1.32-1.73 1.32H5.908V4.673zm0 6.788V8.598h1.73c1.217 0 1.88.492 1.88 1.415 0 .943-.643 1.449-1.832 1.449H5.907z"/>
                                </svg>
                            </button>
                            <button type="button" id="italic-btn" title="Italic">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M7.991 11.674 9.53 4.455c.123-.595.246-.71 1.347-.807l.11-.52H7.211l-.11.52c1.06.096 1.128.212 1.005.807L6.57 11.674c-.123.595-.246.71-1.346.806l-.11.52h3.774l.11-.52c-1.06-.095-1.129-.211-1.006-.806z"/>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div class="toolbar-group">
                            <button type="button" id="image-btn" title="Insert Image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                </svg>
                            </button>
                            <!-- Image upload form (hidden by default) -->
                            <div id="image-upload-form">
                                <h3 class="text-sm font-medium mb-2">Insert Image</h3>
                                <input type="file" id="inline-image-upload" accept="image/*" class="mb-2 w-full text-sm">
                                <div class="image-preview" id="image-preview"></div>
                                <div class="flex justify-end mt-2">
                                    <button type="button" id="insert-image-btn" class="bg-primary text-white px-2 py-1 rounded text-xs">Insert</button>
                                    <button type="button" id="cancel-image-btn" class="ml-2 text-gray-500 px-2 py-1 rounded text-xs">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content textarea with adjusted styling -->
                    <div id="content-wrapper">
                        <textarea id="content" name="content" rows="10" required
                              class="w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary"><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-1">Use the toolbar above to format your content</p>
            </div>
            
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                <p class="text-sm text-gray-500 mt-1">Upload an image for this news (JPG, PNG, GIF)</p>
            </div>
            
            <!-- Hidden container for inline images -->
            <div id="inline-images-container"></div>
            
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-primary text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Add News
                </button>
            </div>
        </form>
    </div>
</main>

<!-- JavaScript for editor functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const contentTextarea = document.getElementById('content');
        const headingBtn = document.getElementById('heading-btn');
        const headingDropdown = document.getElementById('heading-dropdown');
        const headingOptions = document.querySelectorAll('.heading-option');
        const boldBtn = document.getElementById('bold-btn');
        const italicBtn = document.getElementById('italic-btn');
        const imageBtn = document.getElementById('image-btn');
        const imageUploadForm = document.getElementById('image-upload-form');
        const insertImageBtn = document.getElementById('insert-image-btn');
        const cancelImageBtn = document.getElementById('cancel-image-btn');
        const inlineImageUpload = document.getElementById('inline-image-upload');
        const imagePreview = document.getElementById('image-preview');
        const inlineImagesContainer = document.getElementById('inline-images-container');
        const newsForm = document.getElementById('news-form');
        
        // Track uploaded images
        let inlineImages = [];
        let imageCounter = 0;
        
        // Helper function to wrap selected text with tags
        function wrapText(openTag, closeTag) {
            const start = contentTextarea.selectionStart;
            const end = contentTextarea.selectionEnd;
            const selectedText = contentTextarea.value.substring(start, end);
            const replacement = openTag + selectedText + closeTag;
            
            contentTextarea.value = contentTextarea.value.substring(0, start) + replacement + contentTextarea.value.substring(end);
            
            // Restore focus and selection
            contentTextarea.focus();
            contentTextarea.setSelectionRange(start + openTag.length, start + openTag.length + selectedText.length);
        }
        
        // Toggle heading dropdown
        headingBtn.addEventListener('click', function() {
            headingDropdown.style.display = headingDropdown.style.display === 'block' ? 'none' : 'block';
        });
        
        // Handle heading selection
        headingOptions.forEach(option => {
            option.addEventListener('click', function() {
                const headingTag = this.getAttribute('data-heading');
                wrapText(`<${headingTag}>`, `</${headingTag}>`);
                headingDropdown.style.display = 'none';
            });
        });
        
        // Bold button
        boldBtn.addEventListener('click', function() {
            wrapText('<strong>', '</strong>');
        });
        
        // Italic button
        italicBtn.addEventListener('click', function() {
            wrapText('<em>', '</em>');
        });
        
        // Image preview
        inlineImageUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Toggle image upload form
        imageBtn.addEventListener('click', function() {
            imageUploadForm.style.display = imageUploadForm.style.display === 'block' ? 'none' : 'block';
        });
        
        // Cancel image upload
        cancelImageBtn.addEventListener('click', function() {
            imageUploadForm.style.display = 'none';
            inlineImageUpload.value = '';
            imagePreview.innerHTML = '';
        });
        
        // Insert image into content
        insertImageBtn.addEventListener('click', function() {
            if (inlineImageUpload.files && inlineImageUpload.files[0]) {
                const file = inlineImageUpload.files[0];
                const imageId = 'img_' + (imageCounter++);
                
                // Insert placeholder in content
                const cursorPos = contentTextarea.selectionStart;
                const altText = file.name.split('.')[0].replace(/[^a-zA-Z0-9]/g, ' ');
                const imageTag = `<img src="IMAGE_PLACEHOLDER" alt="${altText}" class="w-full h-auto my-4" data-id="${imageId}" />`;
                
                contentTextarea.value = contentTextarea.value.substring(0, cursorPos) + imageTag + contentTextarea.value.substring(cursorPos);
                
                // Store file for form submission
                inlineImages.push({
                    id: imageId,
                    file: file
                });
                
                // Reset upload form
                imageUploadForm.style.display = 'none';
                inlineImageUpload.value = '';
                imagePreview.innerHTML = '';
            } else {
                alert('Please select an image to insert');
            }
        });
        
        // Handle form submission
        newsForm.addEventListener('submit', function(e) {
            // Clear previous inputs
            inlineImagesContainer.innerHTML = '';
            
            // Only proceed with inline images if there are any
            if (inlineImages.length > 0) {
                // Create hidden file inputs for inline images
                for (let i = 0; i < inlineImages.length; i++) {
                    // Create a file input for each image
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.name = `inline_images[]`;
                    input.style.display = 'none';
                    
                    // Create a new FormData object for the file
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(inlineImages[i].file);
                    input.files = dataTransfer.files;
                    
                    // Add to container
                    inlineImagesContainer.appendChild(input);
                }
            }
            
            // Form submits normally
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!headingBtn.contains(event.target) && !headingDropdown.contains(event.target)) {
                headingDropdown.style.display = 'none';
            }
            
            if (!imageBtn.contains(event.target) && !imageUploadForm.contains(event.target)) {
                imageUploadForm.style.display = 'none';
            }
        });
    });
</script>

<?php include_once '../../components/DashFooter.php'; ?>